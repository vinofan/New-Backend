<?php namespace App\Http\Controllers\Content;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Config;
use Storage;

use App\Models\NormalMerchant;
use App\Models\TaskStoreRelatedUrl;
use App\Models\TaskStoreMerchantRelationship;
use App\Models\TaskStoreCompetitorRelationship;
use DB;


class MerchantCenterController extends Controller {

	public $require_jss = ['js/jquery.dataTables.min.js', 'js/dataTables.bootstrap.min.js'];
    public $require_csss = ['css/dataTables.bootstrap.css'];
    public $select_columns = [
            "normalmerchant.ID",
            "nma.Grade",
            "PromotionCnt",
            "Ctr",
        ];

    public function getMerchantCenter() 
    {
    	$data = [
            'grades' => Config::get("constants.grades"),
    		'editors' => Config::get("constants.editors"),
    		'require_jss' => $this->require_jss,
    		'require_csss' => $this->require_csss,
    	];

		return view('content.merchantcenter', $data);

	}

    public function postMerchantListData(Request $request) 
    {
        $filter = $request->all();
        $grades = Config::get("constants.grades");
        $front_url = Config::get("constants.front_url");

        $sql_addition = $this->getSqlAddition($filter);

        $nm = new NormalMerchant;

        $nm = $nm->withNMA()->withMSF();
        if (isset($filter['search']) && $filter['search']['value'] != '')
        {
            $nm = $nm->where($nm->table_pre . 'Name', 'like', "%" . $filter['search']['value'] . "%")->orWhere($nm->table_pre . 'ID', '=', $filter['search']['value']);
            
        }
        
        if ($sql_addition != '')
        {
            $nm = $nm->whereRaw($sql_addition);
        }

        $nm = $nm->orderBy($this->select_columns[$filter['order'][0]["column"]], $filter['order'][0]["dir"]);
        $data['recordsFiltered'] = $data['recordsTotal'] = $nm->count();

        $data['data'] = $nm->skip($filter['start'])->take($filter['length'])->get(); 
        foreach ($data['data'] as $k => $v) {
            $data['data'][$k]['Grade'] = $grades[$v->Grade];
            $data['data'][$k]['merchant_url'] = $front_url . $v->UrlName . "-coupons.html";
            $data['data'][$k]['store_id'] = TaskStoreMerchantRelationship::where('MerchantID', "=", $v->ID)->pluck('StoreID');
            $data['data'][$k]['related_url'] = TaskStoreRelatedUrl::where('StoreId', "=", $data['data'][$k]['store_id'])->get();
            $data['data'][$k]['competitor_url'] = TaskStoreCompetitorRelationship::withTC()->where('StoreID', "=", $data['data'][$k]['store_id'])->get();
        }
        $data['draw'] = $filter['draw'];

        $request->flash();

        return json_encode($data);
    }

    public function getSqlAddition(Array $filter)
    {
        $arr = [];

        if ($filter['merchant_grade'] > 0)
        {
            $arr[] = "nma.Grade = " . $filter['merchant_grade'];
        }

        if ($filter['merchant_editor'] > 0)
        {
            $editors = Config::get("constants.editors");
            $arr[] = "nma.AssignedEditor = '{$editors[$filter['merchant_editor']]}'";
        }

        if ($filter['active_promo_cnt'] != '0,0')
        {
            list($min, $max) = explode(",", $filter['active_promo_cnt']);
            $arr[] = "msf.PromotionCnt between $min and $max";
        }


        if (isset($filter['merchant_count_alert']) && $filter['merchant_count_alert'] == 'on')
        {
            $arr[] = "msf.PromotionCnt < NormalMerchant.MinPromotionCount";
        }

        if (isset($filter['merchant_delay_alert']) && $filter['merchant_delay_alert'] == 'on')
        {
            $arr[] = "(TO_DAYS(now()) - msf.LastAddTime) > NormalMerchant.TaskUpdateCycle";
        }

        if (isset($filter['merchant_exclusive']) && $filter['merchant_exclusive'] == 'on')
        {
            $arr[] = "NormalMerchant.mappingID = -1 or NormalMerchant.mappingID is null";
        }

        if (isset($filter['merchant_no_category']) && $filter['merchant_no_category'] == 'on')
        {
            $arr[] = "NormalMerchant.ID not in (select distinct MerId from r_mer_category)";
        }

        return implode(" and ", $arr);
    }

}