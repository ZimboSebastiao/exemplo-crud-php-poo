<?php
namespace ExemploCrudPoo;
use Exception, PDO;

abstract class Utilitarios {

    private PDO $conexao;
    private float $valor;
    

    public function __construct() {
        $this->conexao = Banco::conecta();
    }


    

    public static function formatarPreco( float $valor ):string {
        $valorFormatado = number_format($valor, 2, ",", ".");
        return "R$ " . $valorFormatado;
    }
    
    public static function calcularTotal(float $valor, int $qtd):string {
        $total = $valor * $qtd;
        return formatarPreco($total);
    }


    /**
     * Get the value of valor
     *
     * @return float
     */
    public function getValor(): float
    {
        return $this->valor;
    }
}