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
									<td ><input type="text" value="{{old('merchant')}}" name="merchant" style="width:90px;height:30px"></td>
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
									<td ><input type="text" value="{{old('Tag')}}" name="Tag" style="width:90px;height:30px"></td>

									<td width="60px">CouponID:</td>
									<td ><input type="text" value="{{old('CouponID')}}" name="CouponID" style="width:90px;height:30px"></td>
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
   						
		                <thead>
			                <tr>
			               	  <th width='20px'></th>
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
		            
		                <tbody>

		                	@foreach($coupons as $coupon)
			                <tr>
			                	<td><input type="checkbox" name="sel_buttom" id='coupon_{{$coupon->ID}}' value="" class="processtatuscheckbox" /></td>
			         		
			                
			                  	<!-- <td>
			                       	<a href="{{$coupon->merchant_url}}" target='_blank'  title='go to merchant page' style='color:#6666CC'>{{$coupon->merchant_name}}</a><br>{{$coupon->MerchantID}}<br>
			                       	
			                  	</td> -->
			                  	<td width='8%'>
			                  		<span id="type_{{$coupon->ID}}">{{$coupon->type}}</span><br />
			                  		<span>@if($coupon->OnlineState == 1)  Online In-store @endif @if($coupon->OnlineState == 2) Online  @endif @if($coupon->OnlineState == 3) In-store @endif</span>


			                  		@if ($coupon->Code != '')<br />@endif
									<span id="couponcode_{{$coupon->ID}}" style='font-weight:900'>{{$coupon->Code}}</span>
									
									@if ($coupon->IsExclusive == "YES")
									<br />
									<span style="color:red;">Exclusive</span>
									@endif


			                  	</td>

			                  	
			                  	<td width='10%'>ID:<font color="red">{{$coupon->ID}}</font></span><br>

			                  		<a href="#" class="title_edit" data-pk="{{$coupon->ID}}">{{$coupon->Title}}</a><br>
				                  	<a href='{{$coupon->coupon_url}}' target='_blank' title='go to coupon detail page' style='color:#6666CC'>open</a>
				                  	<br>
				                  	<a href='{{$coupon->DstUrl}}' target='_blank'>Redir URL</a><br>
				                  	<a href='{{$coupon->merchant_url}}' target='_blank'>Merchant URL</a>
			                  	</td>
			                  	
			                  	<td width='40%'>
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
			                  	
			                  	<td width='7%'>

									<span id="expiredatetype_{{$coupon->ID}}">{{$coupon->expiredate_type}}</span><br>
									A: <span>@if($coupon->add_time == "1970-01-01") 0000-00-00 @else{{$coupon->add_time}}@endif</span><br>
									<!-- S: <span>{{$coupon->start_time}}</span><br> -->
									E: <span>@if($coupon->expire_time == "1970-01-01") 0000-00-00 @else{{$coupon->expire_time}}@endif</span><br>
									@if($coupon->expiredate_type == 'Unknown')
										R: <span>{{$coupon->remind_date}}</span><br>
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
	                <?php echo $coupons->render(); ?>
	                
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

</script>

@endsection





