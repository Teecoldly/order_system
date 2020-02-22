$(document).ready(function () {
    loaddatatable() ;
    $("#product_type_add").click(function (e) { 
        e.preventDefault();
        var type_name = $("#product_add").val();
        $.post("ajax/ajax_product.php", {product_type_add:type_name},
            function (data,) {
                $.post("ajax/status.php", {PAGE:"peroduct_type",ERROR:data},
                    function (data) {
                        if (data == "บันทึกข้อมูลเข้าสู่ระบบสำเร็จ") {
                            Swal.fire({
                              icon: 'success',
                              title: 'เพิ่มข้อมูล',
                              text: data,
              
                            })
                            loaddatatable();
              
                          } else {
                            Swal.fire({
                              icon: 'error',
                              title: 'เพิ่มข้อมูล',
                              text: data,
                            })
                            loaddatatable();
                          }
                          $('#addnew').modal('toggle');
                          $("#product_add").val("");
                          
                    } 
                );
            }
        );
    });
    function loaddatatable() {  
        var table = "";
        $.post("ajax/ajax_product.php",
            function (data) {
                var i =1 ;
         
                $.each(data.data, function (index, value) { 
                    table+="<tr>";
                    table+="<td>"+(i++)+"</td>";
                    table+="<td>"+value.type_name+"</td>";
                    table += "<td> <button type='button' class='btn btn-warning  btn-sm ml-1' id='edit_data' data-toggle='modal' data-target='#edit_data_modal' data-id='" + value.type_ID + "' data-value='"+value.type_name+"'>แก้ไข</button>   " +
                    "<button type='button' class='btn btn-dark  btn-sm' id ='delete_id'   data-id='" + value.type_ID + "'>ลบ</button>" +
                    "</td>";
                    table+="</tr>";
                     
                });  
                $("tbody").html(table);
                $('#zero_config').DataTable();
            },
            "JSON"
        );
    }
    $(document).on('click', '#edit_data', function () {
        var type_id = $(this).attr('data-id');
        var value = $(this).attr('data-value');
        $("#type_id").val(type_id);
        $("#product_edit").val(value);
    });
   $("#product_type_edit").click(function (e) { 
       e.preventDefault();
       var type_id =$("#type_id").val();
       var product_edit =$("#product_edit").val();
       $.post("ajax/ajax_product.php", {product_type_edit:type_id,product_edit:product_edit},
           function (data) {
            $.post("ajax/status.php", {PAGE:"peroduct_type",ERROR:data},
            function (data) {
                if (data == "บันทึกข้อมูลแก้ไขข้อมูลสำเร็จ") {
                    Swal.fire({
                      icon: 'success',
                      title: 'แก้ไขข้อมูล',
                      text: data,
      
                    })
                    loaddatatable();
      
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'แก้ไขข้อมูล',
                      text: data,
                    })
                    loaddatatable();
                  }
                  $('#edit_data_modal').modal('toggle');
                
                  
                } 
            ); 
           }
       );
       
   });
   $(document).on('click', '#delete_id', function (e) {
       e.preventDefault();
 
       
       var type_id = $(this).attr('data-id');
       Swal.fire({
        title: 'แน่ใจที่จะลบข้อมูลนี้?',
        text: "ต้องการที่จะลบข้อมูลนี้จริงหรือ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ต้องการ',
        cancelButtonText: 'ยกเลิก'
      }).then((result) => {
        if (result.value) {
          $.post("ajax/ajax_product.php", {
              delete_id: type_id
            },
            function (data) {
              $.post("ajax/status.php", {
                  PAGE: "peroduct_type",
                  ERROR: data
                },
                function (data) {
                  if (data == "ลบข้อมูลสำเร็จ") {
                    Swal.fire({
                      icon: 'success',
                      title: 'ลบข้อมูล',
                      text: data,
  
                    })
                    loaddatatable();
  
                  }  
                }
              );
            }
          );
        }
      });
   });
});