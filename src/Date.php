<?php

namespace Easyutil\Utilities;

use Carbon\Carbon;

class Date
{
    /**
     * Retorna a data formatada
     * @param $value
     * @param string $format
     * @return string
     */
    public static function format($value, $format = 'd/m/Y')
    {
        if (empty($value)) {
            return false;
        }

        return (new Carbon($value))->format($format);
    }

    /**
     * Caso seja o último dia do mês, monta array com o dia em questão até dia 31
     * Se não for último dia do mês, devolve array com o dia informado
     * Ex.
     *      entrada: 2017-02-28, saída: [28, 29, 30, 31]
     *      entrada: 2017-04-30, saída: [30, 31]
     *      entrada: 2017-05-31, saída: [31]
     *      entrada: 2017-02-27, saída: [27]
     * @param Carbon $date
     * @return array
     */
    public static function endOfMonthIn(Carbon $date) : array
    {
        // efetuado o clone do objeto para não modificar a instância no objeto que chamou este método
        $date = clone($date);

        $day = $date->day;
        $in = [$day];

        // último dia do mês
        $last = $date->lastOfMonth();

        // lógica para, em meses que não vão até dia 31, todos os títulos até dia 31 sejam abrangidos
        if ($date->equalTo($last) && $last->day < 31) {
            while ($day < 31) {
                $day++;
                $in[] = $day;
            }
        }

        return $in;
    }

    /**
     * Inclui 1 mês, na data se cair em um dia que é final de semana
     * inclui mais um dia até ele ser um dia útil
     *
     * @param $date
     * @param int $days
     * @return string
     */
    public static function dateNextMonthNotWekend($date, $months)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date)->addMonth($months);
        if($date->isWeekend()){
            while ($date->isWeekend()){
                $date->addDays(1);
            }
        }

        return $date->format('Y-m-d');
    }

    /**
     * @param $date
     * @return mixed
     */
    public static function dateFromGoogleCalendar($date)
    {
        return explode('T', $date)[0];
    }

    /**
     * @param $date
     * @return mixed
     */
    public static function hourFromGoogleCalendar($date)
    {
        $hour = explode('T', $date)[1];
        return explode('-', $hour)[0];
    }
}
