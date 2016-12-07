$('#active_promo_cnt').slider({
	id: 'active_promo_cnt',
	step: 1,
	min: 0,
	ticks: [0, 20, 1000],
	ticks_positions: [0, 80, 100],
	value: [0,0],
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});

function getTable()
{
	var form_data = $('#merchant_center_form').serializeArray();
	var form_datas = [];
	$.each(form_data, function(i, filed){
		form_datas[filed.name] = filed.value;
	});

	$('#merchant_list_table').DataTable({
		serverSide: true,
		createdRow: function ( row, data, index ) {
                        $('td', row).eq(5).css('vertical-align',"middle").css("text-align","center");
                },
		ajax: {
			url: '/content/merchantlistdata',
			type: 'POST',
			data: form_datas,
		},
		columns: [{
			"data": "ID",
			"width": '400',
			render: function (data, type, row, meta) {
				return "<div class=\"media\"><a class=\"media-left\" href='"
								 + row.OriginalUrl + "'><img class=\"logo\" src='http://in.mgcdn.com/mimg/merimg/s_"
								 + row.Logo + "'/></a><div class=\"media-body\"><h4 class=\"media-heading\"><a target='_blank' href='"
								 + row.MerchantUrl + "'>"
								 + data + " : " + row.Name + "</a></h4><br><b>BCGID:</b><span class=\"text-red\">"
								 + row.mappingID + "</span>&nbsp;|&nbsp;<span><b>Editor: </b>"
								 + row.AssignedEditor + "</span><br>Has Aff: "
								 + row.HasAffiliate + "</div></div>";
			}
		},
		{
			"data": "Grade",
			render: function (data, type, row, meta) {
				return "<span>" + data + "</span>"
						+ "<br><br><span><b>Min Promo#: </b>" + row.MinPromotionCount + "</span>"
						+ "<br><span><b>Upd Cycle: </b>" + row.TaskUpdateCycle + "</span>";
			}
		},
		{
			"data": "PromotionCnt",
			render: function (data, type, row, meta) {
				return "<span>" + data + "</span>"
						+ "<br><br><span><b>Coupon Cnt#: </b>" + row.CouponCnt + "</span>&nbsp;|&nbsp;"
						+ "<span>Deal Cnt#: " + (data - row.CouponCnt) + "</span>" 
						+ "<br><span>Last Add Time : " + row.LastAddTime + "</span>";
			}
		},
		{
			"data": "Ctr",
			render: function (data, type, row, meta) {
				return "<span>" + data + "</span>"
						+ "<br><br><span><b>Impr7d: </b>" + row.Imps7d 
						+ "<br><span><b>Click7d : </b>" + row.Clks7d + "</span>";
			}	
		},
		{
			"data": "OriginalUrl",
			"orderable": false,
			render: function (data, type, row, meta) {
				var str = "";
				str = "<div class=\"btn-group\"><button class=\"btn btn-default btn-flat\" onclick=\"getRelatedUrl("
				+ row.ID +");\">RelatedUrl</button></div>"
				if (row.related_url && row.related_url.length > 0) {
				str += "<b>Related Url:</b><br>";
				$.each(row.related_url, function(index, value) {
					str += "<span><a target='_blank' href='" + value.Url + "'>" + value.Name + "</a></span><br>";
				});
				}

				if (row.competitor_url && row.competitor_url.length > 0) {
					str += "<b>Competitor Url:</b><br>";
					$.each(row.competitor_url, function(index, value) {
						str += "<span><a target='_blank' href='" + value.Url + "'>" + value.Name + "</a></span><br>";
					});
				}

				return str;
			}
		},
		{
			"data": "Name",
			"orderable": false,
			render: function (data, type, row, meta) {
				return "<a href='#'><span class='glyphicon glyphicon-circle-arrow-right merchant_info_page'></span></a>";
			}
		}
		]
	});
}

$('#merchant_list_submit').click(function(){
	$('#merchant_list_table').DataTable().clear().destroy();
	getTable();
});


function getRelatedUrl(id){
	

	$('#show_modal').modal('show');
}

$('#related_url_35141').click(function(){
	$('#show_modal').modal('show');
});

$(document).ready(function(){
	$('input[type="checkbox"], input[type="radio"]').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue'
    });

	getTable();
});