<?php require_once 'views/layout/head.php' ?>
    <link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
    <title>Administración</title>

    <div id="app">
        <?php require_once 'views/layout/sideBar.php' ?>
        <div class="has-sidebar-left">
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
                                <a class="nav-link active" href="<?=base_url?>DashBoard/Reserva" ><i class="icon icon-list"></i>Cuadro de reservaciones</a>
                            </li>
                            <li>
                                <a class="nav-link" href="<?=base_url?>Reserva/RegistrarReserva"><i class="icon icon-clipboard-add"></i>Crear reservacion</a>
                            </li>
                            <li>
                                <a class="nav-link" href="<?=base_url?>Reserva/ListaReserva"><i class="icon icon-trash-can"></i>Lista de reservaciones</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <div class="animatedParent animateOnce">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">
                        <!-- /.col -->
                        <div class="col-md-10 center">
                            <div class="card no-r no-b shadow">
                                <div class="card-body p-0">
                                    <div id="calendario"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="control-sidebar-bg shadow white fixed"></div>
    </div>
</div>

<?php require_once 'views/layout/footer.php' ?>
<script>
    $(document).ready(function (){
        var url = 'https://sintax.com.co/';
       $('#calendario').fullCalendar({
           header:{
               left:'today, prev, next',
               center:'title',
               right:'month, basicWeek, basicDay, agendaWeek, agendaDay'
           },
           eventClick:function (calEvent,jsEvent,view){
               window.location.href = url + "Reserva/Actualizar&cod_reserva=" + calEvent.id;
           },
           events: url + 'Reserva/FullCalendarAll'
       });
    });
</script>
