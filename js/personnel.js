$(document).ready(function () {
  loaddatatable();
  $(document).on('click', '#Allowid', function () {
    var personnel_id = $(this).attr('data-id');
    Swal.fire({
      icon: 'warning',
      title: 'คุณต้องการแก้ไข',
      text: 'อนุญาติให้เข้าสู๋ระบบ',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ต้องการ',
      cancelButtonText: 'ยกเลิก'

    }).then((result) => {
      if (result.value) {
        $.post("ajax/ajax_personnel.php", {
            allow: 1,
            personnel_id: personnel_id
          },
          function (data) {
            loaddatatable();
          }
        );
      }
    })
  });

  function loaddatatable() {
    $.post("ajax/ajax_personnel.php",
      function (data) {
        var table;
        var result = JSON.parse(data)
        var st = 1;

        $.each(result.data, function (index, value) {


          table += "<tr>";
          table += "<td>" + (st++) + "</td>";
          table += "<td>" + value.id_card + "</td>";
          table += "<td>" + value.name + "</td>";
          table += "<td>" + value.lastname + "</td>";
          table += "<td>" + value.phone + "</td>";
          if (value.type_ID == "1") {
            table += "<td> <span class='badge badge-pill badge-success'>เจ้าหน้าที่</span></td>";
          } else if (value.type_ID == "2") {
            table += "<td> <span class='badge badge-pill  badge-danger'>อาจารย์</span></td>";
          } else {
            table += "<td> <span class='badge badge-pill badge-warning'>หัวหน้าแผนก</span></td>";
          }
          if (value.permission == 0) {
            table += "<td> <button type='button' id='Allowid' class='btn btn-success  btn-sm ml-1'   data-id='" + value.personnel_id + "' >อนุญาติเข้าสู่ระบบ</button>   " +
              "<button type='button' class='btn btn-dark  btn-sm' id ='delete_id'   data-id='" + value.personnel_id + "'>ลบ</button>" +
              "</td>";
          } else {
            table += "<td> <button type='button' id='edit_data' class='btn btn-warning  btn-sm ml-1' data-toggle='modal' data-target='#editdata' data-id='" + value.personnel_id + "' >แก้ไข</button>   " +
              "<button type='button' class='btn btn-dark  btn-sm' id ='delete_id'   data-id='" + value.personnel_id + "'>ลบ</button>" +
              "</td>";
          }


          table += "</tr>";

        });
        $("tbody").html(table);
        $('#zero_config').DataTable();
      }
    );
  }
  $(document).on('click', '#edit_data', function () {
    var personnel_id = $(this).attr('data-id');
    var datauser;


    $.ajax({
      url: 'ajax/ajax_personnel.php',
      async: false,
      type: 'post',
      data: {
        ID: personnel_id
      },
      dataType: 'json',
      success: function (output) {
        datauser = output.data;
      }
    });

    var type_id = datauser[0].type_ID;
    $("#id").val(datauser[0].personnel_id);
    $("#id_card").val(datauser[0].id_card);
    $("#name").val(datauser[0].name);
    $("#Lastname").val(datauser[0].lastname);
    $("#username").val(datauser[0].username);
    $("#password").val(datauser[0].password);
    $("#phone").val(datauser[0].phone);
    $("#type_id").val(type_id);





  });
  $("#save_personnel").click(function (e) {
    e.preventDefault();

    var id = $("#id").val();
    var id_card = $("#id_card").val();
    var name = $("#name").val();
    var Lastname = $("#Lastname").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var phone = $("#phone").val();
    var type_id = $("#type_id").val();
    if (id_card.length != 13) {
      Swal.fire({
        icon: 'error',
        title: 'บัตรประชาชน',
        text: 'เลขบัตรประชาชนไม่ถูกต้อง',
      })

    } else if (phone.length != 10) {
      Swal.fire({
        icon: 'error',
        title: 'เบอร์โทร',
        text: 'เบอร์โทรไม่ถูกต้อง',
      })

    } else {
      $.post("ajax/ajax_personnel.php", {
          update_id: id,
          id_card: id_card,
          name: name,
          Lastname: Lastname,
          username: username,
          password: password,
          phone: phone,
          type_id: type_id
        },
        function (data) {


          $.post("ajax/status.php", {
              PAGE: "personnel",
              ERROR: data
            },
            function (data) {
              if (data == "บันทึกข้อมูลสำเร็จ") {
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
            }
          );
        }
      );
    }

    $('#editdata').modal('toggle');
  });
  $(document).on('click', '#delete_id', function () {
    var personnel_id = $(this).attr('data-id');

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
        $.post("ajax/ajax_personnel.php", {
            delete_id: personnel_id
          },
          function (data) {
            $.post("ajax/status.php", {
                PAGE: "personnel",
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

                } else if (data == "ลบไม่ได้เนื่องจากมีบันทึกข้อมูลในระบบแล้วจึงไม่อนุญาติให้ลบ") {
                  Swal.fire({
                    icon: 'error',
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


  $("#personal_add").click(function (e) {
    e.preventDefault();


    var id_card = $("#id_card_add").val();
    var name = $("#name_add").val();
    var Lastname = $("#Lastname_add").val();
    var username = $("#username_add").val();
    var password = $("#password_add").val();
    var phone = $("#phone_add").val();

    if (id_card.length != 13) {
      Swal.fire({
        icon: 'error',
        title: 'บัตรประชาชน',
        text: 'เลขบัตรประชาชนไม่ถูกต้อง',
      })

    } else if (phone.length != 10) {
      Swal.fire({
        icon: 'error',
        title: 'เบอร์โทร',
        text: 'เบอร์โทรไม่ถูกต้อง',
      })

    } else {
      $.post("ajax/ajax_personnel.php", {
          addnew_id: 1,
          id_card: id_card,
          name: name,
          Lastname: Lastname,
          username: username,
          phone: phone,
          password: password,
          type_id: 2
        },
        function (data) {
          if (data.status == 'success') {
            Swal.fire({
              icon: 'success',
              title: 'การดำเนินการ',
              text: data.msg,

            }).then((result) => {
              $('#addnew').modal('toggle');

              $("#id_card_add").val("");
              $("#name_add").val("");
              $("#Lastname_add").val("");
              $("#username_add").val("");
              $("#password_add").val("");
              $("#phone_add").val("");
            })
          } else {
            Swal.fire({
              icon: 'error',
              title: 'การดำเนินการ',
              text: data.msg,

            })
          }
        },
        "JSON"
      );
    }
  });
});