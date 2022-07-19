<?php require_once 'views/layout/head.php' ?>
    <link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
    <title>Registrar Habitacion</title>

    <div id="app">
        <?php require_once 'views/layout/sideBar.php' ?>
        <div class="page has-sidebar-left height-full">
            <header class="blue accent-3 relative">
                <div class="container-fluid text-white">
                    <div class="row p-t-b-10 ">
                        <div class="col">
                            <h4>
                                <i class="icon-bed"></i>
                                Habitaciones
                            </h4>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                            <li>
                                <a class="nav-link"  href="<?=base_url?>Configuracion/ListaHabitacion"><i class="icon icon-home2"></i>Todos las habitaciones</a>
                            </li>
                            <li>
                                <a class="nav-link active"  href="<?=base_url?>Configuracion/RegistrarHabitacion" ><i class="icon icon-plus-circle"></i> Crear Nueva Habitacion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <div class="container-fluid animatedParent animateOnce">
                <div class="animated fadeInUpShort">
                    <div class="row my-3 justify-content-center">
                        <div class="col-md-6">
                            <form action="<?=base_url?>Configuracion/RegistrarHabitacion" method="post">
                                <div class="card no-b no-r">
                                    <div class="card-body">
                                        <h5 class="card-title">Datos Habitacion</h5>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="form-row">
                                                    <div class="form-group col-6 m-0">
                                                        <label class="col-form-label s-12">Nombre Habitacion</label>
                                                        <input placeholder="Ingresar Nombre" class="form-control r-0 light s-12 " type="text" name="nombre_habitacion" required>
                                                    </div>
                                                    <div class="form-group col-6 m-0">
                                                        <label class="col-form-label s-12">Precio Habitacion</label>
                                                        <input placeholder="Ingresar Precio" class="form-control r-0 light s-12 " type="number" name="precio_habitacion" required>
                                                    </div>
                                                </div>
                                                <div class="form-group m-0">
                                                    <label class="col-form-label s-12">Detalle Habitacion</label>
                                                    <textarea class="form-control r-0 light s-12" name="detalle_habitacion" rows="3" required></textarea>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6 m-0">
                                                        <label class="my-1 mr-2">Tipo Habitacion</label>
                                                        <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" name="tipo_habitacion" required>
                                                            <?php while ($tipoHabitacion = $listaTipoHabitacion->fetchObject()):?>
                                                                <option value="<?=$tipoHabitacion->cod_tipo_habitacion?>"><?=$tipoHabitacion->habitacion?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6 m-0">
                                                        <label class="my-1 mr-2">Piso Habitacion</label>
                                                        <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" name="piso_habitacion" required>
                                                            <?php while ($pisoHabitacion = $listaPisoHabitacion->fetchObject()):?>
                                                                <option value="<?=$pisoHabitacion->cod_nivel_habitacion?>"><?=$pisoHabitacion->nivel_habitacion?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Registrar Habitacion</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
