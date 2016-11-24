@extends('common')
@section('content')
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Merchant Center</h3>
		</div>
		<form action="{{ url('content/merchantcenterdata') }}" method="post" class="form-horizontal">
			<div class="box-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="search_keyword" class="col-sm-1 control-label">Search</label>
                    <div class="col-sm-2">
                    <div class="input-group">
                    <input type="text" name="search_keyword" id="search_keyword" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-default"><i class="fa fa-search"></i></button>
                    </span>
                    </div>
                    </div>
                    <label for="merchant_grade" class="col-sm-1 control-label">Grade</label>
                    <div class="col-sm-1">
                        <select name="merchant_grade" id="merchant_grade" class="form-control">
                            <option value="0">-</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                    <label for="merchant_editor" class="col-sm-1 control-label">Editor</label>
                    <div class="col-sm-2">
                        <select name="merchant_editor" id="merchant_editor" class="form-control">
                            <option value="0">-</option>
                            <option value="1">Marissa</option>
                            <option value="2">Ally</option>
                            <option value="3">Vera</option>
                            <option value="4">Glara</option>
                        </select>
                    </div>
                    <label for="active_promo_cnt" class="col-sm-1 control-label">Active Promo</label>
                    <div class="col-sm-2">
                        <input id="active_promo_cnt" class="slider form-control" type="text"/>
                    </div>
                </div>
            </div>
		</form>
	</div>
@endsection