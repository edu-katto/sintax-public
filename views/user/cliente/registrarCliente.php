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
                            Clientes
                        </h4>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                        <li>
                            <a class="nav-link"  href="<?=base_url?>Cliente/ListaClientes"><i class="icon icon-home2"></i>Todos los cientes</a>
                        </li>
                        <li>
                            <a class="nav-link active"  href="<?=base_url?>Cliente/RegistrarCliente" ><i class="icon icon-plus-circle"></i> Crear Nuevo Cliente</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="container-fluid animatedParent animateOnce">
            <div class="animated fadeInUpShort">
                <div class="row my-3 justify-content-center">
                    <div class="col-md-6">
                        <form action="<?=base_url?>Cliente/RegistrarCliente" method="post">
                            <div class="card no-b no-r">
                                <div class="card-body">
                                    <h5 class="card-title">Datos cliente</h5>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="name" class="col-form-label s-12">Nombre</label>
                                                <input id="name" placeholder="Ingresar Nombre" class="form-control r-0 light s-12 " type="text" name="nombre" required>
                                            </div>
                                            <div class="form-group m-0">
                                                <label class="my-1 mr-2">Tipo Cliente</label>
                                                <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" name="tipoCliente" required>
                                                    <?php while ($tipoCliente = $listaTipoCliente->fetchObject()):?>
                                                        <option value="<?=$tipoCliente->cod_tipo_cliente?>"><?=$tipoCliente->tipo_cliente?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-6 m-0">
                                                    <label class="my-1 mr-2">Tipo Documento</label>
                                                    <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" name="tipoDocumento" required>
                                                        <?php while ($list = $listDocumento->fetchObject()):?>
                                                            <option value="<?=$list->cod_tipo_documento?>"><?=$list->tipo_documento?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-6 m-0">
                                                    <label class="col-form-label s-12"><i class="icon-fingerprint"></i>Documento</label>
                                                    <input type="number" placeholder="Ingresar Documento" class="form-control r-0 light s-12" name="documento" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6 m-0">
                                            <label class="col-form-label s-12">Telfono</label>
                                            <input type="text" class="form-control r-0 light s-12" placeholder="Ingresar Telefono" name="telefono" required>
                                        </div>
                                        <div class="form-group col-6 m-0">
                                            <label class="col-form-label s-12">Direccion</label>
                                            <input type="text" class="form-control r-0 light s-12" placeholder="Ingrear Direccion" name="direccion" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Registrar Cliente</button>
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
