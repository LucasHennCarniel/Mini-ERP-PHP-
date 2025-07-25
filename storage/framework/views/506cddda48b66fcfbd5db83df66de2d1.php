<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini ERP Laravel</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container background-branco">
        <div class="main">
            <div class="flex flex_c">
                
                <?php $__env->startSection('content'); ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="welcome-message">
                <div>Bem-vindo ao Mini ERP!</div>
               
            </div>
        </div>
    </div>
    
    <?php $__env->stopSection(); ?>
</body>
</html>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/welcome.blade.php ENDPATH**/ ?>