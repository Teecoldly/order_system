$(document).ready(function () {
    $("#subject_tech_add").click(function (e) { 
        e.preventDefault();
        var subject_id =$("#subject_id").val();
        var personnel_id =$("#personnel_id").val();
        $.post("ajax/ajax_subject.php", {getuse:1},
            function (data ) {
               
                var semester_code = data ;
                $.post("ajax/ajax_subject.php", {insert_semester:1,semester_code:semester_code,subject_id:subject_id,personnel_id:personnel_id },
                    function (data) {
                         
                        if(Number(data)==3){
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: "มีข้อมูลในระบบแล้ว",
                              })
                        }
                        else if(Number(data)==2){
                            Swal.fire({
                                icon: 'warning',
                                title: 'เกิดข้อผิดพลาด',
                                text: "กรุณาลองใหม่อีกครั้ง",
                              })
                        }else{
                            
                            $('#addnew').modal('toggle');
                            loaddata();
                        }
                    } 
                );
            } 
        );
    });
});
loaddata();
function loaddata() {
     $.post("ajax/ajax_subject.php", {load_subject_personel:1},
         function (data) {
             var table = "";
             var i =1;
             $.each(data, function (index, value) { 
                  table+="<tr>";
                  table+="<td>"+(i++)+"</td>";
                  table+="<td>"+(value.semester_code)+"</td>";
                  table+="<td>"+(value.subject_name)+"</td>";
                  table+="<td>"+(value.name)+"</td>";
            
                  table+="</tr>";
             });
             $("tbody").html(table);
             $('#zero_config').DataTable();
         },
         "JSON"
     );
  }