<?php

namespace Skill\Services;


use Carbon\Carbon;


class DiasUteisService
{

    /**
     * Calcula o numero de dias úteis entre duas datas.
     *
     * @param $dtInicial
     * @param $dtFinal
     * @return int
     */
    public function calcDiasUteis($dtInicial, $dtFinal)
    {
        $initial = Carbon::createFromFormat('Y-m-d', $dtInicial)->year;
        $fds = 0;
        $holidays = 0;
        $calcDays = $this->getDiffInDays($dtInicial, $dtFinal);
        $diasUteis = 0;

        //return dd(Carbon::createFromFormat('Y-m-d',$dtInicial)->dayOfWeek);

        while ($dtInicial != $dtFinal) {

            $weekDay = Carbon::createFromFormat('Y-m-d', $dtInicial)->dayOfWeek;

            if ($weekDay == 0 || $weekDay == 6) {

                $fds++;

            } else {
                for ($i = 0; $i <= 10; $i++) {
                    if ($initial == $this->getRolidays(Carbon::now()->year, $i)) {
                        $holidays++;
                    }
                }
            }

            $dtInicial = Carbon::createFromFormat('Y-m-d', $dtInicial, 'America/Sao_Paulo')->addDay(1)->toDateString();
        }

        /**
         * Retorna o número de dias úteis excluindo fins de semana e feriados.
         * Obs.: o "+1" serve para considerar o dia atual como dia util.
         */
        return ($calcDays - ($fds + $holidays)) + 1;
    }

    /**
     * Retorna o numero de dias entre duas datas.
     * @param $dtInicial
     * @param $dtFinal
     * @return int
     */
    public function getDiffInDays($dtInicial, $dtFinal)
    {
        $dt1 = Carbon::createFromFormat('Y-m-d', $dtInicial, 'America/Sao_Paulo');
        $dt2 = Carbon::createFromFormat('Y-m-d', $dtFinal, 'America/Sao_Paulo');

        return $dt1->diffInDays($dt2);
    }

    /**
     * Lista de feriados do ano.
     * @param $year
     * @param $position
     * @return string
     */
    public function getRolidays($year, $position)
    {
        $day = Carbon::HOURS_PER_DAY * Carbon::MINUTES_PER_HOUR * Carbon::SECONDS_PER_MINUTE;
        $dates = [];


        $dates['pascoa'] = $this->pascoa($year);
        $dates['sexta_santa'] = $dates['pascoa'] - (2 * $day);
        $dates['carnaval'] = $dates['pascoa'] - (47 * $day);
        $dates['corpus_cristi'] = $dates['pascoa'] + (60 * $day);
        $feriados = [
            '01/01',
            date('d/m',$dates['carnaval']),
            date('d/m',$dates['sexta_santa']),
            date('d/m',$dates['pascoa']),
            '21/04',
            '01/05',
            date('d/m',$dates['corpus_cristi']),
            '12/10',
            '02/11',
            '15/11',
            '25/12'
        ];


        return $feriados[$position]."/".$year;
    }

    private function pascoa($year)
    {
        if (!function_exists('easter_date')) {
            function easter_date($year)
            {
                /*
                    G is the Golden Number-1
                    H is 23-Epact (modulo 30)
                    I is the number of days from 21 March to the Paschal full moon
                    J is the weekday for the Paschal full moon (0=Sunday,
                      1=Monday, etc.)
                    L is the number of days from 21 March to the Sunday on or before
                      the Paschal full moon (a number between -6 and 28)
                */


                $G = $year % 19;
                $C = (int)($year / 100);
                $H = (int)($C - (int)($C / 4) - (int)((8 * $C + 13) / 25) + 19 * $G + 15) % 30;
                $I = (int)$H - (int)($H / 28) * (1 - (int)($H / 28) * (int)(29 / ($H + 1)) * ((int)(21 - $G) / 11));
                $J = ($year + (int)($year / 4) + $I + 2 - $C + (int)($C / 4)) % 7;
                $L = $I - $J;
                $m = 3 + (int)(($L + 40) / 44);
                $d = $L + 28 - 31 * ((int)($m / 4));
                $y = $year;
                $E = mktime(0, 0, 0, $m, $d, $y);

                return $E;
            }
        }

        return easter_date($year);
        
    }


}