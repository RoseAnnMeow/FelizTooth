<?php
include('authentication.php');
include('includes/header.php');
include('config/dbconn.php');
?>
<body>
<div class="wrapper">
<div class="row">
            <div class="col-md-12">
                <div class="invoice p-3 mb-3">
              <!-- title row -->
                  <div class="row d-flex justify-content-start">
                      <div class="col-md-10">
                          <h4 class="text-primary text-left top_title">
                          Feliz Tooth District Clinic
                          </h4>
                          <address class="text-left">
                              795 Folsom Ave, Suite 600
                              San Francisco, CA 94107<br>
                              Phone: (804) 123-5432<br>
                              Email: info@almasaeedstudio.com
                          </address>
                      </div>
                      <div class="col-md-2 d-flex justify-content-end"> 
                      <img src="assets/dist/img/FelizToothLogo.png" height="100" alt="">
                      </div>
                  </div>
                <hr>
                <div class="row mb-2 d-flex justify-content-start">                   
                    <div class="col-md-3">
                        Date: 27-11-2021
                    </div>
                    <div class="col-md-3">
                        Prescription ID: 6
                    </div>
                    <div class="col-md-3">
                        Patient ID: 6
                    </div>
                </div>
                <hr>
                <div class="row mb-2 d-flex justify-content-start">                   
                    <div class="col-md-3">
                        Name: Rose Ann Bonador
                    </div>
                    <div class="col-md-3">
                        Addresss: 795 Folsom Ave, Suite 600
                    </div>
                    <div class="col-md-3">
                        Age: 51 yrs old
                    </div>
                    <div class="col-md-3">
                        Gender: Male
                    </div>
                </div>
                <hr>

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-md-4">
                  <p class="lead">Diagnosis</p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                  <i class="fas fa-prescription fa-4x"></i>

                  <div class="table-responsive">
                    <table class="table table-hover table-borderless">                      
                        <thead>       
                            <th>Medicine</th>
                            <th></th>
                            <th class="text-right"></th>    
                        </thead>
                        <tbody>
                        <tr>
                            <td class="">Napa Extra - 500 </td>
                            <td class="">10 - before food </td>
                            <td class="text-right">0+0+1 </td>
                        </tr>
                        <tr>
                            <td class="">Napa Extra - 500 </td>
                            <td class="">10 - before food </td>
                            <td class="text-right">0+0+1 </td>
                        </tr>
                        </tbody>
                    </table>
                  </div>
                </div>                
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">                   
                    <div class="col-md-12 text-right mb-4" style="margin-top:60px;">
                        Name: Rose Ann Bonador<br>
                        Lic No: Rose Ann Bonador<br>
                        PTR No: Rose Ann Bonador<br>
                    </div>                 
                </div>
            </div>
            </div>
        </div>
</div>
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>