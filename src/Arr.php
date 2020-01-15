<?php

namespace Easyutil\Utilities;

class Arr extends \Illuminate\Support\Arr
{
    /**
     * Conversão das chaves de um array para minúsculo
     * @param array $array
     * @return array
     */
    public static function keyToLower(array $array) : array
    {
        return array_map(function($item){
            if(is_array($item)) {
                $item = self::keyToLower($item);
            }

            return $item;
        }, array_change_key_case($array, CASE_LOWER));
    }

    /**
     * Converte array multidimensional para chave e valor
     * @param array $array
     * @return array
     */
    public static function getToKeyAndValue(array $array) : array
    {
        $newArray = [];
        $result = array_map(function($item) use($newArray){
            $newArray[$item['campo']] = $item['mensagem'];
            return $newArray;
        }, $array);

        return Arr::collapse($result);
    }
}
