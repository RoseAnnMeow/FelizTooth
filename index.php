
<?php
include('admin/config/dbconn.php');
include('main/header.php');
include('main/topbar.php');
?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container">
      <h1>Welcome to Feliz Tooth<br> District</h1>
      <h2>Here to fix teeth and give confidence with your smiles</h2>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Why Choose Feliz Tooth District?</h3>
              <p>
              Creating an account in Feliz Tooth District will give you an advantage and access to your teeth status, appointment status, you can view prescriptions, fees, and treatment performed to your teeth.
              </p>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-calendar-check"></i>
                    <h4>View Appointment</h4>
                    <p>View all the appointments</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-capsule"></i>
                    <h4>View Prescriptions</h4>
                    <p>Check the prescriptions and instructions</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-file"></i>
                    <h4>View Fees and Treatments</h4>
                    <p>View all the total fees and treatments made</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox play-btn mb-4"></a>
          </div>

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
            <h3>Enim quis est voluptatibus aliquid consequatur fugiat</h3>
            <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus laudantium. Soluta voluptate sed facere corporis dolores excepturi. Libero laboriosam sint et id nulla tenetur. Suscipit aut voluptate.</p>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-fingerprint"></i></div>
              <h4 class="title"><a href="">Lorem Ipsum</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-gift"></i></div>
              <h4 class="title"><a href="">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-atom"></i></div>
              <h4 class="title"><a href="">Dine Pad</a></h4>
              <p class="description">Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit. Sunt aut deserunt minus aut eligendi omnis</p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
          <p>We go beyond making sure your teeth and gums are healthy. Here, your smile gets the makeover that you need and desire through various dedicated treatments covering Cosmetic Dentistry, Prosthodontics Treatment, Oral Surgery, Periodontics, Orthodontic Treatment, Restorative Treatment, and Oral Prophylaxis</p>
        </div>

        <div class="row">

        <?php
            $sql = "SELECT * FROM services";
            $query_run = mysqli_query($conn,$sql);
            $check_services = mysqli_num_rows($query_run) > 0;

            if($check_services)
            {
              while($row = mysqli_fetch_array($query_run))
              {
                ?>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 ">
            <div class="icon-box">
              <div class="icon"><a href="our-services.php?title=<?=$row['title']?>"><img src="upload/service/<?=$row['image']?>" class="img-fluid card-img-top"></a></div>
              <h4><a href="our-services.php?title=<?=$row['title']?>"><?=$row['title']?></a></h4>
            </div>
          </div>
          <?php
          }
        }
        else
        {
          echo "<h5> No Record Found</h5>";
        }?>
          

       

        </div>

      </div>
    </section><!-- End Services Section -->


    <!-- ======= Appointment Section ======= -->
    <section id="appointment" class="appointment section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Make an Appointment</h2>
          <p>Create an account and book your first appointment today to experience quality and safe dental journey. Get the best dental treatment in the Philippines with a click.</p>
        </div>

        <form action="forms/appointment.php" method="post" role="form" class="php-email-form">
          <div class="mb-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
          </div>
          <div class="text-center"><a href="request-appointment.php" class="appointment-btn" style="font-size:23px;"><span class="d-none d-md-inline"></span>Make an Appointment</a></div>
        </form>

      </div>
    </section><!-- End Appointment Section -->

    <section class="departments">
      <div class="container">

        <div class="section-title">
          <h2>Dental Services Rates</h2>
          <p>We offer the greatest service at a very affordable price. Enjoy the benefits of our state of the art facilities with our well trained professional dentist.</p>
        </div>

        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
            <?php
            $count = 1;
            $sql = "SELECT DISTINCT p.service_id,s.id,s.title FROM services as s INNER JOIN procedures as p ON s.id = p.service_id;";
            $query_run = mysqli_query($conn,$sql);
            $service_tab = mysqli_num_rows($query_run) > 0;

            if($service_tab)
            {
              while($row = mysqli_fetch_array($query_run))
              {
                ?>
              <li class="nav-item">
                <a class="nav-link <?php if($count == '1') { echo 'active show';}?>" data-bs-toggle="tab" href="#tab-<?=$row['service_id']?>"><?=$row['title']?></a>
              </li>
              <?php $count++; ?>
              <?php
              }
            }
            ?>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
            <?php
            $count = 1;
            $sql = "SELECT s.id,s.title,s.image,p.service_id,p.procedures,p.price FROM services as s INNER JOIN procedures as p ON s.id = p.service_id;";
            $query_run = mysqli_query($conn,$sql);

              while($row = mysqli_fetch_array($query_run))
              {
                ?>
              <div class="tab-pane <?php if($count == '1') { echo 'active show';}?>" id="tab-<?=$row['service_id']?>">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3><?=$row['title']?></h3>
                    <table class="table table-borderless" style="width:100%;">
                      <thead>
                        <tr>
                          <th>Particular</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $prod = $row['service_id'];
                        $sql2 = "SELECT * FROM procedures WHERE service_id = '$prod'";
                        $query_run2 = mysqli_query($conn, $sql2);
                        
                        while($data = mysqli_fetch_array($query_run2)){?>
                        <tr>
                          <td><?=$data['procedures']?></td>
                          <td>₱<?=number_format($data['price'])?> per unit</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="upload/service/<?=$row['image']?>" alt="" class="img-fluid">
                  </div>
                </div>
                <?php $count++; ?>
              </div>
              <?php
              }
            ?>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section id="doctors" class="doctors">
      <div class="container">

        <div class="section-title">
          <h2>Dentist</h2>
          <p>Completing the team are competent dentists with different specializations, unfailing dental nurse assistants and aides, skilled laboratory technicians, and dependable staff, all ready to assist patients with any concern.</p>
        </div>

        <div class="row">
        <?php
            $count = 1;
            $sql = "SELECT f.description,f.image,d.name,d.specialty FROM featured f INNER JOIN tbldoctor d ON f.dentist_id = d.id";
            $query_run = mysqli_query($conn,$sql);
            $doctors = mysqli_num_rows($query_run) > 0;

            if($doctors)
            {
              while($row = mysqli_fetch_array($query_run))
              {
                ?>

          <div class="col-lg-6 <?php if($count > '1') { echo 'mt-4 mt-lg-0';}?>">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="admin/assets/dist/img/featured-dentist/<?=$row['image']?>" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4><?=$row['name']?></h4>
                <span><?=$row['specialty']?></span>
                <p><?=$row['description']?></p>
              </div>
            </div>
            <?php $count++; ?>
          </div>
          <?php
              }
            }
            ?>

        </div>

      </div>
    </section>
    <section id="testimonials" class="testimonials">
      <div class="container">
      <div class="section-title">
          <h2>What People Say About Feliz Tooth District Dental Clinic</h2>
          <p>Our satisfied clients share their experience at Feliz Tooth District Dental Clinic.</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
          <?php
            $sql = "SELECT * FROM reviews WHERE status='Active'";
            $query_run = mysqli_query($conn,$sql);
            $check_services = mysqli_num_rows($query_run) > 0;

            if($check_services)
            {
              while($row = mysqli_fetch_array($query_run))
              {?>
            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="admin/assets/dist/img/testimonials/<?=$row['image']?>" class="testimonial-img" alt="">
                  <h3><?=$row['name']?></h3>
                  <h4><?=$row['designation']?></h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    <?=$row['review']?>
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div>
            <?php } } ?>

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>
    <section id="gallery" class="gallery">
      <div class="container">

        <div class="section-title">
          <h2>Gallery</h2>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row no-gutters">
        <?php
            $sql = "SELECT * FROM gallery where status='Active'";
            $query_run = mysqli_query($conn,$sql);
            $check_services = mysqli_num_rows($query_run) > 0;

            if($check_services)
            {
              while($row = mysqli_fetch_array($query_run))
              {?>
          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="admin/assets/dist/img/gallery/<?=$row['image']?>" class="galelry-lightbox">
                <img src="admin/assets/dist/img/gallery/<?=$row['image']?>" alt="" class="img-fluid">
              </a>
            </div>
          </div>
          <?php } } ?>

        </div>

      </div>
    </section><!-- End Gallery Section -->


  <?php 
  include('main/footer.php');
  include('main/scripts.php');
  ?>