<?php namespace App\Http\Controllers\Common;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\TaskStoreRelatedUrl;
use App\Models\TaskStoreMerchantRelationship;
use App\Models\TaskStoreCompetitorRelationship;

class MerchantLibController extends Controller {
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getRelatedUrlByMerID(Request $request)
    {
        $mer_id = $request->input("merid");
        
        $data = [];
        $store_id = TaskStoreMerchantRelationship::where('MerchantID', "=", $mer_id)->pluck('StoreID');
        $data['related_url'] = TaskStoreRelatedUrl::where('StoreId', "=", $store_id)->get();
        $data['competitor_url'] = TaskStoreCompetitorRelationship::withTC()->where('StoreID', "=", $store_id)->get();

        return $data;
    }

}
