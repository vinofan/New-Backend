function Reset(){
     window.location.href="/content/couponcenter";
}

function selectAllItems(){
 	var checklist = document.getElementsByName ("sel_buttom");
    if(document.getElementById("sel_top").checked)
    {
   	   for(var i=0;i<checklist.length;i++)
	   {
	      checklist[i].checked = 1;
	   } 
    }else{
	   for(var j=0;j<checklist.length;j++)
	   {
	      checklist[j].checked = 0;
	   }
    }
}

function markSelectedItems(){
        var cks = document.getElementsByName("sel_buttom");
        var tableId = document.getElementById("coupon_list_table"); 
        var c_ids_arr = [];
        for(var i=1;i<tableId.rows.length;i++) 
        {   
            if (cks[i-1].checked) {
               c_ids_arr.push(tableId.rows[i].cells[1].innerHTML);
               
            }
           
        }

        if (c_ids_arr == '') {
            alert('Please select at least 1 promotion first!');
            exit();
        }

        $.ajax({
                type: "POST",
                url: "/content/batchactions",
                data: {
                    c_ids_arr:c_ids_arr,
                    action: $("[name=selectaction]").val(),
                    _token: $("[name=_token]").val(),
                },
                                                    
                success: function(msg){
                    if (msg == 'suc') {
                        alert('Operation is successfully executed!');
                        window.location.reload();
                    }else{
                        alert('Please select at least one action!');
                    }
                }
             
        });
}


