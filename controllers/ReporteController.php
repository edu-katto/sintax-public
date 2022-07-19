<?php

require_once 'models/ReporteModel.php';

class ReporteController{
    public function Lista(){
        utils::isSessionInit();
        require_once 'views/reporte/buscarReporte.php';
    }

    public function Grafica(){
        utils::isSessionInit();
        if ( utils::existPOST(['fecha_inicio','fecha_fin']) ){

            $fechaInicio = utils::protege($_POST['fecha_inicio']);
            $fechaFin = utils::protege($_POST['fecha_fin']);

            $reporte = new ReporteModel();

            $reporte->setFechaInicio($fechaInicio);
            $reporte->setFechaFin($fechaFin);

            //repoerte tres
            $reporteTres = $reporte->reporteTres();

            $tresEncabezado = '[';
            $tresDatos =  '[';
            while ($tres = $reporteTres->fetchObject()){
                $tresEncabezado .= "'$tres->nombre_cliente',";
                $tresDatos .= "'$tres->CantidadUsuario',";
            }
            $tresEncabezado .= ']';
            $tresDatos .= ']';

            //repoerte cuatro
            $reporteCuatro = $reporte->reporteCuatro();

            $cuatroDatos =  '[';
            while ($cuatro = $reporteCuatro->fetchObject()){;
                $cuatroDatos .= "'$cuatro->Ganancia',";
            }
            $cuatroDatos .= ']';

            //repoerte cinco
            $reporteCinco = $reporte->reporteCinco();

            $cincoEncabezado = '[';
            $cincoDatos =  '[';
            while ($cinco = $reporteCinco->fetchObject()){;
                $cincoEncabezado .= "'$cinco->nombre_cliente',";
                $cincoDatos .= "'$cinco->Diferencia',";
            }
            $cincoEncabezado .= ']';
            $cincoDatos .= ']';

            require_once 'views/reporte/grafica.php';

        } else {
            echo "Todos los datos son obligatorios";
        }
    }
}