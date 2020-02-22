$(document).ready(function () {
    $("#addnew").click(function (e) { 
        e.preventDefault();
        location.href="order.php";
 
    });
    $(document).on('click', '#delete_order', function (e) {
        e.preventDefault();
        var order_id = $(this).attr('data-id');
        Swal.fire({
            title: 'แน่ใจที่จะลบข้อมูลนี้?',
            text: "ต้องการที่จะลบข้อมูลรายการสั่งซื้อนี้จริงหรือ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ต้องการ',
            cancelButtonText: 'ยกเลิก'
          }).then((result) => {
            if (result.value) {
               
                $.post("ajax/ajax_history_order.php", {delete_order:order_id},
                    function (data) {
                        loadorder_history();
                    } 
                );
            }
        });
    });
});
loadorder_history();
function loadorder_history() {
    $.post("ajax/ajax_history_order.php",
        function (data ) {
            var table;
            var i = 1; 
        
            
           $.each(data.data, function (index, value) { 
                
               
                table+="<tr>";
                table+="<td>"+(i++)+"</td>";
                table+="<td>#P" +value.order+"</td>";
                
                table+="<td>"+value.timelogs_number+"</td>";
                if(value.name == null){
                    table+='<td><span class="badge badge-danger">การสั่งซื้อยังไม่ถูกยืนยัน</span></td>';
                }else{
                    table+='<td><span class="badge badge-success">'+value.name+'</span></td>';
                }
                table+="<td> <a  class='btn btn-info  btn-sm ml-1' href='order_show_dt.php?orderid="+value.order+"'>แสดง</a> </td>"
                
                if(value.name == null){
                    table += "<td>  <a class='btn btn-warning  btn-sm ml-1  ' href='edit_order.php?orderid="+value.order+"'>แก้ไข</a>   " +
                    "<button type='button' class='btn btn-dark  btn-sm' id='delete_order' data-id='"+value.order+"'>ลบ</button>" +
                    "</td>";
                }else{
                    table+='<td><span class="badge badge-danger">การสั่งซื้อถูกยืนยันแล้วไม่สามารถแก้ไขได้</span></td>';
                }
                 
                
           });
            $("tbody").html(table);
            $('#zero_config').DataTable();
        },
        "JSON"
    );
    
}