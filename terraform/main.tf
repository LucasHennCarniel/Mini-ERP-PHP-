# Configuração do provider Docker
terraform {
  required_providers {
    docker = {
      source  = "kreuzwerker/docker"
      version = "~> 3.0.1"
    }
  }
}

provider "docker" {
  host = "npipe:////.//pipe//docker_engine"  # Para Windows
  # host = "unix:///var/run/docker.sock"    # Para Linux/Mac
}

# Variáveis
variable "app_name" {
  description = "Nome da aplicação"
  type        = string
  default     = "mini-erp-laravel"
}

variable "app_port" {
  description = "Porta da aplicação"
  type        = number
  default     = 8080
}

variable "mysql_port" {
  description = "Porta do MySQL"
  type        = number
  default     = 3306
}

variable "phpmyadmin_port" {
  description = "Porta do phpMyAdmin"
  type        = number
  default     = 8081
}

# Rede Docker
resource "docker_network" "mini_erp_network" {
  name = "${var.app_name}-network"
}

# Volume para MySQL
resource "docker_volume" "mysql_data" {
  name = "${var.app_name}-mysql-data"
}

# Container MySQL
resource "docker_container" "mysql" {
  image = "mysql:8.0"
  name  = "${var.app_name}-mysql"
  
  restart = "unless-stopped"
  
  ports {
    internal = 3306
    external = var.mysql_port
  }
  
  env = [
    "MYSQL_ROOT_PASSWORD=rootpassword",
    "MYSQL_DATABASE=mini_erp",
    "MYSQL_USER=laravel",
    "MYSQL_PASSWORD=laravelpassword"
  ]
  
  volumes {
    volume_name    = docker_volume.mysql_data.name
    container_path = "/var/lib/mysql"
  }
  
  networks_advanced {
    name = docker_network.mini_erp_network.name
  }
}

# Container phpMyAdmin
resource "docker_container" "phpmyadmin" {
  image = "phpmyadmin/phpmyadmin"
  name  = "${var.app_name}-phpmyadmin"
  
  restart = "unless-stopped"
  
  ports {
    internal = 80
    external = var.phpmyadmin_port
  }
  
  env = [
    "PMA_HOST=mysql",
    "MYSQL_ROOT_PASSWORD=rootpassword"
  ]
  
  networks_advanced {
    name = docker_network.mini_erp_network.name
  }
  
  depends_on = [docker_container.mysql]
}

# Build da imagem da aplicação
resource "docker_image" "app" {
  name = "${var.app_name}:latest"
  build {
    context = "../"
    dockerfile = "Dockerfile"
  }
  keep_locally = false
}

# Container da aplicação Laravel
resource "docker_container" "app" {
  image = docker_image.app.image_id
  name  = "${var.app_name}-app"
  
  restart = "unless-stopped"
  
  ports {
    internal = 80
    external = var.app_port
  }
  
  env = [
    "APP_ENV=production",
    "APP_DEBUG=false",
    "DB_HOST=mysql",
    "DB_PORT=3306",
    "DB_DATABASE=mini_erp",
    "DB_USERNAME=root",
    "DB_PASSWORD=rootpassword"
  ]
  
  volumes {
    host_path      = abspath("../storage")
    container_path = "/var/www/html/storage"
  }
  
  volumes {
    host_path      = abspath("../bootstrap/cache")
    container_path = "/var/www/html/bootstrap/cache"
  }
  
  networks_advanced {
    name = docker_network.mini_erp_network.name
  }
  
  depends_on = [docker_container.mysql]
}
