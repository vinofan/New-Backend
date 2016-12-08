<?php namespace App\Http\Controllers\Content;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\NormalCoupon;
use App\Models\NormalMerchant;
use App\Models\NormalCouponAddinfo;
use App\Models\CouponStats;
use App\Models\Tag;

use Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use DB;
class CouponCenterController extends Controller {

    public function getCouponCenter(Request $request) {
    	$PromoType_arr = array("Coupon"=>"1", "Deal"=>"2","1"=>"Coupon", "2"=>"Deal");
    	$multiProcessTypeData = array(
			'Change Promotion Status' => array(
				'IsActive-YES' => 'Change to Active',
				'IsActive-NO' => 'Change to Inactive',
			),
			'Change Promotion Expire Time' => array(
				'ExpireDateType-Fixed' => 'Change to Expired',
			),


		);
    	$search_data = [
    		'actions' => $multiProcessTypeData,
            'editors' => Config::get("constants.editors"),
    		'sources' => Config::get("constants.sources"),

    	];

    	if (count($request->all()) <= 1) {
	       	$query = NormalCoupon::where('Starttime','<=',date('Y-m-d H:i:s'))
					 ->where('Isactive','YES')
					 ->where(function($query){
					 	 $query->where('Expiretime','0000-00-00:00:00:00')
					 	 	   ->orwhere('Expiretime','>',date('Y-m-d H:i:s'));
					 });

    	}else{
    		$merchant = trim($request->get('merchant'));
			$source = $request->get('source');
			$editor = $request->get('editor');
			$type = $request->get('type');
			$tag = $request->get('Tag');
			$coupon_id = trim($request->get('CouponID'));

	        $where = "1=1";

	        $merchant_id = '';
	        if ($merchant != '') {
	        	
	        	$merchant_id = is_numeric($merchant) ? $merchant : NormalMerchant::where('Name','like','%'.$merchant.'%')->first()->ID;
	        }

	        if ($merchant_id != '') {
	        	$where .= " and MerchantID = ".$merchant_id;
	        }
	        if ($source != '-' && $source != '') {
	        	$where .= " and Source = '".$source."'";
	        }
	        if ($editor != '-' && $editor != '') {
	        	$where .= " and Editor = '".$editor."'";
	        }
	        if ($type != '-' && $type != '') {
	        	$where .= " and PromoType = '".$PromoType_arr[$type]."'";
	        }
	        if ($coupon_id != '') {
	        	$where .= " and ID = '".$coupon_id."'";
	        }

	        $query = NormalCoupon::whereRaw($where);

	    }

	    	$coupons = $query->paginate(10);
	        foreach ($coupons as $coupon) {
	        	$normalcoupon_info = NormalCoupon::where('ID',$coupon->ID)->first();
	        	if ($normalcoupon_info != null) {
		        	$coupon->merchant_name = $normalcoupon_info->Name;
		        	$coupon->merchant_url = "http://in.promopro.com/front/merchant.php?mid=".$normalcoupon_info->MerchantID;
		        	$coupon->coupon_url = "http://in.promopro.com/front/coupondetail.php?couponid=".$normalcoupon_info->ID;
		        	$coupon->type = $PromoType_arr[$normalcoupon_info->PromoType];
		        	
		        	$coupon->add_time = date("Y-m-d",strtotime($normalcoupon_info->AddTime));
		        	$coupon->expire_time = date("Y-m-d",strtotime($normalcoupon_info->ExpireTime));

		        	$normalcoupon_addinfo = NormalCouponAddinfo::where('ID',$normalcoupon_info->ID)->first();
		        	if ($normalcoupon_addinfo != null) {
			        	$coupon->expiredate_type = $normalcoupon_addinfo->ExpireDateType;
			        	$coupon->remind_date = $normalcoupon_addinfo->RemindDate;
					}
		        	$status = $this->getStats($normalcoupon_info->ID);
				}

	        	if (count($status['stats_detail']) == 0) {
	        		$coupon->dates = "<h4>No Data</h4>";
	        	}else{
	        		$coupon->imps = $status['PageImpressions'];
		        	$coupon->click = $status['PageClicks'];

		        	$coupon->dates = "<table><tr align='center'>";

		        	$coupon->dates .= "<td width='300px'>Date</td>";
		          	$coupon->dates .= "<td width='100px'>IMPS</td>";
		          	$coupon->dates .= "<td width='100px'>CLICK</td></tr>";
		          	foreach ($status['stats_detail'] as $k => $v) {
		        		$coupon->dates .= "<tr align='center'>";
		        		$coupon->dates .= "<td>".$v['Date']."</td>";
		        		$coupon->dates .= "<td>".$v['PageImpressions']."</td>";
		        		$coupon->dates .= "<td>".$v['PageClicks']."</td>";
		        		$coupon->dates .= "</tr>";
		        	}
		        	$coupon->dates .= "</table>";
	        	}

		    }

		        $request->flash();

		return view('content.couponcenter')->with(['coupons'=> $coupons,'search_data'=>$search_data]);
	}

		public function postBatchActions(Request $request){
			$ids = $request->get('c_ids_arr');
			$action = $request->get('action');

			switch ($action) {
				case 'Change to Active':
					foreach ($ids as $id) {
						NormalCoupon::where('ID',$id)->update(['IsActive' => 'YES']);
					}
					return 'suc';
					
					exit;
	    			break;
				case 'Change to Inactive':
					foreach ($ids as $id) {
						NormalCoupon::where('ID',$id)->update(['IsActive' => 'NO']);
					}
					return 'suc';
					
					exit;
	    			break;
	    		case 'Change to Expired':
	    			$new_expiretime = date("Y-m-d H:i:s", strtotime("Y-m-d H:i:s")-3600*24);
					foreach ($ids as $id) {
						NormalCoupon::where('ID',$id)->update(['ExpireTime' => $new_expiretime]);
																	
					}

					return 'suc';
					exit;
	    			break;
				
				default:
					return 'fail';
					break;
			}

		}

		public function postClickChange(Request $request){
			$query = NormalCoupon::where('ID',$request->get('pk'));
			switch ($request->get('name')) {
				case 'title':
					$query->update(['Title' => trim($request->get('value'))]);
					break;
				case 'remark':
					$query->update(['Remark' => trim($request->get('value'))]);
					break;
				case 'addtime':
					$query->update(['AddTime' => $request->get('value')]);
					break;
				case 'expiretime':
					$query->update(['ExpireTime' => $request->get('value')]);
					break;
				case 'reminddate':
					NormalCouponAddinfo::where('ID',$request->get('pk'))->update(['RemindDate' => $request->get('value')]);
					break;
				
				default:
					# code...
					break;
			}
			
			
		}


		public function getStats($id){
			$enddate = CouponStats::max('Date');
        	$fromdate = date("Y-m-d", strtotime("$enddate -7 days"));

        	$res = array();
      	
			$query = CouponStats::where('Date','>',$fromdate)
								 ->where('Date','<=',$enddate)
								 ->where('CouponId',$id)
								 ->orderBy('Date', 'asc');
										
			if ($query->get() != 'null') {
				
				$res['stats_detail'] = $query->get();
				$res['PageImpressions'] = $query->sum('PageImpressions');
				$res['PageClicks'] = $query->sum('PageClicks');
				return $res;
			}else{
				return $res;
			}
		}


}
