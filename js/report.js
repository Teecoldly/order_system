$(document).ready(function () {
    $("#id_submit_order").click(function (e) { 
        e.preventDefault();
        var data = getvalueurl() ;
       location.href="report_1.php?ORDER_ID="+data.orderid;
        
    });
    $(document).on('click', '#delete_order', function (e) {
        e.preventDefault();
        let delete_order = $(this).data("product_id");
        let obj =getvalueurl();
        $.post("ajax/ajax_admin_delete_order.php", {
            id_order:obj['orderid'],
            product_id:delete_order
        },
            function (data) {
                var data = getvalueurl() ;
                if(typeof data.check =="undefined"){
                    location.href="order_show_dt.php?orderid="+data.orderid;
                }else{
                    location.href="order_show_dt.php?orderid="+data.orderid+"&check="+data.check;
                }
                

            },
            "JSON"
        );
 
        
        
    });
});
function getvalueurl() {
    var parts = window.location.search.substr(1).split("&");
    var $_GET = {};
    for (var i = 0; i < parts.length; i++) {
        var temp = parts[i].split("=");
        $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
    }

    return $_GET
}