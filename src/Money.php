<?php

namespace Easyutil\Utilities;

class Money
{
    /**
     * Retorno a string numérica formatada para valor com decimais com ponto para o banco de dados.
     * @param $value
     * @param int $decimals
     * @return string|string[]
     */
    public static function formatToDatabase($value, $decimals = 2)
    {
        $value = str_replace("R$ ", '', $value);
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
        $value = number_format($value, $decimals);
        return $value;
    }

    /**
     * Retorno a string numérica formatada para valor com decimais com virgula
     * @param $value
     * @param int $decimals
     * @return string
     */
    public static function format($value, $decimals = 2)
    {
        if(!empty($value)) {
            $value = number_format($value, $decimals, ',', '.');
            return $value;
        }
        return '0,00';
    }

    /**
     * Valida se o valor é numérico
     * @param $value
     * @return boolean
     */
    public static function valid($value) : bool
    {
        $value = (string) $value;
        $role = "/^([0-9])*[.]([.]{0})[0-9]{0,2}$/";

        if(preg_match($role, $value) || is_numeric($value)){
            return true;
        }
        return false;
    }

    /**
     * Conversão de um valor para centavos
     * @param float $value
     * @param int $decimals
     * @return int
     */
    public static function toCents(float $value, $decimals = 2) : int
    {
        $value = number_format($value, $decimals);
        $integer = (int)$value;
        $cents = (float)bcsub($value, $integer, $decimals) * 100;
        return (int)bcadd(bcmul($integer, 100), $cents);
    }
}
