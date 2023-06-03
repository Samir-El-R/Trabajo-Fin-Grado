<!DOCTYPE html>
<html>
<head>
    <title>Error de inicio de sesión</title>
    <style>    .container {
        z-index: 499;
  position: absolute;
  margin: auto;
  top:0;
  right:0;
  bottom:0;
  left:0;
  width: 400px;
  height: 400px;
  border-radius: 2px;
  box-shadow: 1px 2px 10px 0px rgba(0,0,0,0.3);
	overflow: hidden;
  background: #3F3F3F;
  color: #415868;
	font-family: 'Open Sans', Helvetica, sans-serif;
}

.new-box {
  position: absolute;
	margin:auto;
  top: 0;
  left: 0;
  bottom:0;
  right:0;
  width: 280px;
	height: 210px;
	background: #fff;
	border-radius: 3px;
	box-shadow: 4px 8px 12px 0 rgba(0,0,0,0.4);
	text-align: center;
	overflow: hidden;
	animation: show-new .7s ease-in-out;
}

.hide {
   animation: hide-new .6s ease-in-out both;
}
  
.new-box img {
  position: relative;
  top: 15px;
  height: 38px;
  width: 44px;
}
  
.new-box .h2{
  width: 180px;
  color: gray;
  font-size: 20px;
  font-weight: 400;
  position: relative;
  left: 15%;
  top: 10px;
}

.new-box p {
  width: 180px;
  color: gray;
  font-size: 14px;
  position: relative;
  left: 15%;
}

.new-box .button {
  position: absolute;
  height: 40px;
  bottom: 0;
  left: 0;
  right: 0;
  background: #F65656;
  color: #fff;
  line-height: 40px;
  font-size: 14px;
  font-weight: 400;
  cursor: pointer;
  transition: background .3s ease-in-out;
  width:100%;
}
.new-box .button:hover {
    background: #EC3434;
}

@keyframes show-new {
  0% {
    transform: scale(0);
  }
  60% {
    transform: scale(1.1);
  }
  80% {
    transform: scale(0.9);
  }
  100% {
    transform: scale(1.0);
  }
}
@keyframes hide-new {
  0% {
    transform: scale(1);
  }
  20% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(0);
  }
}
  </style>

</head>


<body>
<div class="container" id="error">
    <div class="new-box" id="new-box">
      <img src="http://100dayscss.com/codepen/alert.png">
      <h2>Oh vaya|</h2>
      <p>Compruebe si el correo y la contraseña estan bien escritos</p>
      <div class="button" id="button" >Deshacer</div>
    <label for="button"></label>
    </div>
  </div>
</body>
</html>

<script>
    //esconder error
    document.getElementById("error").addEventListener('click',function() {
        document.getElementById("error").hidden="true";
    })
  </script>

