<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ventas Fix</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Ventas</b>FIX</a>
  </div>
  
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicie sesión para acceder al sistema</p>

  
      <form action="<?php echo e(route('login.post')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email (@ventasfix.cl)" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
        </div>
      </form>
    

    </div>
  </div>
</div>
</body>
</html><?php /**PATH C:\Users\Ricardo\Documents\SEGUNDO ANO PROGRAMACION\SEGUNDO TRIMESTRE\DESARROLLO SOFTWARE WEB\EVALUACION 2\ventas-fix\resources\views/login.blade.php ENDPATH**/ ?>