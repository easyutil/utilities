<?php

namespace Easyutil\Utilities;

class Percentage
{
    /**
     * Retorno a string numérica formatada para valor com decimais com ponto para o banco de dados.
     * @param $value
     * @param int $decimals
     * @return string|string[]
     */
    public static function formatToDatabase($value)
    {
        $value = str_replace("%", '', $value);
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
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
        $role = "/^[0-9]{1,3}([.]([0-9]{3}))*[,]([.]{0})[0-9]{0,2}$/";

        if(preg_match($role, $value) || is_numeric($value) && $value <= 100){
            return true;
        }
        return false;
    }
}
