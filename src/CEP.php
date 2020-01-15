<?php

namespace Easyutil\Utilities;

class CEP
{
    /**
     * Aplicação de máscara
     * @param $cep
     * @return string
     */
    public static function format($cep) : string
    {
        if (strlen($cep) == 0) {
            return $cep;
        }

        $cep = str_pad($cep, 8, "0", STR_PAD_LEFT);

        $p1 = substr($cep, 0, 2);
        $p2 = substr($cep, 2, 3);
        $p3 = substr($cep, 5, 3);
        $cep = "{$p1}.{$p2}-{$p3}";

        return $cep;
    }

    /**
     * Remoção de máscara, para inserção no banco de dados
     * @param string $cep
     * @return string
     */
    public static function formatToDatabase(string $cep) : string
    {
        if (strlen($cep) == 10) {
            $p1 = substr($cep, 0, 2);
            $p2 = substr($cep, 3, 3);
            $p3 = substr($cep, 7, 3);
            $cep = $p1 . $p2 . $p3;
        }
        return $cep;
    }

    /**
     * Verifica se cep é válido
     * @param $cep
     * @param bool $masked
     * @return bool
     */
    public static function valid($cep, bool $masked = true) : bool
    {
        if (strlen($cep) == 0) {
            throw new \InvalidArgumentException('Parâmetro cep inválido');
        }

        if ($masked === false) {
            $cep = self::format($cep);
        }

        if (strlen($cep) != 10) {
            return false;
        }

        if (!preg_match("/^[0-9]{2}.[0-9]{3}-[0-9]{3}/", $cep)) {
            return false;
        }

        return true;
    }
}
