<?php
namespace Nautilus\Util;


class MiscHelper
{
    public static function to_br_dateformat($date)
    {
        $date = explode('-', $date);
        return "{$date[2]}/{$date[1]}/{$date[0]}";
    }
}