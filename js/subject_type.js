$(document).ready(function () {
    $("#subject_type_edit").click(function (e) { 
        e.preventDefault();
        var id = $('#id').val();
        var name =   $('#subject_edit_name').val();
        $.post("ajax/ajax_subject.php", {update:1,id:id,name:name},
            function (data) {
                if(data==2){
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'กรุณาตรวจสอบอีกครั้ง',
                      })
                }else{
                    $('#editdata').modal('toggle');
                    loaddata();
                }
            } 
        );
        
    });
    $(document).on('click', '#edit_data', function (e) {
        e.preventDefault();
       var id =  $(this).attr('data-id');
       var name =  $(this).attr('data-name');
       $('#id').val(id);
       $('#subject_edit_name').val(name);
    });
    $("#subject_save").click(function (e) { 
        e.preventDefault();
       var subject_id =  $('#subject_id').val();
       var subject_name =  $('#subject_name').val();
       if(subject_id==''){
        Swal.fire({
            icon: 'error',
            title: 'รหัสวิชา',
            text: 'รหัสวิชาถูกต้อง',
          })
       }  else if(subject_name==''){
        Swal.fire({
            icon: 'error',
            title: 'ชื่อวิชา',
            text: 'ชื่อวิชาไม่ถูกต้อง',
          })
        }else{
            $.post("ajax/ajax_subject.php", {add:1 , subject_id:subject_id,subject_name:subject_name},
                function (data ) {
                    $('#addnew').modal('toggle');
                    $('#subject_id').val()
                    loaddata();
                } 
            );
        }
    });
});
loaddata();
function loaddata() {
$.post("ajax/ajax_subject.php",
    function (data) {
        var table = "";
        var i = 1;
        $.each(data, function (index, value) { 
            table +="<tr>";
            table +="<td>"+(i++)+"</td>"
            table +="<td>"+value.subject_id+"</td>"
            table +="<td>"+value.subject_name+"</td>"
            table +="<td> <button type='button' id='edit_data' class='btn btn-warning  btn-sm ml-1' data-toggle='modal' data-target='#editdata' data-id='" + value.subject_id + "'data-name ='"+value.subject_name +"'>แก้ไข</button> "
            table +="</tr>";
        });
        $("tbody").html(table);
        $('#zero_config').DataTable();
       
    },
    "JSON"
);
}