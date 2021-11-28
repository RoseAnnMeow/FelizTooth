<script src="admin/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="admin/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script>
//   window.setTimeout(function() {
//     $(".alert").fadeTo(600, 0).slideUp(600, function(){
//         $(this).remove(); 
//     });
// }, 4000);
</script>
<!-- Bootstrap 4 -->
<script src="admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="admin/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!-- DataTables  & Plugins -->
<script src="admin/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="admin/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="admin/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="admin/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="admin/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="admin/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="admin/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="admin/assets/plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="admin/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="admin/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert2 -->
<script src="admin/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="admin/assets/plugins/toastr/toastr.min.js"></script>
<!-- Datetimepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="admin/assets/plugins/moment/moment.min.js"></script>
<script src="admin/assets/plugins/fullcalendar/main.js"></script>
<!-- Select2 -->
<script src="admin/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="admin/assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="admin/assets/dist/js/pages/dashboard.js"></script>


  <script>
    $(document).ready(function () {

      $(document).on('click', '.logoutbtn', function() {       
      $('#logoutModal').modal('show'); 
    });

      $(document).on('click', '.viewbtn', function() {       
        var userid = $(this).data('id');

        $.ajax({
        url: 'code.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){ 
          
          $('.patient_viewing_data').html(response);
          $('#ViewPatientModal').modal('show'); 
        }
      });
    });
});
</script>

<script>
  $(document).ready(function () {

    $(document).on('click', '.editbtn', function() {          
      var user_id = $(this).data('id');

      $.ajax({
        type: "POST",
        url: "code.php",
        data:
        {
          'checking_editbtn':true,
          'user_id':user_id,
        },
        success: function (response) {
        $.each(response, function (key, value){
          $('#edit_id').val(value['id']);
          $('#edit_fname').val(value['fname']);
          $('#edit_address').val(value['address']);
          $('#edit_dob').val(value['dob']);
          $('#edit_gender').val(value['gender']);
          $('#edit_phone').val(value['phone']);
          $('#edit_email').val(value['email']);
          $('#edit_password').val(value['password']);
          $('#edit_cpassword').val(value['password']);
        });

        $('#EditPatientModal').modal('show');
        }
      });
    });
  });
  </script>

<script>
  var password = document.getElementById("password"), 
  confirmPassword = document.getElementById("confirmPassword");

  function validatePassword(){
  if(password.value != confirmPassword.value) {
    confirmPassword.setCustomValidity("Password does not match");
  } else {
    confirmPassword.setCustomValidity('');
  }
}
  password.onchange = validatePassword;
  confirmPassword.onkeyup = validatePassword;
</script>

<script>
  $(document).ready(function () {
    $('.email_id').keyup(function (e) { 
      var email = $('.email_id').val();

      $.ajax({
        type: "post",
        url: "code.php",
        data: {
          'check_Emailbtn': true,
          'email': email,
        },
        success: function (response) {
          $('.email_error').text(response);
        }
      });
    });
  });
</script>


<script>
    $('#scheddate').datepicker({
        startDate: new Date()
      });

      $('#datepicker').datepicker({
      todayHighlight: true,
      clearBtn: true,
      autoclose: true,
      endDate: new Date()
})

</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

