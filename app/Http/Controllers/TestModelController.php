<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use App\Models\NormalMerchant;
use App\Models\NormalMerchant404;
use App\Models\NormalMerchantAddinfo;
use App\Models\NormalMerchantCategory;
use App\Models\NormalMerchantGA;
use App\Models\NormalMerchantGAAction;
use App\Models\NormalMerchantGAMonitor;
use App\Models\NormalMerchantGAMonitorSet;
use App\Models\NormalMerchantIndex;
use App\Models\RMerCategory;

class TestModelController extends Controller
{
    public function index()
    {
        xdebug_disable();
        //监听器
        DB::listen(function ($sql, $bindings, $time) {
            echo 'SQL语句执行：'.$sql.'，参数：'.json_encode($bindings).',耗时：'.$time.'ms';
        });
        
        $tmp = new NormalMerchantGAMonitorSet();

        //$tmp->find("35144");

        $res = $tmp->find(12)->nmgm;
        dd($res);
    }
}
