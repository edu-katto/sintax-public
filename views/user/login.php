<?php require_once 'views/layout/head.php' ?>
<link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
<title>Login</title>

<div id="app">
    <div class="page parallel">
        <div class="d-flex row">
            <div class="col-md-3 white">
                <div class="p-5 mt-5">
                    <img src="<?=base_url?>views/assets/img/logo.png" alt=""/>
                </div>
                <div class="p-5">
                    <h3>Bienvenido de vuelta</h3>
                    <p>Iniciar sesión ahora para administrar tu hotel.</p>
                    <form action="<?=base_url?>User/CheckLogin" method="POST">
                        <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                            <input type="text" class="form-control form-control-lg" name="usuario" placeholder="usuario">
                        </div>
                        <div class="form-group has-icon"><i class="icon-user-secret"></i>
                            <input type="password" class="form-control form-control-lg" name="password" placeholder="Contraseña">
                        </div>
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Inicio">
                    </form>
                </div>
            </div>
            <div class="col-md-9 height-full blue accent-3 align-self-center text-center" data-bg-repeat="false"
                 data-bg-possition="center" style="background: url('<?=base_url?>views/assets/img/icon-car-hotel.png') #FFEFE4">
            </div>
        </div>
    </div>
<?php require_once 'views/layout/footer.php' ?>
    <?php if (!empty($_SESSION['message'])): ?>
        <script>
            Swal.fire({
                title: "<?=$_SESSION['message'][0]?>",
                text: "<?=$_SESSION['message'][1]?>",
                icon: "<?=$_SESSION['message'][2]?>"
            })
        </script>
    <?php endif; unset($_SESSION['message']); ?>
