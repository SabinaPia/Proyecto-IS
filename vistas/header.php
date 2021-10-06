<?php $archivo = basename($_SERVER['PHP_SELF']);
$pagina = str_replace(".php", "", $archivo);
?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="vistas/icon.png">
  <!-- Place favicon.ico in the root directory -->
  
  <link rel="stylesheet" href="vistas/css/normalize.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans">
  <link rel="stylesheet" href="vistas/css/all.css">
  <link rel="stylesheet" href="vistas/css/main.css?v=0.0.1">
  <meta name="theme-color" content="#fafafa"> 

</head>

<body class="<?php echo $pagina;?>">

  <header class="site-header">
        <div class="img-header">
          <div class="contenido-header" >
              <h1 class="nombre-sitio">Sistema de Publicacion de Eventos Proximos</h1>
              <p class="slogan">Lorem ipsum dolor sit amet consectetur adipisicing</p>
          </div>
        </div>
  </header>
  <div class="barra">
      <div class="contenedor clearfix">
        <div class= "logo">
            <img src="vistas/img/logo.png" alt="logo">
        </div>

        <div class="menu-movil">
            <span></span>
            <span></span>
            <span></span> 
        </div>

        <nav class="navegacion clearfix">
            <a href="?c=evento&a=Ver_evento">Eventos</a>
            <a href="?c=revista&a=Ver_revista">Revistas</a>
            <a href="#">Suscribirse</a>
        </nav>
      </div>
  </div>