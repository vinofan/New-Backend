<?php use Illuminate\Support\Facades\Input; ?>
@extends('common')
@section('content')
<style type="text/css">
.test{width: 500px;height: 500px;margin-top: 500px;margin-left: 500px;border: 1px solid red}
</style>

<script src="{{ asset('js/content/coupon-center.js') }}"></script>

<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<script src="{{ asset('js/jquery-1.8.2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min2.js') }}"></script>


<link rel="stylesheet" href="{{ asset('css/bootstrap-editable.css') }}">
<script src="{{ asset('js/bootstrap-editable.min.js') }}"></script>

	        <div class="box">
				<div class="box-header">
			              <h3 class="box-title">Select Tools:</h3><br>
			              <form action="" method="get" id="filter" name="filter">
			                <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<table width="98%;"> 
								<tr>
									<td width="60px">Merchant:</td>
									<td ><input type="text" value="{{Input::old('merchant')}}" name="merchant" style="width:90px;height:30px"></td>
									<td width="60px">Source:</td>
									<td>
										<select name="source" style="width:90px;height:30px">
											@foreach($search_data['sources'] as $source)
												<option>{{$source}}</option>
											@endforeach
											
										</select>
									</td>
									<td width="60px">Editor:</td>
									<td>
										<select name="editor" style="width:90px;height:30px">
											@foreach($search_data['editors'] as $editor)
												<option>{{$editor}}</option>
											@endforeach
											
										</select>
									</td>
									<td width="60px">Type:</td>
									<td>
										<select name="type" style="width:90px;height:30px">
											<option>-</option>
											<option>Coupon</option>
											<option>Deal</option>
											
										</select>
									</td>
									
								</tr>
								<tr>
					             	<td width="60px">Tag:</td>
									<td ><input type="text" value="{{Input::old('Tag')}}" name="Tag" style="width:90px;height:30px"></td>

									<td width="60px">CouponID:</td>
									<td ><input type="text" value="{{Input::old('CouponID')}}" name="CouponID" style="width:90px;height:30px"></td>
								</tr>

								<tr>
									<!-- <td colspan="2">Show 
				                <input type="text" value="{{old('page')}}" name="page" style="width:30px;">
				                entries</td> -->
				                	<td colspan="2"></td>
				                	<td colspan="2"></td>
						            <td colspan="2"></td>
						            <td colspan="2">
						              <button id="submit" type="submit" class="btn btn-primary btn-flat" onclick="search()">Query</button>
						              <button class="btn btn-default btn-flat" type="button" onClick="Reset()">Reset</button>

						            </td>
									
								</tr>
			              
				              	</table>
						   </form>
			    </div>
			    
				<div class="box-body">
	                <table id="coupon_list_table" class="table table-bordered table-hover">
		                <!-- <form action="" method="post" id="page" name="page">
		                <input type="hidden" name="_token" value="{{ csrf_token() }}">
			                Show 
			                <input type="text" value="10" name="page" style="width:30px;">
			                entries
			                <button id="submit" type="submit" onclick="Go()">Go</button>
		                </form> -->
		                <input onclick="selectAllItems()" type="checkbox" name="sel_top" id="sel_top"/>Select All | Batch Actions:
						<form action="" method="post">
						 <input type="hidden" name="_token" value="{{ csrf_token() }}">
		                <select name="selectaction" style="width:160px;height:25px">
								<option value="All">--- Please Select ---</option>
								@foreach($search_data['actions'] as $key => $info)
								<optgroup label="{{$key}}">
									@foreach($info as $info1)
										<option>{{$info1}}</option>
									@endforeach
								@endforeach
						 </select>&nbsp;&nbsp;
						  
			                <input type="hidden" name="_token" value="{{ csrf_token() }}">
						 <button type="button" onclick="markSelectedItems();" class="btn btn-danger">Execute</button>
						 </form>
   						
		                <thead  style="display:block;overflow-y: scroll;border-bottom:1px solid #eee;">
			                <tr style="background-color:#d9edf7">
			               	  <th></th>
			                  <!-- <th>Merchant</th> -->
			                  <th>Promotion Detail</th>
			                  <th>Title</th>
			                  <th>Description</th>
			                  <th>Stats Info</th>
			                  <th>Time Info</th>
			                  <th>Tags</th>
			                  <th>Source</th>
			                  <th>Operation</th>
			                </tr>
		                </thead>
		            
		                <tbody style="display:block; max-height:500px;overflow-y: scroll;">

		                	@foreach($coupons as $coupon)
			                <tr>
			                	<td><input type="checkbox" name="sel_buttom" id='coupon_{{$coupon->ID}}' value="" class="processtatuscheckbox" /></td>
			         		
			                
			                  	<!-- <td>
			                       	<a href="{{$coupon->merchant_url}}" target='_blank'  title='go to merchant page' style='color:#6666CC'>{{$coupon->merchant_name}}</a><br>{{$coupon->MerchantID}}<br>
			                       	
			                  	</td> -->
			                  	<td>
			                  		<span id="type_{{$coupon->ID}}">{{$coupon->type}}</span><br />
			                  		<span>@if($coupon->OnlineState == 1)  Online In-store @endif @if($coupon->OnlineState == 2) Online  @endif @if($coupon->OnlineState == 3) In-store @endif</span>


			                  		@if ($coupon->Code != '')<br />@endif
									<span id="couponcode_{{$coupon->ID}}" style='font-weight:900'>{{$coupon->Code}}</span>
									
									@if ($coupon->IsExclusive == "YES")
									<br />
									<span style="color:red;">Exclusive</span>
									@endif


			                  	</td>

			                  	
			                  	<td>ID:<font color="red">{{$coupon->ID}}</font></span><br>

			                  		<a href="#" class="title_edit" data-pk="{{$coupon->ID}}">{{$coupon->Title}}</a><br>
				                  	<a href='{{$coupon->coupon_url}}' target='_blank' title='go to coupon detail page' style='color:#6666CC'>open</a>
				                  	<br>
				                  	<a href='{{$coupon->DstUrl}}' target='_blank'>Redir URL</a><br>
				                  	<a href='{{$coupon->merchant_url}}' target='_blank'>Merchant URL</a>
			                  	</td>
			                  	
			                  	<td>
			                  		<a href="#" class="remark_edit" data-pk="{{$coupon->ID}}">{{$coupon->Remark}}</a><br />
			                  	</td>
			                  	<td>
			                  		IMPS: <span id="imps" value="{{$coupon->imps}}">{{$coupon->imps}}</span><br>
			                  		CLICK: <span id="click" value="{{$coupon->click}}">{{$coupon->click}}</span><br>

			                  		<p class="popover-options">
								        <a type="button" class="btn btn-success btn-xs" title="<h4>Previous Data</h4>"
								           data-container="body" data-toggle="popover" data-content="{{$coupon->dates}}">
								        
								            Detail
								        </a>
								    </p>
			                  	</td>
			                  	
			                  	<td>

									<span id="expiredatetype_{{$coupon->ID}}">{{$coupon->expiredate_type}}</span><br>
									A: <a href="#" class="addtime_edit" data-pk="{{$coupon->ID}}"><span>@if($coupon->add_time <= "1970-01-01" || $coupon->add_time == "0000-00-00")  @else{{$coupon->add_time}}@endif</span></a><br>
									<!-- S: <span>{{$coupon->start_time}}</span><br> -->
									E: <a href="#" class="expiretime_edit" data-pk="{{$coupon->ID}}"><span>@if($coupon->expire_time <= "1970-01-01" || $coupon->expire_time == "0000-00-00")  @else{{$coupon->expire_time}}@endif</span></a><br>
									@if($coupon->expiredate_type == 'Unknown')
										R: <a href="#" class="reminddate_edit" data-pk="{{$coupon->ID}}"><span>@if($coupon->remind_date <= "1970-01-01" || $coupon->remind_date == "0000-00-00")  @else{{$coupon->remind_date}}@endif</span></a><br>
									@endif
			                  	</td>
			                  	<td></td>
			                  	<td>{{$coupon->Source}}<br>
			                  	   @if($coupon->Editor != '')Editor:{{$coupon->Editor}}@endif</td>
			                  	<td></td>
			                
			   				
			                </tr>
			                @endforeach

			           
			            </tbody>

	                </table>
	                <div class="pull-right">
	                     
	                    <?php echo $coupons->appends(['merchant' => Input::get('merchant')])->render(); ?>
	                     
	                </div>
		        </div>

			</div>


<script>
$(function () { $('.popover-show').popover('show');});
$(function () { $('.popover-hide').popover('hide');});
$(function () { $('.popover-destroy').popover('destroy');});
$(function () { $('.popover-toggle').popover('toggle');});
$(function () { $(".popover-options a").popover({html : true });});

$('.title_edit').editable({
                           type:  'textarea',
                           pk:    1,
                           name:  'title',
                           url:   '/content/clickchange',  
                           title: 'Title edit' 

                        });

$('.remark_edit').editable({
                           type:  'textarea',
                           pk:    1,
                           name:  'remark',
                           url:   '/content/clickchange',  
                           title: 'Remark edit'                           
                        });
$('.addtime_edit').editable({
                           type:  'date',
                           pk:    1,
                           name:  'addtime',
                           url:   '/content/clickchange',  
                           title: 'Addtime edit'                           
                        });
$('.expiretime_edit').editable({
                           type:  'date',
                           pk:    1,
                           name:  'expiretime',
                           url:   '/content/clickchange',  
                           title: 'Expiretime edit'                           
                        });
$('.reminddate_edit').editable({
                           type:  'date',
                           pk:    1,
                           name:  'reminddate',
                           url:   '/content/clickchange',  
                           title: 'Reminddate edit'                           
                        });

</script>

<script type="text/javascript">  
    $(document).ready(function(){  
        var _width=$('#coupon_list_table').width();  
        $('#coupon_list_table th:first-child').width(_width*0.02);  
        $('#coupon_list_table td:first-child').width(_width*0.02);  
        $('#coupon_list_table th:nth-child(2)').width(_width*0.08);  
        $('#coupon_list_table td:nth-child(2)').width(_width*0.08);  
        $('#coupon_list_table th:nth-child(3)').width(_width*0.15);  
        $('#coupon_list_table td:nth-child(3)').width(_width*0.15);  
        $('#coupon_list_table th:nth-child(4)').width(_width*0.3);  
        $('#coupon_list_table td:nth-child(4)').width(_width*0.3);  
        $('#coupon_list_table th:nth-child(5)').width(_width*0.08);  
        $('#coupon_list_table td:nth-child(5)').width(_width*0.08);  
        $('#coupon_list_table th:nth-child(6)').width(_width*0.08);  
        $('#coupon_list_table td:nth-child(6)').width(_width*0.08);  
        $('#coupon_list_table th:nth-child(7)').width(_width*0.05);  
        $('#coupon_list_table td:nth-child(7)').width(_width*0.05);
        $('#coupon_list_table th:nth-child(8)').width(_width*0.06);  
        $('#coupon_list_table td:nth-child(8)').width(_width*0.06);
        $('#coupon_list_table th:nth-child(9)').width(_width*0.065);  
        $('#coupon_list_table td:nth-child(9)').width(_width*0.065);
    })  
</script>  

@endsection





