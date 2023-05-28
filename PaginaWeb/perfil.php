<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Security-Policy" content="font-src data:" />
  <title>IES GM Jovellanos</title>
  <link rel="apple-touch-icon" href="http://secretaria.iesjovellanos.org/wp-content/uploads/2022/03/cropped-LF75-180x180.png">
  <link rel="icon" href="http://secretaria.iesjovellanos.org/wp-content/uploads/2022/03/cropped-LF75-32x32.png" sizes="32x32">
  <link href="../css/bootstrap.min.css" rel="stylesheet" />
  <script src="../js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="cssPropio.css" />
</head>

<style>
    <!-- html{
    height: 100%;
    }

    body {
        background: #151515;
        /* fallback for old browsers */
        margin: 0;
        font-family: 'Montserrat', sans-serif;
        background:
            linear-gradient(27deg, #151515 5px, transparent 5px) 0 5px,
            linear-gradient(207deg, #151515 5px, transparent 5px) 10px 0px,
            linear-gradient(27deg, #222 5px, transparent 5px) 0px 10px,
            linear-gradient(207deg, #222 5px, transparent 5px) 10px 5px,
            linear-gradient(90deg, #1b1b1b 10px, transparent 10px),
            linear-gradient(#1d1d1d 25%, #1a1a1a 25%, #1a1a1a 50%, transparent 50%, transparent 75%, #242424 75%, #242424);
        background-color: #131313;
        background-size: 20px 20px;
    }

    .form {
        max-width: calc(100vw - 40px);
        width: 500px;
        height: auto;
        background: rgba(255, 255, 255, 1);
        border-radius: 8px;
        box-shadow: 0 0 40px -10px #fff;
        margin: 3% auto;
        padding: 20px 30px;
        box-sizing: border-box;
        position: relative;
        border-bottom: 5px solid #ccc;
    }

    form:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 8px;
        background: #c4e17f;
        border-radius: 5px 5px 0 0;
        background: rgba(196, 225, 127, 1);
        background: -moz-linear-gradient(left, rgba(196, 225, 127, 1) 0%, rgba(196, 225, 127, 1) 20%, rgba(247, 253, 202, 1) 20%, rgba(247, 253, 202, 1) 40%, rgba(254, 207, 113, 1) 40%, rgba(254, 207, 113, 1) 60%, rgba(240, 119, 108, 1) 60%, rgba(240, 119, 108, 1) 80%, rgba(219, 157, 190, 1) 80%, rgba(219, 157, 190, 1) 100%);
        background: -webkit-gradient(left top, right top, color-stop(0%, rgba(196, 225, 127, 1)), color-stop(20%, rgba(196, 225, 127, 1)), color-stop(20%, rgba(247, 253, 202, 1)), color-stop(40%, rgba(247, 253, 202, 1)), color-stop(40%, rgba(254, 207, 113, 1)), color-stop(60%, rgba(254, 207, 113, 1)), color-stop(60%, rgba(240, 119, 108, 1)), color-stop(80%, rgba(240, 119, 108, 1)), color-stop(80%, rgba(219, 157, 190, 1)), color-stop(100%, rgba(219, 157, 190, 1)));
        background: -webkit-linear-gradient(left, rgba(196, 225, 127, 1) 0%, rgba(196, 225, 127, 1) 20%, rgba(247, 253, 202, 1) 20%, rgba(247, 253, 202, 1) 40%, rgba(254, 207, 113, 1) 40%, rgba(254, 207, 113, 1) 60%, rgba(240, 119, 108, 1) 60%, rgba(240, 119, 108, 1) 80%, rgba(219, 157, 190, 1) 80%, rgba(219, 157, 190, 1) 100%);
        background: -o-linear-gradient(left, rgba(196, 225, 127, 1) 0%, rgba(196, 225, 127, 1) 20%, rgba(247, 253, 202, 1) 20%, rgba(247, 253, 202, 1) 40%, rgba(254, 207, 113, 1) 40%, rgba(254, 207, 113, 1) 60%, rgba(240, 119, 108, 1) 60%, rgba(240, 119, 108, 1) 80%, rgba(219, 157, 190, 1) 80%, rgba(219, 157, 190, 1) 100%);
        background: -ms-linear-gradient(left, rgba(196, 225, 127, 1) 0%, rgba(196, 225, 127, 1) 20%, rgba(247, 253, 202, 1) 20%, rgba(247, 253, 202, 1) 40%, rgba(254, 207, 113, 1) 40%, rgba(254, 207, 113, 1) 60%, rgba(240, 119, 108, 1) 60%, rgba(240, 119, 108, 1) 80%, rgba(219, 157, 190, 1) 80%, rgba(219, 157, 190, 1) 100%);
        background: linear-gradient(to right, rgba(196, 225, 127, 1) 0%, rgba(196, 225, 127, 1) 20%, rgba(247, 253, 202, 1) 20%, rgba(247, 253, 202, 1) 40%, rgba(254, 207, 113, 1) 40%, rgba(254, 207, 113, 1) 60%, rgba(240, 119, 108, 1) 60%, rgba(240, 119, 108, 1) 80%, rgba(219, 157, 190, 1) 80%, rgba(219, 157, 190, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#c4e17f', endColorstr='#db9dbe', GradientType=1);
    }

    .form h2 {
        margin: 18px 0;
        padding-bottom: 10px;
        width: 210px;
        color: #1e439b;
        font-size: 22px;
        border-bottom: 3px solid #ff5501;
        font-weight: 600;
        margin-bottom: 30px;
    }

    input {
        width: 60%;
        padding: 10px;
        box-sizing: border-box;
        background: none;
        outline: none;
        resize: none;
        border: 0;
        font-family: 'Montserrat', sans-serif;
        border: 2px solid #bebed2;
        transition: all .3s;
    }

    .form p:before {
        content: attr(type);
        display: block;
        margin: 10px 0 0;
        font-size: 13px;
        color: #5a5a5a;
        float: left;
        width: 40%;
        transition: all .3s;
    }

    button {
        padding: 8px 12px;
        margin: 8px 0 0;
        font-family: 'Montserrat', sans-serif;
        border: 2px solid #78788c;
        background: 0;
        color: #5a5a6e;
        cursor: pointer;
        transition: all .3s;
    }

    button:hover {
        background: #78788c;
        color: #fff;
    }

    .tright {
        text-align: right;
    }

    .ui-menu {
        max-height: 150px;
        overflow: auto;
    }

    .ui-menu .ui-menu-item {
        padding: 5px;
        font-size: 14px;
    }

    .relative {
        position: relative;
    }

    .relative i.fa:before {
        color: #444;
        padding: 10px;
        position: absolute;
        left: -3px;
        text-align: center;
    }

    .relative i.fa {
        position: absolute;
        top: 0;
        right: 0;
        width: 40px;
        text-align: center;
        border-radius: 0 4px 4px 0;
        width: 0;
        height: 0;
        z-index: 99;
        border-left: 20px solid transparent;
        border-right: 30px solid #ccc;
        border-bottom: 34px solid #ccc;
        transition: all 0.15s ease-in-out;

    }

    .form-control:focus {
        border-color: #1e439b;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgb(30, 102, 195);
    }

    .relative input:focus+i.fa {
        border-left: 20px solid transparent;
        border-right: 30px solid #1e439b;
        border-bottom: 34px solid #1e439b;
    }

    .relative input:focus+i.fa:before {
        color: #fff;
    }

    .input-group .form-control:not(:first-child):not(:last-child),
    .input-group-addon:not(:first-child):not(:last-child),
    .input-group-btn:not(:first-child):not(:last-child) {
        border-radius: 0 4px 4px 0;
    }

    .form-control[disabled],
    .form-control[readonly],
    fieldset[disabled] .form-control {
        background-color: #fff;
    }

    /* --- Thanks Message Popup --- */
    .thanks {
        max-width: calc(100vw - 40px);
        width: 200px;
        height: auto;
        background-color: #444;
        border-radius: 8px;
        box-shadow: 0 0 40px -10px #000;
        padding: 20px;
        box-sizing: border-box;
        position: relative;
        position: absolute;
        top: 20px;
        right: 20px;
        transition: all .3s;
    }

    .thanks h4,
    .thanks p {
        color: #fff;
        text-align: center;
    }

    /* --- Animated Buttons --- */
    .movebtn {
        background-color: transparent;
        display: inline-block;
        width: 100px;
        background-image: none;
        padding: 8px 10px;
        margin-bottom: 20px;
        border-radius: 0;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        transition: all 0.5s;
        -webkit-transition-timing-function: cubic-bezier(0.5, 1.65, 0.37, 0.66);
        transition-timing-function: cubic-bezier(0.5, 1.65, 0.37, 0.66);
    }

    .movebtnre {
        border: 2px solid #ff5501;
        box-shadow: inset 0 0 0 0 #ff5501;
        color: #ff5501;
    }

    .movebtnsu {
        border: 2px solid #1e439b;
        box-shadow: inset 0 0 0 0 #1e439b;
        color: #1e439b;
    }
    .movebtnre:focus,
    .movebtnre:hover,
    .movebtnre:active {
        background-color: transparent;
        color: #FFF;
        border-color: #ff5501;
        box-shadow: inset 96px 0 0 0 #ff5501;
    }

    .movebtnsu:focus,
    .movebtnsu:hover,
    .movebtnsu:active {
        background-color: transparent;
        color: #FFF;
        border-color: #1e439b;
        box-shadow: inset 96px 0 0 0 #1e439b;
    }


    /* --- Media Queries --- */

    @media only screen and (max-width: 600px) {
        p:before {
            content: attr(type);
            width: 100%
        }

        input {
            width: 100%;
        }
    }

    </style>
    <body>
        <?php
        require("../componentes/header.php");


        echo '<h1>Datos personales de ' . $_SESSION["profesor"]["nombre"] . '</h1>';

        ?>
          <form class="form">
    <h2>Nombre</h2>
    <div class="form-group">
      <label for="email">Nombre</label>
      <div class="relative">
        <input class="form-control" id="name" type="text" required placeholder="Introduzca su nombre">
        <i class="fa fa-user">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="20" height="20" viewBox="0 0 20 22" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
          </svg>
        </i>
      </div>
    </div>
    <div class="form-group">
      <label for="email">Apellidos:</label>
      <div class="relative">
        <input class="form-control" type="url" pattern="https?://.+" required="" placeholder="Introduzca sus apellidos...">
        <i class="fa fa-building"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="email">Correo electrónico:</label>
      <div class="relative">
        <input class="form-control" type="email" required="" placeholder="Introduzca su correo electrónico..." >
        <i class="fa fa-envelope"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="email">Movil:</label>
      <div class="relative">
        <input class="form-control" type="text" maxlength="10" required="" placeholder="Introduzca su número de teléfono...">
        <i class="fa fa-phone"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="email">Designation:</label>
      <div class="relative">
        <input class="form-control" type="text" id="designation" required="" placeholder="Introduzca su cargo...">
        <i class="fa fa-suitcase"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="email">Specilization:</label>
      <div class="relative">
        <input class="form-control" type="text" id="tags" required="" placeholder="Introduzca su especialización...">
        <i class="fa fa-css3"></i>
      </div>
    </div>
    <div class="form-group">
      <label for="email">Attachment:</label>
      <div class="relative">
        <div class="input-group">
          <label class="input-group-btn">
            <span class="btn btn-default">Browse&hellip;
              <input type="file" style="display: none;" multiple>
            </span>
          </label>
          <input type="text" class="form-control" required="" placeholder="Adjuntar archivo..." readonly>
          <i class="fa fa-link"></i>
        </div>
      </div>
    </div>
    <div class="tright">
      <a href="">
        <button class="movebtn movebtnre" type="reset">
          <i class="fa fa-fw fa-refresh"></i>
          Reset 
        </button>
      </a>
      <a href="">
        <button class="movebtn movebtnsu" type="submit">
          Submit 
          <i class="fa fa-fw fa-paper-plane"></i>
        </button>
      </a>
    </div>
  </form>
  <div class="thanks" style="display: none;">
    <h4>Thank you!</h4>
    <p>
      <small>Your message has been successfully sent.</small>
    </p>
  </div>
      <?php
      require("../componentes/footer.php");
      ?>
    </body>
</html>