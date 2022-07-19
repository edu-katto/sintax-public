<?php require_once 'views/layout/head.php' ?>
    <link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
    <title>Registrar Cliente</title>

    <div id="app">
        <?php require_once 'views/layout/sideBar.php' ?>
        <div class="page has-sidebar-left height-full">
            <header class="blue accent-3 relative">
                <div class="container-fluid text-white">
                    <div class="row p-t-b-10 ">
                        <div class="col">
                            <h4>
                                <i class="icon-database"></i>
                                Actualizar Clientes
                            </h4>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container-fluid animatedParent animateOnce">
                <div class="animated fadeInUpShort">
                    <div class="row my-3 justify-content-center">
                        <div class="col-md-6">
                            <form action="<?=base_url?>Cliente/Actualizar" method="post">
                                <div class="card no-b no-r">
                                    <div class="card-body">
                                        <h5 class="card-title">Actualizar Datos Cliente</h5>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="form-group m-0">
                                                    <label for="name" class="col-form-label s-12">Nombre</label>
                                                    <input id="name" placeholder="Ingresar Nombre" class="form-control r-0 light s-12 " value="<?=$data->nombre?>" type="text" name="nombre" required>
                                                    <input value="<?=$data->cod_cliente?>" type="hidden" name="cod_cliente">
                                                </div>
                                                <div class="form-group m-0">
                                                    <label class="my-1 mr-2">Tipo Cliente</label>
                                                    <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" name="tipoCliente" required>
                                                        <?php while ($tipoCliente = $listaTipoCliente->fetchObject()):?>
                                                            <option <?= $tipoCliente->cod_tipo_cliente == $data->cod_tipo_cliente ? 'selected' : '' ?> value="<?=$tipoCliente->cod_tipo_cliente?>"><?=$tipoCliente->tipo_cliente?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6 m-0">
                                                        <label class="my-1 mr-2">Tipo Documento</label>
                                                        <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" name="tipoDocumento" required>
                                                            <?php while ($list = $listDocumento->fetchObject()):?>
                                                                <option <?= $list->cod_tipo_documento == $data->cod_tipo_documento ? 'selected' : '' ?> value="<?=$list->cod_tipo_documento?>"><?=$list->tipo_documento?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6 m-0">
                                                        <label class="col-form-label s-12"><i class="icon-fingerprint"></i>Documento</label>
                                                        <input type="hidden" name="documento" value="<?=$data->documento?>" class="form-control r-0 light s-12">
                                                        <input type="number" placeholder="Ingresar Documento" value="<?=$data->documento?>" class="form-control r-0 light s-12" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-6 m-0">
                                                <label class="col-form-label s-12">Telfono</label>
                                                <input type="text" class="form-control r-0 light s-12" placeholder="Ingresar Telefono" value="<?=$data->telefono?>" name="telefono" required>
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                <label class="col-form-label s-12">Direccion</label>
                                                <input type="text" class="form-control r-0 light s-12" placeholder="Ingrear Direccion" value="<?=$data->direccion?>" name="direccion" required>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary btn-lg"><i class="icon-exchange mr-2"></i>Actualizar Cliente</button>
                                        <a href="<?=base_url?>Cliente/ListaClientes" class="btn btn-warning btn-lg"><i class="icon-chevron-left mr-2"></i>Regresar</a>
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
