<?php

namespace Easyutil\Utilities;

class CNPJ
{
    /**
     * Aplicação de máscara
     * @param $cnpj
     * @return string
     */
    public static function format($cnpj)
    {
        if(strlen(trim($cnpj)) == 14){
            $p1 = substr($cnpj, 0 , 2);
            $p2 = substr($cnpj, 2, 3);
            $p3 = substr($cnpj, 5, 3);
            $p4 = substr($cnpj, 8, 4);
            $p5 = substr($cnpj, 12 , 2);
            $cnpj = "$p1.$p2.$p3/$p4-$p5";
        }
        return $cnpj;
    }

    /**
     * Remoção de máscara, para inserção no banco de dados
     * @param $cnpj
     * @return string
     */
    public static function formatToDatabase(string $cnpj) : string
    {
        $cnpj = str_replace ('.', '', $cnpj);
        $cnpj = str_replace ('-', '', $cnpj);
        $cnpj = str_replace ('/', '', $cnpj);
        return $cnpj;
    }

    /**
     * Verifica se cpf é válido
     * @param $cnpj
     * @param bool $masked
     * @return bool
     */
    public static function valid($cnpj, bool $masked = true) : bool
    {
        if(strlen($cnpj) == 0){
            throw new \InvalidArgumentException('Parâmetro cnpj inválido');
        }

        if($masked === false){
            $cnpj = self::format($cnpj);
        }

        $cnpj = str_pad(str_replace(array('.', '-', '/'),'', $cnpj),14,'0',STR_PAD_LEFT);
        if (strlen($cnpj) != 14){
            return false;
        }

        for($t = 12; $t < 14; $t++){
            for($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++){
                $d += $cnpj{$c} * $p;
                $p  = ($p < 3) ? 9 : --$p;
            }

            $d = ((10 * $d) % 11) % 10;
            if($cnpj{$c} != $d){
                return false;
            }
        }

        return true;
    }
}
