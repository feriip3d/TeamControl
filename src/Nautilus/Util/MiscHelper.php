<?php
namespace Nautilus\Util;


class MiscHelper
{
    public static function to_br_dateformat($date)
    {
        $date = explode('-', $date);
        return "{$date[2]}/{$date[1]}/{$date[0]}";
    }

    public static function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++)
        {
            if($mask[$i] == '#')
            {
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else
            {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }
}