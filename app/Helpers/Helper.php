<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use App\Salesrequest;
use App\Project;
use App\Mall;
class Helper
{
    public static function auto_generate_sr()
    {
        $year = date('Y-m');
        $showCounts = Salesrequest::where('created_at','like','%'.$year.'%')->count();
        $showCounts = $showCounts + 1;
        $showCounts = str_pad($showCounts,3,'0', STR_PAD_LEFT);
        $string = 'SR-'.$year.'-'.$showCounts;
        return strtoupper($string);
    }

    public static function auto_generate_pc($mall_id)
    {
        $year = date('Y-m');
        $year2 = substr($year,2);
        $showCounts = Project::where('created_at','like','%'.$year.'%')->count();
        $showCounts = $showCounts + 1;
        $showCounts = str_pad($showCounts,3,'0', STR_PAD_LEFT);

        $result = Mall::select('mall_code')->where('mall_id', $mall_id)->first();
        $mall_code = $result->mall_code;

        $string = $mall_code.'-'.$year2.'-'.$showCounts;
        return strtoupper($string);
    }
}
