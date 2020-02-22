$(document).ready(function () {
    
    $("#send_data").click(function (e) { 
        e.preventDefault();
        var selected = {};
           $("input[type='checkbox']").each(function() {
               if($(this).is(":checked")){
                    
                   if($(this).val()!="on"){
                       var id = $(this).val();
                       selected[id]=$("#"+id).val();
                   }
               }
      
           });
           
           
           if(  Object.size(selected)==0){
               Swal.fire({
                   icon: 'warning',
                   title: 'เกิดข้อผิดพลาด',
                   text: "กรุณาเลือกสินค้าในการสั่งซื้อ",
                 })
           }else{
                
              
                
                 var orderid = getvalueurl().orderid;
        
                 
               
               $.post("ajax/ajax_edit_order.php", {selectid:JSON.stringify(selected),id_edit:orderid},
               function (data) {
                   if(data==1){
                       location.href="edit_show_dt.php";
                   }
                } 
               );
           }
         
           
           
    });
    Object.size = function(obj) {
       var size = 0, key;
       for (key in obj) {
           if (obj.hasOwnProperty(key)) size++;
       }
       return size;
   };
    $( ".form-control" ).focusout(function() {
       $(".form-control").each(function() {
            
                
               if(parseInt($(this).val())==0){
                   $(this).val(1);
               }
         
  
       });
     
     });
     
});
loadproduct();
   function loadproduct() { 
       $.post("ajax/ajax_product.php", {loadproduct:1},
           function (data) {
               var table ;
                
               $.each(data.data, function (index, value) { 
                    table+="<tr>";
                    table+="<td> <label class='customcheckbox'>";
                    table+="<input type='checkbox' id='selectproduct' class='listCheckbox' value='"+value.product_id+"'/>";
                    table+="<span class='checkmark'></span>";
                    table+="  </label> </td>";
                    table+="<td>"+value.product_key+"</td>";
                    table+="<td>"+value.product_name+"</td>";
                    table+="<td>"+value.price+"</td>";                 
                    table += "<td> <input type='number' class='form-control' id='"+value.product_id+"' min='1' value='1'></td>";
                    table+="</tr>";
               });
               $("tbody").html(table);
               $('table').DataTable();
           },
           "JSON"
       );
       
    }
    function getvalueurl() {
        var parts = window.location.search.substr(1).split("&");
        var $_GET = {};
        for (var i = 0; i < parts.length; i++) {
            var temp = parts[i].split("=");
            $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
        }

        return $_GET
    }