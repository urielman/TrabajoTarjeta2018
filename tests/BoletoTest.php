<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    public function testSaldoCero() {
        $tiempo = new TiempoFalso();
        $id = "123456";
        $tarjeta = new Tarjeta($tiempo, $id);
    
        $linea = "144 N";
        $empresa = 'Auckland'; 
        $numero = 2;
        $colectivo = new Colectivo($linea, $empresa, $numero);
            
        $boleto = new Boleto($tarjeta->valorBoleto(), $colectivo, $tarjeta, date("d/m/y H:i", time()), get_class($tarjeta), $tarjeta->obtenerSaldo(), $tarjeta->obtenerId(), 0);
        

        $this->assertEquals($boleto->obtenerValor(), $tarjeta->valorBoleto());
        $this->assertEquals($boleto->obtenerColectivo(), $colectivo);
        $this->assertEquals($boleto->obtenerFecha(), date("d/m/y H:i", time()));
        $this->assertEquals($boleto->obtenerTipoTarjeta(), get_class($tarjeta));
        $this->assertEquals($boleto->obtenerSaldo(), $tarjeta->obtenerSaldo());
        $this->assertEquals($boleto->obtenerId(), $tarjeta->obtenerId());
        $this->assertEquals($boleto->obtenerLineaColectivo(), $linea);
    }
}
