$(document).ready(function () {
     
    
loadtableadmin(); 
loadorder();
function loadorder() {
    $.post("ajax/ajax_history_order.php",
        function (data ) {
            var table;
            var i = 1; 
        
            
           $.each(data.data, function (index, value) { 
                
               
                table+="<tr>";
                table+="<td>"+(i++)+"</td>";
                table+="<td>#P" +value.order+"</td>";
                if(value.name == null){
                    table+='<td><span class="badge badge-danger">การสั่งซื้อยังไม่ถูกยืนยัน</span></td>';
                }else{
                    table+='<td><span class="badge badge-success">'+value.name+'</span></td>';
                }
                table+="<td>"+value.time_admin+"</td>";
            
                table+="<td> <a  class='btn btn-info  btn-sm ml-1' href='order_show_dt.php?orderid="+value.order+"'>แสดง</a> </td>"
                
               
                 
                
           });
           
           
            $("#history_tbody").html(table);
            $('#history').DataTable();
        },
        "JSON"
    );
    
}
function loadtableadmin() {
    $.post("ajax/ajax_index.php", {loadadmincheck:1},
        function (data) {
             var table = "";
             var i=1;
              
             
             $.each(data, function (index, value) { 
                table += "<tr>";
                table += "<td>"+(i++)+"</td>";
                table += "<td>#P"+(value.order_id)+"</td>";
                table += "<td>"+(value.name)+"</td>";
                table += "<td>"+(value.time)+"</td>";
                table += "<td>"+(value.time_admin)+"</td>";
                table+="<td> <a  class='btn btn-info  btn-sm ml-1' href='order_show_dt.php?orderid="+value.order_id+"'>แสดง</a> </td>"
                if(value.admin_check != null){
                    table += "<td> <button type='button' class='btn btn-danger  btn-sm' id ='edit_order'   data-id='" + value.order_id+ "'>ยกเลิก</button></td>";
                }else{
                    table += "<td> <button type='button' class='btn btn-success   btn-sm' id ='summit_order'   data-id='" + value.order_id+ "'>ยื่นยัน</button></td>";
                
                }
               
              });

              $("#admin_order_lists").html(table);
                $('#admin_order').DataTable();
        },
        "JSON"
    );
  }
 
 
 
    $(document).on('click', '#edit_order', function (e) {
        e.preventDefault();   
        var id_order = $(this).attr('data-id');
        Swal.fire({
           title: 'คุณแน่ใจหรือ?',
           text: "คุณแน่ใจที่จะยกเลิกรายการสั้งซื้อหมายเลข #P"+id_order,
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'ยกเลิกรายการสั่งซื้อ',
           cancelButtonText:'ปิด'

         }).then((result) => {
           if (result.value) {
               $.post("ajax/ajax_index.php", {admin_cancel:id_order},
                   function (data) {
                       
                       
                       if(data==1){
                              Swal.fire(
                               'บันทึก',
                               'บันทึกการยกเลิกกาสั่งซื้อ #P'+ id_order+'เรียบร้อยแล้ว ',
                               'success'
                           )
                           location.href="index.php";
                           
                        
                       }
                   } 
               );
           
           }
         })    
    });
    $(document).on('click', '#summit_order', function (e) {
        e.preventDefault(); 
        var id_order = $(this).attr('data-id');
         Swal.fire({
            title: 'คุณแน่ใจหรือ?',
            text: "คุณแน่ใจที่จะยื่นยันรายการสั้งซื้อหมายเลข #P"+id_order,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยื่นยันรายการสั่งซื้อ',
            cancelButtonText:'ยกเลิก'
 
          }).then((result) => {
            if (result.value) {
                $.post("ajax/ajax_index.php", {admin_check_summit:id_order},
                    function (data) {
                        
                        
                        if(data==1){
                               Swal.fire(
                                'บันทึก',
                                'บันทึกการยื่นยันกาสั่งซื้อ #P'+ id_order+'เรียบร้อยแล้ว ',
                                'success'
                            )
                            location.href="index.php";
                         
                        }
                    } 
                );
            
            }
          })    
           
    });
});
  