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
                    table+='<td><span class="badge badge-danger">การขอซื้อยังไม่ถูกยืนยัน</span></td>';
                }else{
                    table+='<td><span class="badge badge-success">'+value.name+'</span></td>';
                }
                table+="<td>"+value.time_admin+"</td>";
            
                table+="<td> <a  class='btn btn-info  btn-sm ml-1' href='order_show_dt.php?orderid="+value.order+"'>แสดง</a>"
                if(value.name==null){
                    table+="  <a  class='btn btn-warning  btn-sm ml-1' href='edit_order.php?orderid="+value.order+"'>แก้ไข</a>" 
                }else{
                    table+="</td>"
                }
                
                
               
                 
                
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
                 let text ="";
                table += "<tr>";
                table += "<td>"+(i++)+"</td>";
                table += "<td>#P"+(value.order_id)+"</td>";
                table += "<td>"+(value.name)+"</td>";
                table += "<td>"+(value.time)+"</td>";
                table += "<td>"+(value.time_admin)+"</td>";
                if(value.admin_check==null){
                    text="&check=0"
                }else{
                    text="&check=1"
                }
                table+="<td> <a  class='btn btn-info  btn-sm ml-1' href='order_show_dt.php?orderid="+value.order_id+text +"'>แสดง</a> </td>"
                if(value.admin_check != null){
                    table += "<td> <button type='button' class='btn btn-danger  btn-sm' id ='edit_order'   data-id='" + value.order_id+ "'>ไม่อนุมัติ</button></td>";
                }else{
                    table += "<td> <button type='button' class='btn btn-success   btn-sm' id ='summit_order'   data-id='" + value.order_id+ "'>อนุมัติ</button></td>";
                
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
           text: "คุณแน่ใจที่จะยกเลิกรายการขอซื้อหมายเลข #P"+id_order,
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'ยกเลิกรายการขอซื้อ',
           cancelButtonText:'ปิด'

         }).then((result) => {
           if (result.value) {
               $.post("ajax/ajax_index.php", {admin_cancel:id_order},
                   function (data) {
                       
                       
                       if(data==1){
                              Swal.fire(
                               'บันทึก',
                               'บันทึกการยกเลิกกาขอซื้อ #P'+ id_order+'เรียบร้อยแล้ว ',
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
            text: "คุณแน่ใจที่จะยื่นยันรายการขอซื้อหมายเลข #P"+id_order,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยื่นยันรายการขอซื้อ',
            cancelButtonText:'ยกเลิก'
 
          }).then((result) => {
            if (result.value) {
                $.post("ajax/ajax_index.php", {admin_check_summit:id_order},
                    function (data) {
                        
                        
                        if(data==1){
                               Swal.fire(
                                'บันทึก',
                                'บันทึกการยื่นยันกาขอซื้อ #P'+ id_order+'เรียบร้อยแล้ว ',
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
  