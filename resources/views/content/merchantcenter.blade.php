@extends('common')
@section('content')
<div class="box box-primary">
  <div class="box-header with-border">
     <h3 class="box-title">Merchant Center</h3>
 </div>
 <form class="form-horizontal" id="merchant_center_form">
     <div class="box-body">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <!-- <label for="search_keyword" class="col-sm-1 control-label">Search</label>
            <div class="col-sm-2">
                <div class="input-group">
                    <input type="text" name="search_keyword" id="search_keyword" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-default"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div> -->
            <label for="merchant_grade" class="col-sm-1 control-label">Grade</label>
            <div class="col-sm-1">
                <select name="merchant_grade" id="merchant_grade" class="form-control">
                    @foreach ( $grades as $k => $v )
                    <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <label for="merchant_editor" class="col-sm-1 control-label">Editor</label>
            <div class="col-sm-2">
                <select name="merchant_editor" id="merchant_editor" class="form-control">
                    @foreach ( $editors as $k => $v )
                    <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <label for="active_promo_cnt" class="col-sm-1 control-label">Active Promo</label>
            <div class="col-sm-2">
                <input type="text" name="active_promo_cnt" id="active_promo_cnt" class="slider form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label for="more_filter" class="col-sm-1 control-label">More Filter</label>
              <div class="col-sm-6">
                <div class="checkbox">
                    <label>
                    <input type="checkbox" name="merchant_count_alert" id="merchant_count_alert"><b> Count Alert</b>
                  </label>
                  <label>
                    <input type="checkbox" name="merchant_delay_alert" id="merchant_delay_alert"><b> Delay Alert</b>
                  </label>
                  <label>
                    <input type="checkbox" name="merchant_exclusive" id="merchant_exclusive"><b> Exclusive</b>
                  </label>
                  <label>
                    <input type="checkbox" name="merchant_no_category" id="merchant_no_category"><b> No Category</b>
                  </label>
              </div>
              </div>
              <div class="btn-group col-sm-2">
          <button class="btn btn-primary btn-flat" type="button" id="merchant_list_submit">Query</button>
          <button class="btn btn-default btn-flat" type="reset">Reset</button>
          </div>
      </div>
  </div>
</form>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Merchant List</h3>
    </div>
    <div class="box-body">
        <table class="table table-hover table-bordered" id="merchant_list_table">
          <thead>
            <tr class="info">
              <th>MerchantID</th>
              <th>Grade</th>
              <th>Promo #</th>
              <th>CTR</th>
              <th>Reference</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
    </div>
</div>
@endsection