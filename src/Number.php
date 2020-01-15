<?php

namespace Easyutil\Utilities;

class Number
{
    /**
     * Converte para formato brasileiro
     * @param $value
     * @param int $decimal
     * @return string
     */
    public static function format($value, int $decimal = 2) : string
    {
        if(empty($value)){
            return '0,00';
        }

        $value = number_format($value, $decimal, ',', '.');
        return $value;
    }

    /**
     * Converte para ser inserido no banco de dados.
     * Atualmente remove caracteres de dinheiro e porcentagem
     * @param $value
     * @return mixed
     */
    public static function formatToDatabase($value)
    {
        $value = str_replace("R$ ", '', $value);
        $value = str_replace("%", '', $value);
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
        return $value;
    }

    /**
     * Converte para formato milhar
     * @param $value
     * @return mixed
     */
    public static function formatToThousand($value)
    {
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
        $value = number_format($value, 0, ".", ".");
        return $value;
    }
}
