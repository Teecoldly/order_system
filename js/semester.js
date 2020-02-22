$(document).ready(function () {
    useyear();
    $("#year_tern").click(function (e) { 
        e.preventDefault();
        var year = $("#year").val();

        var term = $("#term").val();
        if(year ==''){
            Swal.fire({
                icon: 'error',
                title: 'ปีการศึกษา',
                text: 'ปีการศึกษาไม่ถูกต้อง',
              })
        
        }else if(term ==''){ 
            Swal.fire({
                icon: 'error',
                title: 'เทอม',
                text: 'เทอมไม่ถูกต้อง',
              })
        }else if(year.length!=4){
            Swal.fire({
                icon: 'error',
                title: 'ปีการศึกษา',
                text: 'รูปแบบปีการศึกษาไม่ถูกต้อง',
              })
        }
        else if(term.length!=1){
            Swal.fire({
                icon: 'error',
                title: 'เทอม',
                text: 'รูปแบบเทอมการศึกษาไม่ถูกต้อง',
              })
        }
        else{
            $.post("ajax/ajax_semester.php", {  
                year:year,
                term:term
            },
                function (data) {
                    loaddata();
                    useyear();
                    $('#add_semester').modal('toggle');
                } 
            );
        }
    });
});
function useyear() { 
    $.post("ajax/ajax_semester.php",{use:1},
       function (data) {
          
           if(data.rows!=0){
            Swal.fire({
                icon: 'warning',
                title: 'ระบบกำลังใช้ปีการศึกษาล่าสุด',
                text: 'ปีการศึกษา '+ data.data+' กำลังใช้งาน',
              })
           }
       }, "JSON"
   );
     
  }
loaddata();
function loaddata() { 
   $.post("ajax/ajax_semester.php",
       function (data) {
        var table = "";
        var i =1;
        $.each(data, function (index, value) { 
             table+="<tr>";
             table+="<td>"+(i++)+"</td>";
             table+="<td>"+value.semester_code+"</td>";
             table+="<td>"+value.semester+"</td>";
             table+="<td>"+value.tern+"</td>";
        });
        $("tbody").html(table);
        $('#zero_config').DataTable();
       },
       "JSON"
   ); 
 }