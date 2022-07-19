<?php require_once 'views/layout/head.php' ?>
<link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
<title>Lista Reservas</title>

<div id="app">
    <?php require_once 'views/layout/sideBar.php' ?>
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10">
                    <div class="col">
                        <h4>
                            <i class="icon-calendar"></i>
                            Reservacion
                        </h4>
                    </div>
                </div>
                <div class="row ">
                    <ul class="nav responsive-tab nav-material nav-material-white">
                        <li>
                            <a class="nav-link" href="<?=base_url?>DashBoard/Reserva" ><i class="icon icon-list"></i>Cuadro de reservaciones</a>
                        </li>
                        <li>
                            <a class="nav-link" href="<?=base_url?>Reserva/RegistrarReserva"><i class="icon icon-clipboard-add"></i>Crear reservacion</a>
                        </li>
                        <li>
                            <a class="nav-link active" href="<?=base_url?>Reserva/ListaReserva"><i class="icon icon-trash-can"></i>Lista de reservaciones</a>
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
                                            <th>Nombre Cliente</th>
                                            <th>Documento</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Adelanto</th>
                                            <th>Nombre Habitacion</th>
                                            <th>Piso</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($reserva = $data->fetchObject()):?>
                                            <tr>
                                                <td><?=$reserva->cod_reserva?></td>
                                                <td><?=$reserva->nombre_cliente?></td>
                                                <td><?=$reserva->documento?></td>
                                                <td><?=$reserva->fecha_inicio?></td>
                                                <td><?=$reserva->fecha_fin?></td>
                                                <td><?=$reserva->adelanto?></td>
                                                <td><?=$reserva->nombre?></td>
                                                <td><?=$reserva->nivel_habitacion?></td>
                                                <td><?=$reserva->estado_reserva?></td>
                                                <td>
                                                    <a href="<?=base_url?>Reserva/Actualizar&cod_reserva=<?=$reserva->cod_reserva?>" class="badge bg-success"><i class="s-24 icon-exchange text-white"></i></a>
                                                    <a href="<?=base_url?>Reserva/Eliminar&cod_reserva=<?=$reserva->cod_reserva?>" class="badge bg-danger"><i class="s-24 icon-trash-can text-white"></i></a>
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