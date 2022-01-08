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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.29/jquery.inputmask.min.js" integrity="sha512-Ax4+qW2rAVWrk3SU1ef/L8O0jF6vKSfaMIR3du6efzf5v/pibzDcLFx29YCeR7WphoPO4zranQFsFUf+9Rb+dg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--Custom JS -->
<script src="admin/assets/dist/js/custom.js"></script>
<script>
  $(document).ready(function () {

    $('#password').keyup(function() {
  
  if($(this).val().length == 0) 
  {
      $('.show_hide').hide();
  }
  else
  {
      $('.show_hide').show();
  }
  }).keyup(); 

    $("#phone").inputmask({"mask": "+639999999999"});
    $('#password').keyup(function() {
        var password = $('#password').val();
        if (checkStrength(password) == false) {
          password.setCustomValidity('');

        }
    });

    function checkStrength(password) {
        var strength = 0;

       //If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
            strength += 1;
            $('.low-upper-case').addClass('text-success');
            $('.low-upper-case i').removeClass('fa-exclamation-triangle').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.low-upper-case').removeClass('text-success');
            $('.low-upper-case i').addClass('fa-exclamation-triangle').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }

        //If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-exclamation-triangle').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-exclamation-triangle').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }

        //If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
            strength += 1;
            $('.one-special-char').addClass('text-success');
            $('.one-special-char i').removeClass('fa-exclamation-triangle').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.one-special-char').removeClass('text-success');
            $('.one-special-char i').addClass('fa-exclamation-triangle').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }

        if (password.length > 7) {
            strength += 1;
            $('.eight-character').addClass('text-success');
            $('.eight-character i').removeClass('fa-exclamation-triangle').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.eight-character').removeClass('text-success');
            $('.eight-character i').addClass('fa-exclamation-triangle').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }

        // If value is less than 2

        if (strength < 2) {
            $('#result').removeClass()
            $('#password-strength').addClass('bg-danger');

            $('#result').addClass('text-danger').text('Very Weak');
            $('#password-strength').css('width', '10%');
        } else if (strength == 2) {
            $('#result').addClass('good');
            $('#password-strength').removeClass('bg-danger');
            $('#password-strength').addClass('bg-warning');
            $('#result').addClass('text-warning').text('Weak')
            $('#password-strength').css('width', '60%');
            return 'Weak'
        } else if (strength == 4) {
            $('#result').removeClass()
            $('#result').addClass('strong');
            $('#password-strength').removeClass('bg-warning');
            $('#password-strength').addClass('bg-success');
            $('#result').addClass('text-success').text('Very Strong');
            $('#password-strength').css('width', '100%');

            return 'Strong'
        }
    }
  });
</script>
