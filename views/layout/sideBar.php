<aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
    <section class="sidebar">
        <div class="w-80px mt-3 mb-3 ml-3">
            <img src="<?=base_url?>views/assets/img/logo.png" alt="">
        </div>
        <div class="relative">
            <div class="user-panel p-3 light mb-2">
                <div>
                    <div class="float-left info">
                        <h6 class="font-weight-light mt-2 mb-1"><?=$_SESSION['nombre']?></h6>
                        <a href="#"><i class="icon-circle text-primary blink"></i> Online</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header"><strong>Menu Navegación</strong></li>
            <li class="treeview">
                <a href="<?=base_url?>DashBoard/Panel">
                    <i class="icon icon-poll blue-text s-18"></i><span>Dashboard</span> <i class="s-18 pull-right"></i>
                </a>
            </li>

            <li class="treeview">
                <a href="<?=base_url?>DashBoard/Reserva">
                    <i class="icon icon-calendar-o purple-text s-18"></i><span>Reservación</span> <i class="s-18 pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="<?=base_url?>CheckOut/ListaReservas">
                    <i class="icon icon-arrow-left purple-text s-18"></i><span>Check Out</span> <i class="s-18 pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="icon icon-money-1 light-green-text s-18"></i>Modulo Caja<i class="icon icon-angle-left s-18 pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?=base_url?>Caja/AperturaCaja"><i class="icon icon-money2 amber-text s-14"></i>Apertura Caja</a>
                    </li>
                    <li>
                        <a href="<?=base_url?>Caja/CierreCaja"><i class="icon icon-money-bag amber-text s-14"></i>Cierre Caja</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?=base_url?>Egresos/Registrar">
                    <i class="icon icon-attach_money light-green-text s-18"></i><span>Egresos</span> <i class="s-18 pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="icon icon-sliders pink-text s-18"></i><span>Configuración</span>
                    <i class="icon icon-angle-left s-18 pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?=base_url?>Configuracion/RegistrarHabitacion"><i class="icon icon-bed amber-text s-14"></i> <span>Configurar habitaciones</span></a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?=base_url?>Cliente/ListaClientes">
                    <i class="icon icon-user pink-text s-18"></i><span>Clientes</span> <i class="s-18 pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="<?=base_url?>Reporte/Lista"><i class="icon icon-bar-chart2 pink-text s-18"></i><span>Reportes</span></a>
            </li>
            <li class="treeview ">
                <a href="#">
                    <i class="icon icon-user-secret dark-grey-text s-18 "></i><span>Administración</span>
                    <i class="icon icon-angle-left s-18 pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?=base_url?>User/ListaUsuarios"><i class="icon icon icon-user light-green-text"></i>Usuarios</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?=base_url?>User/Logout">
                    <i class="icon icon-power-off dark-grey-text s-18"></i><span>Cerrar Sesion</span> <i class="s-18 pull-right"></i>
                </a>
            </li>
        </ul>
    </section>
</aside>
<!--Sidebar End-->
<div class="has-sidebar-left">
    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
                <div class="search-bar">
                    <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50" type="text"
                           placeholder="start typing...">
                </div>
                <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-expanded="false"
                   aria-label="Toggle navigation" class="paper-nav-toggle paper-nav-white active "><i></i></a>
            </div>
        </div>
    </div>
    <div class="sticky">
        <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3">
            <div class="relative">
                <a href="#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                    <i></i>
                </a>
            </div>
        </div>
    </div>
</div>