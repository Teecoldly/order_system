$(document).ready(function () {
    $("#id_cancel_order").click(function (e) { 
        e.preventDefault();
        Swal.fire({
            title: 'แน่ใจที่จะยกเลิกข้อมูลการสั่งซื้อนี้?',
            text: "ต้องการที่จะยกเลิกข้อมูลการสั่งซื้อนี้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ต้องการ',
            cancelButtonText: 'ยกเลิก'
          }).then((result) => {
            if(result.value){
                $.post("ajax/ajax_edit_order.php", {canncel_order:1},
                    function (data) {
                        location.href="history_order.php";
                    } 
                );
              
            }
          });
    });
    $("#id_submit_order").click(function (e) { 
        e.preventDefault();
        $.post("ajax/ajax_edit_order.php", {submit_order:1},
            function (data) {
               
                
                location.href="history_order.php";
                
            } 
        );
    });
});