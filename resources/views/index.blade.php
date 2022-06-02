<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Sistema RiesgoCero">
    <meta name="author" content="Roberto Gallardo">

    <title>Login</title>

    <!-- FAVION -->
    <link rel="icon" href="{{ url('img/siccectch1_logo.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    @toastr_css
</head>

<body>
    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="img/bg.svg">
        </div>

        <div class="login-content">
            <form method="POST" action="{{ route('validateLogin') }}">
                @csrf
                <img src="img/avatar.svg">
                <h2 class="title">Bienvenido</h2>

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input type="text" name="username" class="input">
                    </div>
                </div>
  
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" name="password" class="input">
                    </div>
                </div>

                <!--<a href="#">¿Olvidó su contraseña?</a>-->
                <input type="submit" class="btn" value="Ingresar">
            </form>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    @toastr_js
    @toastr_render
</body>

</html>