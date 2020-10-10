<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="assets/frontend/img/ppspa.png" rel="icon">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>PPSPA 6 PUTRI</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/modules/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/components.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
  <?php echo isset($FILE_CSS) ? $FILE_CSS : ''; ?>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
  <script src="<?= base_url() ?>assets/modules/popper.js"></script>
  <script src="<?= base_url() ?>assets/modules/tooltip.js"></script>
  <script src="<?= base_url() ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url() ?>assets/modules/moment.min.js"></script>
  <script src="<?= base_url() ?>assets/js/stisla.js"></script>
  <script src="<?= base_url('assets/modules/bootbox/bootbox.min.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

  <!-- JS Libraies -->
  <script src="<?= base_url() ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?= base_url() ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?= base_url() ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?= base_url() ?>assets/modules/fullcalendar/fullcalendar.min.js"></script>
  <script src="<?= base_url() ?>assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="<?= base_url() ?>assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

  <!-- Template JS File -->
  <script src="<?= base_url() ?>assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>assets/js/custom.js"></script>
  <script>
  function zoomImage(e) {
    $('#overlay')
      .css({backgroundImage: `url(${e.src})`})
      .addClass('open')
      .one('click', function() { $(this).removeClass('open'); });
  }
  </script>

  <!-- midtrans -->
  <?php
    if (!empty($midtrans_client_key)) {
      echo '<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="'. $midtrans_client_key .'"></script>';
    }
  ?>

</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
              <div class="search-header">
                Result
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="<?= base_url() ?>assets/img/products/product-3-50.png" alt="product">
                  Dashboard
                </a>
              </div>
            </div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
            
          <?php 
              $profile = base_url(). ($this->com_user['level'] == 2?"students/detail/".$this->com_user['student_id']:"staff/detail/" . $this->com_user['staff_id']);
              $photo = base_url(). ($this->com_user['level'] == 2?$this->com_user['student_photo']:$this->com_user['staff_photo']);
            ?>

          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">     
            <img alt="image" src="<?= $photo ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?=$this->com_user['username']?> </div></a>
            <div class="dropdown-menu dropdown-menu-right">
              
              <a href="<?=$profile?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url() ?>login/do_logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?=base_url()?>">PPSPA 6 PUTRI</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?=base_url()?>"><img src="<?=base_url()?>assets/frontend/img/ppspa.png" style="width:57%;" alt=""></a>
          </div>
          <div class="clock-element text-center">
            <div id="clock2"></div>
            <div id="clock"></div>
          </div>
          
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li><a class="nav-link" href="<?= base_url()?>dashboard"><i class="fas fa-home"></i> <span>Halaman Utama</span></a></li>

            <li><a class="nav-link" href="<?=$profile?>"><i class="fas fa-user-circle"></i> <span>Profile</span></a></li>

            <?php if ($this->com_user['level'] < 2) { ?>
              <li><a class="nav-link" href="<?= base_url()?>students"><i class="fas fa-female"></i> <span>Santri</span></a></li>
            <?php  } ?>

            <?php if ($this->com_user['level'] != 2) { ?>
              <li><a class="nav-link" href="<?= base_url()?>staff"><i class="fas fa-user-tie"></i> <span>Pengurus</span></a></li>
            <?php  } ?>
            
            <li><a class="nav-link" href="<?= base_url()?>payments"><i class="fas fa-wallet"></i> <span>Pembayaran</span></a></li>

            <?php if ($this->com_user['level'] < 2) { ?>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-person-booth"></i><span>Kamar</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?= base_url() ?>rooms">Data Kamar</a></li>
                  <li><a class="nav-link" href="<?= base_url() ?>room_type">Tipe Kamar</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i><span>Settings</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?= base_url() ?>midtrans_configuration">Midtrans Setting</a></li>
                </ul>
              </li>
            <?php  } ?>

            
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <div id="overlay"></div>
        <?php isset($TPL_ISI) ? $this->load->view($TPL_ISI) : 'Index belum di-load'; ?>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 <div class="bullet"></div> Design By <a href="https://instagram.com/z.k.y">Zakky Naufal</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>
  
  <!-- Page Specific JS File -->
  <script src="<?= base_url() ?>assets/js/page/modules-datatables.js"></script>
  <script src="<?= base_url() ?>assets/js/page/modules-calendar.js"></script>
  <?php echo isset($FILE_JS) ? $FILE_JS : ''; ?>

  <script>
    var csfrData = {};
      csfrData['<?=$this->security->get_csrf_token_name(); ?>'] = '<?=$this->security->get_csrf_hash(); ?>';
      $.ajaxSetup({
        data: csfrData
    });

    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var thisDay = date.getDay(),
    thisDay = myDays[thisDay];
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    document.getElementById('clock2').innerHTML=thisDay + ', ' + day + ' ' + months[month] + ' ' + year;

    function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour < 12) {
          a_p = "AM";
        } else {
          a_p = "PM";
        }
        if (curr_hour == 0) {
          curr_hour = 12;
        }
        if (curr_hour > 12) {
          curr_hour = curr_hour - 12;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
        document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
      }

      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
      setInterval(showTime, 500);
  </script> 
</body>
</html>
