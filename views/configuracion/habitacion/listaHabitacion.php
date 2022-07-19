<?php require_once 'views/layout/head.php' ?>
<link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
<title>Lista Habitacion</title>

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
                            <a class="nav-link active"  href="<?=base_url?>Configuracion/ListaHabitacion"><i class="icon icon-home2"></i>Todos las habitaciones</a>
                        </li>
                        <li>
                            <a class="nav-link"  href="<?=base_url?>Configuracion/RegistrarHabitacion" ><i class="icon icon-plus-circle"></i> Crear Nueva Habitacion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="content-wrapper animatedParent animateOnce">
            <div class="container-fluid">
                <section class="paper-card">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <!-- tabla -->
                                    <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Detalle</th>
                                            <th>Habitacion</th>
                                            <th>Nivel Habitacion</th>
                                            <th>Estado Habitacion</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($habitacion = $lista->fetchObject()):?>
                                            <tr>
                                                <td><?=$habitacion->cod_habitacion?></td>
                                                <td><?=$habitacion->nombre?></td>
                                                <td><?=$habitacion->precio?></td>
                                                <td><?=$habitacion->detalle?></td>
                                                <td><?=$habitacion->habitacion?></td>
                                                <td><?=$habitacion->nivel_habitacion?></td>
                                                <td><?=$habitacion->estado_habitacion?></td>
                                                <td>
                                                    <a href="<?=base_url?>Configuracion/ActualizarHabitacion&cod_habitacion=<?=$habitacion->cod_habitacion?>" class="badge bg-success"><i class="s-24 icon-exchange text-white"></i></a>
                                                    <a href="<?=base_url?>Configuracion/EliminarHabitacion&cod_habitacion=<?=$habitacion->cod_habitacion?>" class="badge bg-danger"><i class="s-24 icon-trash-can text-white"></i></a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                    <!-- tabla -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php' ?>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
<?php if (!empty($_SESSION['message'])): ?>
    <script>
        Swal.fire({
            title: "<?=$_SESSION['message'][0]?>",
            text: "<?=$_SESSION['message'][1]?>",
            icon: "<?=$_SESSION['message'][2]?>"
        })
    </script>
<?php endif; unset($_SESSION['message']); ?>