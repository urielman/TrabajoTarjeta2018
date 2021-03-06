<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;

    protected $colectivo;

    protected $tarjeta;

    protected $fecha;

    protected $tipoTarjeta;

    protected $saldo;

    protected $id;

    //tipo de boleto (Normal, Viaje Plus)
    protected $tipoBoleto;
    
    public function __construct($valor, $colectivo, $tarjeta, $fecha, $tipoTarjeta, $saldo, $id, $viajesPlusAbonados) {
        $this->valor = $valor;
        $this->colectivo = $colectivo;
        $this->tarjeta = $tarjeta;
        $this->fecha = $fecha;
        $this->tipoTarjeta = $tipoTarjeta;
        $this->saldo = $saldo;
        $this->id = $id;
        $this->tipoBoleto = $this->mostrarViajePlusEnBoleto($viajesPlusAbonados, $tarjeta);
    }

     /**
      *  Asigna el tipo de boleto (Normal, Viaje Plus) o si se abonaron Viajes Plus
      *
      * @param int $viajesPlusAbonados
      * @param Tarjeta $tarjeta
      * @return string
      */
    public function mostrarViajePlusEnBoleto($viajesPlusAbonados, $tarjeta) {
        
        if ($tarjeta->obtenerTrasbordo()) {
                    return "TRASBORDO";
        }

        if ($viajesPlusAbonados > 0) {
            $valorPlus = $viajesPlusAbonados*$tarjeta->valorBoletoCompleto();
            $totalAbonado = $valorPlus + $this->valor;
            
            return "ABONA VIAJES PLUS: $" . $valorPlus . "\nTOTAL ABONADO: $" . $totalAbonado;
        }

        if ($viajesPlusAbonados == 0) {
            return "NORMAL";
        }

        if ($viajesPlusAbonados == -1) {
            return "VIAJE PLUS";
        }

        return "Ult. PLUS";
    }

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */
    public function obtenerValor() {
        return $this->valor;
    }

    /**
     * Devuelve un objeto que representa el colectivo donde se viajó.
     *
     * @return ColectivoInterface
     */
    public function obtenerColectivo() {
        return $this->colectivo;
    }
    
    /**
     * Devuelve la línea del colectivo
     *
     * @return int
     */
    public function obtenerLineaColectivo() {
        return $this->colectivo->linea();
    }
    
    /**
     * Devuelve la fecha.
     */
    public function obtenerFecha() {
        return $this->fecha;
    }

    /**
     * Devuelve el tipo de la tarjeta.
     */
    public function obtenerTipoTarjeta() {
        return $this->tipoTarjeta;
    }
    /**
     * Devuelve el saldo de la tarjeta
     *
     * @return int
     */
    public function obtenerSaldo() {
        return $this->saldo;
    }

    /**
     * Devuelve la id del boleto
     *
     * @return int
     */
    public function obtenerId() {
        return $this->id;
    }
    
    /**
     * Devuelve el tipo del boleto.
     */
    public function obtenerTipoBoleto() {
        return $this->tipoBoleto;
    }

}
