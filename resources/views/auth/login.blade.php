<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="{{ asset('favicon.png') }}"/>
  <title>Login - Prestaciones</title>
  <link rel="stylesheet" type="text/css" href="assets_login/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets_login/css/animate.min.css">
  <link rel="stylesheet" type="text/css" href="assets_login/css/login.css">
  <link rel="stylesheet" type="text/css" href="assets_login/css/spin.css">
  <link rel="stylesheet" type="text/css" href="assets_login/css/sweetalert.css">
  <style>
    .login-form {border-radius: 25px;}
  </style>
</head>
<body>
  <img class="wave" src="assets_login/img/layer1.svg">
  <img class="wavecel" src="assets_login/img/layer2.svg">
      <div class="container">
        <div class="img animate__animated animate__fadeInTopLeft">
          <img src="assets_login/img/hcc_logo.svg">
        </div>
        <div class="login-content animate__animated animate__fadeInTopRight">
          <form method="post" action="login" autocomplete="off">
              {{ csrf_field() }}
              <img src="assets_login/img/doc.png">
              <h2 class="title" style="font-size:1.6rem;">Prestaciones</h2>
              <input class="form-control mb-2 login-form" name="user" placeholder="Ingresa tu Usuario" autocomplete="off">
              <input class="form-control login-form" name="password" type="password" placeholder="Ingresa tu Contraseña" autocomplete="off">
              <button type="submit" class="btn" type="button"  id="btncarga">Ingresar</button>
              <center>
                <div  id="spinlod" style="display: none;">
                <div class="spinner-box">
                  <div class="configure-border-1">  
                    <div class="configure-core"></div>
                  </div>  
                  <div class="configure-border-2">
                    <div class="configure-core"></div>
                  </div> 
                </div>
                </div>
              </center>
          </form>
        </div>
      </div>
  <div class="footer">
    Dpto.Informatica.Calama.
  </div>
  <script type="text/javascript" src="assets_login/js/sweetalert.js"></script>
  <script type="text/javascript" src="assets_login/js/bootstrap.min.js"></script>
  <script>
    @error('user')
      const Toast = Swal.mixin({
      toast: true,
      position: 'bottom-end',
      showConfirmButton: false,
      timer: 5000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'error',
      title: '{{$message}}'
    })
    @enderror

    @error('password')
    const Toast = Swal.mixin({
      toast: true,
      position: 'bottom-end',
      showConfirmButton: false,
      timer: 5000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'error',
      title: '{{$message}}'
    })
    @enderror
  </script>
</body>
</html>