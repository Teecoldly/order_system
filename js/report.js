$(document).ready(function () {
    $("#id_submit_order").click(function (e) { 
        e.preventDefault();
        var data = getvalueurl() ;
       location.href="report_1.php?ORDER_ID="+data.orderid;
        
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