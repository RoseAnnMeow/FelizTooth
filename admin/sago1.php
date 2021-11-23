<script>
    $(document).ready(function () {
      getData();

    $('#datepicker').datepicker({
    todayHighlight: true,
    clearBtn: true,
    autoclose: true,
    endDate: new Date()
    })

    $('.addDoctor').click(function (e) { 
      e.preventDefault();

      var doc_fname = $('.fname').val();
      var doc_address = $('.address').val();
      var doc_dob = $('.birthday').val();
      var doc_gender = $('.gender').val();
      var doc_phone = $('.phone').val();
      var doc_email = $('.email').val();
      var doc_degree = $('.degree').val();
      var doc_specialty = $('.specialty').val();
      var password = $('.password').val();
      var confirmPassword = $('.confirmPassword').val();
      var doctor_profile_image = $('doc_image').val();

      
      // if(doc_fname != '' & doc_dob != '' & doc_address !='' & doc_gender !='' & doc_phone !='' & doc_email !='' & doc_degree !='' & doc_specialty !='' &  password !='' &  confirmPassword !='')
      if(doc_fname != '' & doc_dob != '' & doc_address !='' & doc_gender !='' & doc_phone !='')
      {
          $.ajax({
          type: "POST",
          url: "doctor_action.php",
          data: {
            'insertdoctor':true,
            'fname':doc_fname,
            'birthday':doc_dob,
            'address':doc_address,
            'gender':doc_gender,
            'phone':doc_phone,
            'email':doc_email,
            'degree':doc_degree,
            'specialty':doc_specialty,
            'password':password,
            'confirmPassword':confirmPassword,
            'doc_image':doctor_profile_image,
            },
          success: function (response) {
            $('#AddDoctorModal').modal('hide');
            $('.message-show').append('\
                <div class="alert alert-success alert-dismissible fade show" role="alert">\
                '+response+'\
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                  <span aria-hidden="true">&times;</span>\
                </button>\
              </div>\
        ');
           // $('.doctor_data').html("");
            //getData();
          }
        });
      }
      else
      {
        // console.log("Please enter all fields");
        $('.error-message').append('\
            <div class="alert alert-warning alert-dismissible fade show" role="alert">\
            Please enter all fields.\
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
              <span aria-hidden="true">&times;</span>\
            </button>\
          </div>\
        ');
      }     
    });

    $(document).on('click', '.viewDoctorbtn', function() {       
    var userid = $(this).data('id');

    $.ajax({
    url: 'doctor_action.php',
    type: 'post',
    data: {
      'checking_viewDoctortbtn':true,
      'user_id':userid,
    },
    success: function(response){ 
      
        $('.doctor_viewing_data').html(response);
        $('#ViewDoctorModal').modal('show'); 
      }
    });
  });

    //Doctor Edit Modal
    $(document).on('click', '.editDoctorbtn', function() {          
      var userid = $(this).data('id');

      $.ajax({
        type: "POST",
        url: "doctor_action.php",
        data:
        {
          'checking_editDoctorbtn':true,
          'user_id':userid,
        },
        success: function (response) {
        $.each(response, function (key, value){
          $('#edit_id').val(value['id']);
          $('#edit_fname').val(value['name']);
          $('#edit_address').val(value['address']);
          $('#edit_dob').val(value['dob']);
          $('#edit_gender').val(value['gender']);
          $('#edit_phone').val(value['phone']);
          $('#edit_email').val(value['email']);
          $('#edit_degree').val(value['degree']);
          $('#edit_specialty').val(value['specialty']);
          $('#uploaded_image').html('<img src="'+value['image']+'" class="img-fluid img-thumbnail" width="120" />');
          $('#hidden_doctor_profile_image').val(value['image']);
          $('#edit_password').val(value['password']);
          $('#edit_confirmPassword').val(value['password']);
        });

        $('#EditDoctorModal').modal('show');
        }
      });
    });
    //     $("#selectAll").change(function(){
  //    var checked = $(this).is(':checked');
  //    if(checked){
  //      $('input[name="update_status[]"]').each(function(){
  //        $(this).prop("checked",true);
  //      });
  //    }else{
  //      $('input[name="update_status[]"]').each(function(){
  //        $(this).prop("checked",false);
  //      });
  //    }
  //  });
      // Changing state of CheckAll checkbox 
      

      //Doctor Delete Modal
    $(document).on('click','.deleteDoctorbtn', function(){
    
    var user_id = $(this).data('id');
    $('#delete_id').val(user_id);
    $('#DeleteDoctorModal').modal('show');
    
    });

  });
  function getData()
    {
      $.ajax({
        type: "POST",
        url: "doctor_action.php",
        data: {
            'fetch':true,
            },
        success: function (response) {
          $.each(response, function (key, value)
          {
            
            $('.doctor_data').append('<tr>'+
            '<td><img src="'+value['image']+'" class="img-thumbnail" width="60"/></td>\
            <td>'+value['name']+'</td>\
            <td>'+value['phone']+'</td>\
            <td>'+value['email']+'</td>\
            <td>'+value['specialty']+'</td>\
            <td>\
              <button data-id="'+value['id']+'" class="btn btn-sm btn-secondary viewDoctorbtn"><i class="fa fa-eye"></i></button>\
              <button data-id="'+value['id']+'" class="btn btn-sm btn-primary editDoctorbtn"><i class="fas fa-edit"></i></button>\
              <button data-id="'+value['id']+'" class="btn btn-danger btn-sm deleteDoctorbtn"><i class="far fa-trash-alt"></i></button>\
            </td>\
            </tr>');
          });
          
        }
      });
    }
</script>
