<?php
App::uses('AppHelper','View/Helper');

class CarritoHelper extends AppHelper{
    public function calcularCarrito(){
        $valor = 0;
        if(isset($_CarritoCantidad)){
            for($i=0;$i<$_CarritoCantidad;$i++){
                // Calculamos valor de carrito
                $valor = $valor + 1;
            }
        }else{
            $_CarritoCantidad=0;
        }
        return $valor;
    }
}

?>