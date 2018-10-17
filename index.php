<?php session_start();
include "config/View.php";
require_once "config/config.php";

//Message Factory
include_once "model/Message/Message.class.php";
include_once "model/Message/MessageFactory.class.php";
include_once "model/Message/SuccessMessage.class.php";
include_once "model/Message/WarningMessage.class.php";

  $message=isset($_GET['message']) && isset($_GET['types']) ? MessageFactory::createMessage($_GET['types']) : false;
  $message_out=$message ? $message->getMessage($_GET['message']) : '';
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>CONTROL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="res/css/styles.css" rel="stylesheet">

     <?php 
  //algoritmo para cargar acciones estilos segun la vista abierta cabezera
  if (isset($_GET['view']) && $_GET['view']!="")
    { $script="view/".$_GET['view']."/header.php";
      if (file_exists($script)) {
        include $script;

      }
    }

 ?>

  </head>
  <body>
      <?php if(isset($_SESSION['id'])): ?>

    <div class="header">
       <div class="container">
          <div class="row">
             <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                   <h1><a href="?">PROYECTO CONTROL</a></h1>
                </div>
             </div>
             <div class="col-md-5">
                <div class="row">
                  <div class="col-lg-12">
                    
                  </div>
                </div>
             </div>
             <div class="col-md-2">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                      <ul class="nav navbar-nav">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name']; ?> <b class="caret"></b></a>
                          <ul class="dropdown-menu animated fadeInUp">
                            <li><a href="?view=Profile">Profile</a></li>
                            <li><a href="process.php?action=login&type=logout">Logout</a></li>
                          </ul>
                        </li>
                      </ul>
                    </nav>
                </div>
             </div>
          </div>
       </div>
  </div>

    <div class="page-content">
      <div class="row">
      <div class="col-md-2">
        <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="<?php if(isset($_GET['view']) && $_GET['view']=="Home") echo "current" ?>"><a href="?"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <?php
                       if(isset($_SESSION['email']) && $_SESSION['email']=="huamanip.soft2016@gmail.com"):
                     ?>
                     <li class="<?php if(isset($_GET['view']) && $_GET['view']=="Usuarios") echo "current" ?>"><a href="?view=Usuarios"><i class="glyphicon glyphicon-user"></i> Usuarios</a></li>

                          <?php endif; ?>

                     <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-random"></i> Cuentas Por
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li  class="<?php if(isset($_GET['type']) && $_GET['type']=="activa") echo "current" ?>"><a href="?view=Cuentas&type=activa">Activas</a></li>
                            <li  class="<?php if(isset($_GET['type']) && $_GET['type']=="cobrar") echo "current" ?>"><a href="?view=Cuentas&type=cobrar">Cobrar</a></li>
                            <li  class="<?php if(isset($_GET['type']) && $_GET['type']=="pagar") echo "current" ?>"><a href="?view=Cuentas&type=pagar">Pagar</a></li>
                        </ul>
                    </li>

                    <li  class="<?php if(isset($_GET['view']) && $_GET['view']=="Mensualidad") echo "current" ?>"><a href="?view=Mensualidad"><i class="glyphicon glyphicon-align-center"></i> Mensualidad</a></li>

                       <li  class="<?php if(isset($_GET['view']) && $_GET['view']=="VariableM") echo "current" ?>"><a href="?view=VariableM"><i class="glyphicon glyphicon-align-center"></i> Mensualidad Variable</a></li>
                    
                </ul>
             </div>
      </div>
      <div class="col-md-10" id="mess">
      </div>
 <div class="col-md-10">
               <?php View::load('index'); ?>

      </div>

  <?php elseif(isset($_GET['view']) && $_GET['view']=="signup"): ?>
    <div class="col-md-12" id="mess">
      </div>
   <div class="page-content container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="login-wrapper">
              <div class="box">
                  <div class="content-wrap">
                      <h6>Sign Up</h6>
                                                      <h2>SITE CONTROL</h2>

                      <input class="form-control" type="text" placeholder="E-mail address" id="email">
                      <input class="form-control" type="password" placeholder="Password" id="pasword">
                      <input class="form-control" type="text" placeholder="Nombre" id="txt_name">

                      <div class="action">
                          <button type="submit"  class="btn btn-primary signup" id="register_usuario">Sign Up</button>
                      </div>                
                  </div>
              </div>

              <div class="already">
                  <p>¿Ya tienes una cuenta?</p>
                  <a href="?">Login</a>
              </div>
          </div>
      </div>
    </div>
  </div>

 <?php else: ?>

      <div class="page-content container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="login-wrapper">
             <form action="process.php?action=login" method="POST">

              <div class="box">
                  <div class="content-wrap">
                      <h6>Sign In</h6>
                                <h2>SITE CONTROL</h2>
                      <input class="form-control" type="text" placeholder="E-mail address" name="txt_email">
                      <input class="form-control" type="password" placeholder="Password" name="txt_password">
                      <div class="action">
                      <button type="submit" class="btn btn-primary signup">Login</button>
                      </div>                
                  </div>
              </div>
        </form>
              <div class="already">
                  <p>¿Aún no tienes una cuenta?</p>
                  <a href="?view=signup">Sign Up</a>
              </div>
          </div>
      </div>
    </div>
  </div>
      <?php endif; ?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="res/bootstrap/js/bootstrap.min.js"></script>
    <script src="res/js/custom.js"></script>

     <?php 
  //algoritmo para cargar acciones estilos segun la vista abierta pie de pagina
  if (isset($_GET['view']) && $_GET['view']!="")
    { $script="view/".$_GET['view']."/footer.php";
      if (file_exists($script)) {
        include $script;

      }
    }

 ?>
   <?php 
  //algoritmo para cargar acciones js segun la vista abierta
  if (isset($_GET['view']) && $_GET['view']!="")
    { $script="action/".$_GET['view']."/".$_GET['view'].".js";
      if (file_exists($script)) {
        echo "<script src='$script'></script>";
      }
    }
    if (isset($_GET['view']) && $_GET['view']=='signup') {
      $script="action/Usuarios/Usuarios.js";
      if (file_exists($script)) {
        echo "<script src='$script'></script>";
      }
    }

 ?>
  </body>
</html>