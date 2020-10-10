<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PPSPA 6 PUTRI</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?= base_url() ?>assets/frontend/img/ppspa.png" rel="icon">
  <link href="<?= base_url() ?>assets/frontend/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/lib/bootstrap/css/bootstrap.min.css">

  <!-- Libraries CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/lib/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/lib/animate/animate.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/lib/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/lib/owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/lib/lightbox/css/lightbox.min.css">

  <!-- Main Stylesheet File -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/style.css">

  <!-- =======================================================
    Theme Name: NewBiz
    Theme URL: https://bootstrapmade.com/newbiz-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
  <style>
    @media (max-width: 991px) {
      .nav-btn-login{
        display: block;
      }
    }
    @media (min-width: 992px) {
      .nav-btn-login{
        display: none;
      }
    }
  </style>
</head>

<body>

  <!--==========================
  Header
  ============================-->
  <header id="header" class="fixed-top">
    <div class="container">

      <div class="logo float-left">
        <!-- Uncomment below if you prefer to use an image logo -->
        
        <a href="#intro" class="scrollto"><img src="<?= base_url() ?>assets/frontend/img/logo.png" alt="" class="img-fluid"></a>
        <!-- <h1 class="text-light"><a href="#header"><span>PPSPA KOMPLEK 6</span></a></h1> -->
      </div>

      <div class="logo float-right d-none d-lg-block">
        <a href="<?= base_url() ?>login"><button class="btn <?=(!empty($this->com_user['id'])?'btn-light':"btn-primary")?>"><?=(!empty($this->com_user['id'])?'<div class="ion-log-in"></div>':"Login")?></button></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="#intro">Beranda</a></li>
          <li><a href="#faq">FaQ</a></li>
          <li><a href="#portfolio">Galeri</a></li>
          <li><a href="#ttk">Tentang Kami</a></li>
          <li class="nav-btn-login"><a href="<?=base_url()?>login"><?=(!empty($this->com_user['id'])? 'Masuk '.$this->com_user['username'] .' <div class="ion-log-in" style="display:inline" ></div>':"Login")?></a></li>
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container">

      <div class="intro-img">
        <img src="<?= base_url() ?>assets/frontend/img/masjid.svg" alt="" class="img-fluid">
      </div>

      <div class="intro-info">
        <h2>DIBUKA<br><span>Pendaftaran PPSPA</span><br>2020</h2>
        <div>
          <a href="<?= base_url() ?>register" class="btn-get-started scrollto">Daftar Sekarang</a>
        </div>
      </div>

    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <strong><h3>✨ PPSPA 6 PUTRI ✨</strong></h3>
          <p><strong><u>Selamat datang di web Asrama Mahasiswi Pandaran Komplek 6 Putri</u></p></strong>
        </header>

        <div class="row about-container">

          <div class="col-lg-6 content order-lg-1 order-2">
            <p><strong>
              Dibawah ini adalah fitur-fitur yang disediakan oleh Asrama Mahasiswi Komplek 6 Putri.
            </strong></p>

            <div class="icon-box wow fadeInUp">
              <div class="icon"><i class="fa fa-shopping-bag"></i></div>
              <h4 class="title"><a href="">Simple</a></h4>
              <p class="description">Asrama Mahasiswi Komplek 6 Putri menyediakan UI yang sangat simple dan mudah dipahami</p>
            </div>

            <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-photo"></i></div>
              <h4 class="title"><a href="">UI Kekinian</a></h4>
              <p class="description">User Interface yang kami buat sangatlah kekinian dan tidak akan membosankan untuk mata</p>
            </div>

            <div class="icon-box wow fadeInUp" data-wow-delay="0.4s">
              <div class="icon"><i class="fa fa-bar-chart"></i></div>
              <h4 class="title"><a href="">User Friendly</a></h4>
              <p class="description">Di Web Asrama Mahasiswi Komplek 6 Putri ini Web yang sangat User Frienldy jadi kalian tidak usah khawatir</p>
            </div>

          </div>

          <div class="col-lg-6 background order-lg-2 order-1 wow fadeInUp">
            <img src="<?= base_url() ?>assets/frontend/img/hijab.svg" class="img-fluid" alt="">
          </div>
        </div>

        <div id="ttk" class="row about-extra">
          <div class="col-lg-6 wow fadeInUp">
            <img src="<?= base_url() ?>assets/frontend/img/quran.svg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 wow fadeInUp pt-5 pt-lg-0">
            <h4>🌟 Tentang Kami 🌟</h4>
            <p align="justify"> 
            Pondok Pesantren Sunan Pandanaran didirikan oleh Al-Maghfurlah Al-‘Alim Al-Khafidz KH. Mufid Mas’ud dan istrinya Ny. Hj. Jauharoh Munawwir. KH. Mufid Mas’ud dilahirkan di Solo tahun 1928 pada hari Ahad Legi 25 Ramadhan, wafat tanggal 2 April 2007 silam di Jogjakarta. PPSPA didirikan tanggal 20 Desember 1975 di dusun Candi Desa Sardonoharjo, Kecamatan Ngaglik, Kabupaten Sleman. Sebelum hijrah ke Candi, KH. Mufid Mas’ud merupakan salah satu pengasuh di PP. Al Munawwir Krapyak Bantul Yogyakarta. Di atas tanah wakaf sekitar 2000 m2 dengan bangunan di atasnya berupa sebuah rumah dan sebuah masjid, area yang sekarang disebut komplek satu. Seiring perjalanan waktu, PPSPA telah mampu mengembangkan pendidikan-pendidikan yang dikelolanya. PPSPA sekarang memiliki lima komplek asrama yang terpisah-pisah, dengan jumlah santri mukim kurang lebih 1300-an anak
           </p>
          </div>
        </div>

        <div id="faq" class="row about-extra">
          <div class="col-lg-6 wow fadeInUp order-1 order-lg-2">
            <img src="<?= base_url() ?>assets/frontend/img/quran2.svg" class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 wow fadeInUp pt-4 pt-lg-0 order-2 order-lg-1">
            <h4>🌼 Frequently Asked Questions 🌼</h4>
             <button class="btn btn-outline-dark btn-md btn-block mb-2" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapseExample">
        Di asrama mahasiswi komplek 6 putri ini ngaji apa aja sih?
             </button>
            <div class="collapse mb-4" id="collapse1">
            <div class="card card-body text-center"><strong>  
              Ada ngaji Al_Quran dan Ngaji Kitab
           </strong> </div>
            </div>

            <br>

            <button class="btn btn-outline-dark btn-md btn-block mb-2" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapseExample">
        Boleh membawa laptop dan hp tidak?
             </button>
            <div class="collapse mb-4" id="collapse2">
            <div class="card card-body text-center"><strong>  
              Sangat boleh karena kita Pondok yang dihuni oleh mahasiswi mahasiswi atau anak kuliah.
           </strong> </div>
            </div>

            <br>

            <button class="btn btn-outline-dark btn-md btn-block mb-2" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapseExample">
         Batas pulang ke asrama jam berapa?
             </button>
            <div class="collapse mb-4" id="collapse3">
            <div class="card card-body text-center"><strong>  
              Jam 21:30 gerbang sudah di tutup
           </strong> </div>
            </div>

            <br>

             <button class="btn btn-outline-dark btn-md btn-block mb-2" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapseExample">
        Kegiatan ngaji dimulai jam berapa saja?
             </button>
            <div class="collapse mb-4" id="collapse4">
            <div class="card card-body text-center"><strong>  
              Habis subuh dan habis isya
           </strong> </div>
            </div>

            <br>

             <button class="btn btn-outline-dark btn-md btn-block mb-2" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapseExample">
         Untuk hari libur ngaji hari apa saja?
             </button>
            <div class="collapse mb-4" id="collapse5">
            <div class="card card-body text-center"><strong>  
             Ngaji libur pada malam minggu
           </strong> </div>
            </div>


          </div>
          
        </div>

      </div>
    </section><!-- #about -->

   

   

    <!--==========================
      Portfolio Section
    ============================-->
    <section id="portfolio" class="clearfix">
      <div class="container">

        <header class="section-header">
          <h3 class="section-title">🌸 Galeri 🌸</h3>
        </header>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">Event</li>
              <li data-filter=".filter-card">Event II</li>
              <li data-filter=".filter-web">Event III</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="<?= base_url() ?>assets/frontend/img/portfolio/img4.jpeg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Taarufan Santri Baru</a></h4>
                <div>
                  <a href="<?= base_url() ?>assets/frontend/img/portfolio/img4.jpeg" data-lightbox="portfolio" data-title="Taarufan Santri Baru" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <img src="<?= base_url() ?>assets/frontend/img/portfolio/img2.jpeg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Maulid Nabi</a></h4>
                <div>
                  <a href="<?= base_url() ?>assets/frontend/img/portfolio/img2.jpeg" class="link-preview" data-lightbox="portfolio" data-title="Maulid Nabi" title="Preview"><i class="ion ion-eye"></i></a>
                 
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <img src="<?= base_url() ?>assets/frontend/img/portfolio/gallery7.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Maulid Nabi</a></h4>
                <div>
                  <a href="<?= base_url() ?>assets/frontend/img/portfolio/gallery7.png" class="link-preview" data-lightbox="portfolio" data-title="Maulid Nabi" title="Preview"><i class="ion ion-eye"></i></a>
              
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="<?= base_url() ?>assets/frontend/img/portfolio/img5.jpeg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">17Agustusan</a></h4>
                <div>
                  <a href="<?= base_url() ?>assets/frontend/img/portfolio/img5.jpeg" class="link-preview" data-lightbox="portfolio" data-title="17Agustusan" title="Preview"><i class="ion ion-eye"></i></a>
              
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <img src="<?= base_url() ?>assets/frontend/img/portfolio/img3.jpeg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Maulid Nabi</a></h4>
                <div>
                  <a href="<?= base_url() ?>assets/frontend/img/portfolio/img3.jpeg" class="link-preview" data-lightbox="portfolio" data-title="Maulid Nabi" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          

          

        </div>

      </div>
    </section><!-- #portfolio -->

    <!--==========================
      Clients Section
    ============================-->
    <section id="testimonials" class="section-bg">
      <div class="container">

        <header class="section-header">
          <h3>🕋 Kutipan Bermanfaat 🕋</h3>
        </header>

        <div class="row justify-content-center">
          <div class="col-lg-8">

            <div class="owl-carousel testimonials-carousel wow fadeInUp">
    
              <div class="testimonial-item">
                <img src="<?= base_url() ?>assets/frontend/img/allah.jpg" class="testimonial-img" alt="">
                <h3>HR. Ibnu Majah</h3>
                <h4>🧡</h4>
                <p>
                Dari Nabi SAW. beliau bersabda: Allah Subhaanahu wa Ta'ala berfirman: "Hai anak Adam, jika kamu bersabar dan ikhlas saat tertimpa musibah, maka Aku tidak akan meridhai bagimu sebuah pahala kecuali surga.
                </p>
              </div>
    
              <div class="testimonial-item">
                <img src="<?= base_url() ?>assets/frontend/img/allah.jpg" class="testimonial-img" alt="">
                <h3>HR. Bukhari</h3>
                <h4>❤️</h4>
                <p>
                Tidaklah seorang muslim tertimpa kecelakaan, kemiskinan, kegundahan, kesedihan, kesakitan maupun keduka-citaan bahkan tertusuk duri sekalipun, niscaya Allah akan menghapus dosa-dosanya dengan apa yang menimpanya itu.
                </p>
              </div>
    
              <div class="testimonial-item">
                <img src="<?= base_url() ?>assets/frontend/img/allah.jpg" class="testimonial-img" alt="">
                <h3>HR. Bukhari</h3>
                <h4>💛</h4>
                <p>
                Barangsiapa yang dikehendaki oleh Allah menjadi orang baik maka ditimpakan musibah (ujian) kepadanya.
                </p>
              </div>
    
              <div class="testimonial-item">
                <img src="<?= base_url() ?>assets/frontend/img/allah.jpg" class="testimonial-img" alt="">
                <h3>HR. Tirmidzi</h3>
                <h4>💚</h4>
                <p>
                Tidaklah aku tinggal di dunia melainkan seperti musyafir yang berteduh di bawah pohon dan beristirahat lalu musyafir tersebut pergi meninggalkannya.
                </p>
              </div>
    
        
            </div>

          </div>
        </div>


      </div>
    </section><!-- #testimonials -->

    <!--==========================
      Team Section
    ============================-->
    <section id="team">
      <div class="container">
        <div class="section-header">
          <h3>〰️ PENGURUS 〰️</h3>
          <p><strong>Ini adalah para pengurus yang ada di komplek 6 putri</p></strong>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="<?= base_url() ?>assets/frontend/img/qoam.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Quwwam Hassan</h4>
                  <span>Pemilik Komplek 6 Putri</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href="https://www.instagram.com/quowwam"><i class="fa fa-instagram"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="member">
              <img src="<?= base_url() ?>assets/frontend/img/zak.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Zakky Naufal</h4>
                  <span>Pengurus Komplek 6 Putri</span>
                  <div class="social">
                    <a href="https://twitter.com/zakkyid"><i class="fa fa-twitter"></i></a>
                    <a href="https://web.facebook.com/ZakkyRzk"><i class="fa fa-facebook"></i></a>
                    <a href="https://www.instagram.com/z.k.y"><i class="fa fa-instagram"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
            <div class="member">
              <img src="<?= base_url() ?>assets/frontend/img/reza.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">  
                  <h4>Reza Al Khatami</h4>
                  <span>Pengurus Komplek 6 Putri</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href="https://www.instagram.com/rezaalkh"><i class="fa fa-instagram"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="member">
              <img src="<?= base_url() ?>assets/frontend/img/qois.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Quoiesh Hassan</h4>
                  <span>Pemilik Komplek 6 Putri</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href="https://www.instagram.com/quoiesh/"><i class="fa fa-instagram"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #team -->

    

    

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-info">
            <h3><strong>PPSPA 6 PUTRI</h3></strong>
            <p>Selamat datang di <strong>WEB PPSPA 6 PUTRI</strong> Kami menyediakan fitur-fitur yang unik dan berkesan membuat anda dijamin tidak mudah moveon dari WEB ini, sama halnya seperti dia yang tega meninggalkan kita tanpa alasan, alhasil kita tidak bisa cepat moveon kala itu.</p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Alternatif Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              Yogyakarta <br>
              Jalan Kaliurang, 14,5<br>
              Indonesia <br>
              <strong>Phone:</strong> 081393338707<br>
              <strong>Email:</strong> Naufaljaki25@gmail.com<br>
            </p>

           

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Hubungi Kami</h4>
            <p>Jika ingin menghubungi kami boleh sekali, asalkan jangan terlalu berharap, seperti halnya berharap kepada dia yang akhirnya meninggalkan kita.</p>
            <div class="social-links">
              <a href="https://twitter.com/PPSPA6PUTRI" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="https://web.facebook.com/PPSPA-komplek-6-PUTRI-108853023926094" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="https://www.instagram.com/ppspa_komplek6/" class="instagram"><i class="fa fa-instagram"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>NewBiz</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=NewBiz
        -->
        Design by <a href="https://www.instagram.com/z.k.y"> Mas Zakky Naufal</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  <script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/frontend/lib/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/frontend/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?= base_url() ?>assets/frontend/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/frontend/lib/easing/easing.min.js"></script>
  <script src="<?= base_url() ?>assets/frontend/lib/mobile-nav/mobile-nav.js"></script>
  <script src="<?= base_url() ?>assets/frontend/lib/wow/wow.min.js"></script>
  <script src="<?= base_url() ?>assets/frontend/lib/waypoints/waypoints.min.js"></script>
  <script src="<?= base_url() ?>assets/frontend/lib/counterup/counterup.min.js"></script>
  <script src="<?= base_url() ?>assets/frontend/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?= base_url() ?>assets/frontend/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="<?= base_url() ?>assets/frontend/lib/lightbox/js/lightbox.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="<?= base_url() ?>assets/frontend/contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="<?= base_url() ?>assets/frontend/js/main.js"></script>


</body>
</html>
