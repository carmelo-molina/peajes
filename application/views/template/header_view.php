<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="<?php echo $this->config->item('author')?>">

    <title><?php echo $this->config->item('title').$title; ?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url();?>public/img/favicon.png">
    <!-- Styles-->
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/purecss.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/grids-responsive-min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/styles.css">
    <!-- End Styles-->

    <!-- SRC scripts-->
    <script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>public/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>public/js/parsley.min.js"></script>
    <script>
      var base_url = "<?php echo base_url(); ?>";
    </script>
    <!-- End SRC scripts-->
  </head>
<body>
 <style scoped>
    .button-success,
    .button-error,
    .button-warning,
    .button-black,
    .button-secondary {
        color: white;
        border-radius: 4px;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    }
    .button-success {
      color: #C5FFB9;
      background: rgb(28, 184, 65); /* this is a green */
    }
    .button-success:hover {
      color: #FFF;
      opacity: 0.7;
    }
    .button-error {
      color: #FFB6B6;
      background: rgb(202, 60, 60); /* this is a maroon */
    }
    .button-error:hover {
      color: #FFF;
      opacity: 0.7;
    }
    .button-warning {
      color: #FFEF67;
      background: rgb(223, 117, 20); /* this is an orange */
    }
    .button-warning:hover {
      color: #fff;
      opacity: 0.7;
    }
    .button-secondary {
      color: #C1E7FF;
      background: #64b5f6; /* this is a light blue */
    }
    .button-secondary:hover {
      color: #fff;
      opacity: 0.7;
    }
    .button-black {
      color:#DE9D00;
      background: #303030; /* this is a light black */
    }
    .button-black:hover {
      color:#fff;
      opacity: 0.7;
    }
    .button-xsmall {
            font-size: 70%;
        }
        .button-small {
            font-size: 80%;
        }
        .button-large {
            font-size: 110%;
        }
        .button-xlarge {
            font-size: 125%;
        }    
  </style>

<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

  <div id="menu">
    <div class="pure-menu">
      <a class="pure-menu-heading" href="<?php  echo base_url();?>">
        <?php
          if($this->session->userdata('nivel')!=0)
            echo 'INICIO';
          else
            echo $this->config->item('producto');
        ?>
      </a>
      <ul class="pure-menu-list">
        <?php
          echo menu();
         ?>
      </ul>
    </div>
  </div>
    <div id="main">