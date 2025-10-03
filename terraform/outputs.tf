# Outputs
output "application_url" {
  description = "URL da aplicação Laravel"
  value       = "http://localhost:${var.app_port}"
}

output "phpmyadmin_url" {
  description = "URL do phpMyAdmin"
  value       = "http://localhost:${var.phpmyadmin_port}"
}

output "mysql_connection" {
  description = "String de conexão MySQL"
  value       = "mysql://root:rootpassword@localhost:${var.mysql_port}/mini_erp"
  sensitive   = true
}

output "container_names" {
  description = "Nomes dos containers criados"
  value = {
    app        = docker_container.app.name
    mysql      = docker_container.mysql.name
    phpmyadmin = docker_container.phpmyadmin.name
  }
}
