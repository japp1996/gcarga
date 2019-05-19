<?php
    namespace App\Libraries;

    class GeoDistance 
    {
        /**
         * Cálculo de la distancia entre 2 puntos en función de su latitud/longitud
         * 
         * param $point1_lat Latitud del punto 1 expresada en formato decimal
         * param $point1_long Longitud del punto 1 expresada en formato decimal
         * param $point2_lat Latitud del punto 2 expresada en formato decimal
         * param $point2_long Longitud del punto 2 expresada en formato decimal
         * param $unit Unidad en que se quiere expresar el resultado del calculo, por defecto en KM
         * param $decimals Cantidad de decimales para el resultado
         * 
         */
        public static function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2)
        {
            $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
 
            // Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
            switch($unit) {
                case 'km':
                    $distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
                    break;
                case 'mi':
                    $distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
                    break;
                case 'nmi':
                    $distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
            }
            $result = round($distance, $decimals);
            return is_nan($result) ? 0 : $result;
        }
    }
    
