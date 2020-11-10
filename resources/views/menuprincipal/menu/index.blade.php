<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FAC</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

  </head>

  <style type="text/css" media="screen">
  	.boton {
text-decoration: none;
 color: #fff;
 font-weight: bold;
 padding: 12px 20px;
 font-size: 18px;
 border-radius: 10px;
 background-color: #3c8dbc;
 box-shadow: 0 5px 5px #287CAC, 0 9px 0 #287CAC, 0px 9px 10px rgba(0,0,0,0.4), inset 0px 2px 9px rgba(255,255,255,0.2), inset 0 -2px 9px rgba(0,0,0,0.2);
 position: relative;
 border-bottom: 1px solid rgba(255,255,255,0.2);
 display: inline-block;
 font-family: Arial, Helvetica, sans;
 text-shadow: 0px -1px 0px rgba(0,0,0,0.2);
}
 
.boton:hover {
 box-shadow: 0 5px 5px #313131, 0 9px 0 #393939, 0px 9px 10px rgba(0,0,0,0.4), inset 0px 2px 15px rgba(255,255,255,0.4), inset 0 -2px 9px rgba(0,0,0,0.2);
 color: #fff !important;
}
 
.boton:active {
 top: 7px;
 box-shadow: 0 2px 0 #393939, 0px 4px 4px rgba(0,0,0,0.4), inset 0px 2px 5px rgba(0,0,0,0.2);
 color: #fff !important;
}
 
.formaBoton {
 border-radius: 5px;
 padding-left: 25px;
 padding-right: 25px;
}
 
.colorRojo{
 background-color: #c34747;
 box-shadow: 0 5px 5px #853232, 0 9px 0 #5e2525, 0px 9px 10px rgba(0,0,0,0.4), inset 0px 2px 9px rgba(255,255,255,0.2), inset 0 -2px 9px rgba(0,0,0,0.2);
}
 
.colorRojo:hover {
 box-shadow: 0 5px 5px #853232, 0 9px 0 #5e2525, 0px 9px 10px rgba(0,0,0,0.4), inset 0px 2px 15px rgba(255,255,255,0.4), inset 0 -2px 9px rgba(0,0,0,0.2);
}
 
.colorRojon:active {
 box-shadow: 0 2px 0 #5e2525, 0px 4px 4px rgba(0,0,0,0.4), inset 0px 2px 5px rgba(0,0,0,0.2);
}
  </style>

  <body>
    

      
     <nav class="navbar " style="width: 100%; background-color: #3c8dbc; text-align: center">
          <a style="color: white;font-weight: bold; font-size: 30px; ">MENU</a>
         

        </nav>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
     
        
        <!-- Main content -->
        <section class="content" style="height: 410px">
          
          <div class="row">
          	<div class="col-md-col-lg-5 col-md-4 col-sm-4 col-xs-12">
            </div><!-- /.col -->
            <div class="col-md-col-lg-4 col-md-4 col-sm-4 col-xs-12" style="text-align:center">
              <a class="boton colorBoton formaBoton" href="../cargarPago/pago/create" style="text-align: center">CARGAR PAGO</a>
            </div><!-- /.col -->
            <div class="col-md-col-lg-2 col-md-4 col-sm-4 col-xs-12">
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="row">
          	<div class="col-md-col-lg-5 col-md-4 col-sm-4 col-xs-12">
            </div><!-- /.col -->
            <div class="col-md-col-lg-4 col-md-4 col-sm-4 col-xs-12" style="text-align:center; padding-top:30px ">
              <a class="boton colorBoton formaBoton" href="../buscarfactura/factura" style="text-align: center">BUSCAR FACTURA</a>
            </div><!-- /.col -->
            <div class="col-md-col-lg-2 col-md-4 col-sm-4 col-xs-12">
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="row">
          	<div class="col-md-col-lg-5 col-md-4 col-sm-4 col-xs-12">
            </div><!-- /.col -->
            <div class="col-md-col-lg-4 col-md-4 col-sm-4 col-xs-12" style="text-align:center; padding-top:30px ">
              <a class="boton colorBoton formaBoton" href="{{asset('https://www.google.com.ar/')}}" style="text-align: center">SALIR</a>
            </div><!-- /.col -->
            <div class="col-md-col-lg-2 col-md-4 col-sm-4 col-xs-12">
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->

      <!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer  style="background: #fff; padding: 15px; color: #444; border-top: 1px solid #d2d6de;">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2020
        </div>
        <strong>Trabajo Realizado por Grupo 10</strong>
      </footer>



      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js')}}"></script>
    @stack ('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    
  </body>
</html>