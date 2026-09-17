<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Ventas Fix</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper" style="padding: 20px;">
    <section class="content-header">
      <h1>Dashboard Principal - Ventas Fix</h1>
    </section>
    
    <section class="content">
      <div class="row">
        <!-- Usuarios -->
        <div class="col-lg-4 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $totalUsuarios }}</h3>
              <p>Usuarios del Sistema</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
          </div>
        </div>
        <!-- Productos -->
        <div class="col-lg-4 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $totalProductos }}</h3>
              <p>Productos Registrados</p>
            </div>
            <div class="icon"><i class="fas fa-box"></i></div>
          </div>
        </div>
        <!-- Clientes -->
        <div class="col-lg-4 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $totalClientes }}</h3>
              <p>Clientes Empresa</p>
            </div>
            <div class="icon"><i class="fas fa-handshake"></i></div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</body>
</html>