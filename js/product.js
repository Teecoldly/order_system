$(document).ready(function () {
    load_product_type();
    loadproduct();
 
    function load_product_type() {
        $.post("ajax/ajax_product.php",
            function (data) {
             
                
                var type="";
                $.each(data.data, function (index, value) { 
                     type+='<option value='+value.type_ID+'>'+value.type_name+'</option>';
                });
                $("#type_ids").html(type);
                $("#type_ids_edit").html(type);
            },"JSON");
    }
    function loadproduct() { 
        $.post("ajax/ajax_product.php", {loadproduct:1},
            function (data) {
                var table ;
                var i=1;
                $.each(data.data, function (index, value) { 
                     table+="<tr>";
                     table+="<td>"+(i++)+"</td>";
                     table+="<td>"+value.product_key+"</td>";
                     table+="<td>"+value.product_name+"</td>";
                     table+="<td>"+value.detail+"</td>";
                     table+="<td>"+value.price+"</td>";
                     table+="<td>"+value.unit_type+"</td>";
                     table+="<td>"+value.type_name+"</td>";
                 
                     table += "<td> <button type='button' class='btn btn-warning  btn-sm ml-1' id='edit_data' data-toggle='modal' data-target='#edit_data_modal' data-id='" + value.product_id + "' data-detail='"+value.detail+"' data-product_key='"+value.product_key+"' data-product_name='"+value.product_name+"' data-price='"+value.price+"' data-unit_type='"+value.unit_type+"' data-type_ID='"+value.type_ID+"'>แก้ไข</button>   " +
                    "<button type='button' class='btn btn-dark  btn-sm' id ='delete_id'   data-id='" + value.product_id + "'>ลบ</button>" +
                    "</td>";
                     table+="</tr>";
                });
                $("tbody").html(table);
                $('#zero_config').DataTable();
            },
            "JSON"
        );
        
     }
     $(document).on('click', '#edit_data', function (e) {
      e.preventDefault();
      var product_id = $(this).attr('data-id');
      var product_key = $(this).attr('data-product_key');
      var product_name= $(this).attr('data-product_name');
      var product_type= $(this).attr('data-type_id');
      var unit_type = $(this).attr('data-unit_type'); 
      var price =  $(this).attr('data-price');
      var detail =  $(this).attr('data-detail');
      $("#product_id_edit").val(product_id);
      $("#product_key_edit").val(product_key);
      $("#product_name_edit").val(product_name);
      $("#product_price_edit").val(price);
      $("#type_ids_edit").val(product_type);
      $("#unit_type_edit").val(unit_type);
      $("#detail_edit").val(detail);
     });
    $("#product_add").click(function (e) { 
        e.preventDefault();
        var product_key =$("#product_key").val();
        var product_name =$("#product_name").val();
        var unit_type =$("#unit_type").val();
        var type_ids =$("#type_ids").val();
        
        var price =  $("#product_price").val();
        $.post("ajax/ajax_product.php", {product_add_new:product_key,product_name:product_name,price:price,unit_type:unit_type,type_ids:type_ids},
            function (data) {
                $.post("ajax/status.php", {
                    PAGE: "product",
                    ERROR: data
                  },
                  function (data) {
                    if (data == "บันทึกข้อมูลเข้าสู่ระบบสำเร็จ") {
                      Swal.fire({
                        icon: 'success',
                        title: 'บันทึกข้อมูล',
                        text: data,
        
                      })
                     
                      loadproduct();
                    } else {
                      Swal.fire({
                        icon: 'error',
                        title: 'บันทึกข้อมูล',
                        text: data,
                      })
                   
                    }
                  }
                );
                
            } 
        );
        $("#product_key").val("");
        $("#product_name").val("");
        $("#product_price").val("");
        $("#unit_type").val("");
        $('#addnew').modal('toggle');
      
   
    });
    $("#product_type_edit").click(function (e) { 
      e.preventDefault();
      var id = $("#product_id_edit").val();
      var key = $("#product_key_edit").val();
      var name = $("#product_name_edit").val();
      var price = $("#product_price_edit").val();
      var unit_type= $("#unit_type_edit").val();
      var type_id= $("#type_ids_edit").val();
      var detail= $("#detail_edit").val();
      $.post("ajax/ajax_product.php", {Edit_id:id,product_key:key,product_name:name,price:price,unit_type:unit_type,product_type:type_id,detail:detail},
        function (data) {
          $.post("ajax/status.php", {
            PAGE: "product",
            ERROR: data
          },
          function (data) {
            if (data == "บันทึกข้อมูลแก้ไขข้อมูลสำเร็จ") {
              Swal.fire({
                icon: 'success',
                title: 'แก้ไขข้อมูล',
                text: data,
              })
            } else {
              Swal.fire({
                icon: 'error',
                title: 'แก้ไขข้อมูล',
                text: data,
              })
            }
          }
        );
        $('#edit_data_modal').modal('toggle');
      
        loadproduct();
        } 
      );
    });
    $(document).on('click', '#delete_id', function (e) {
      e.preventDefault();
      var product_id = $(this).attr('data-id');
   
      
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
              product_delete: product_id
            },
            function (data) {
              $.post("ajax/status.php", {
                  PAGE: "product",
                  ERROR: data
                },
                function (data) {
                  if (data == "ลบข้อมูลสำเร็จ") {
                    Swal.fire({
                      icon: 'success',
                      title: 'ลบข้อมูล',
                      text: data,
  
                    })
                    loadproduct();
  
                  }  
                }
              );
            }
          );
        }
      });
    });
});