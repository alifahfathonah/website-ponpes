<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="icon" href="assets/frontend/img/ppspa.png" type="image/png">
  <title>PPSPA 6 PUTRI</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/regis/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/regis/assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="text-center" style="margin-bottom:10px">
                <img src="<?= base_url() ?>assets/frontend/img/ppspa.png" alt="logo"  width="80" class="shadow-light rounded-circle">
            </div>
            <div class="card <?=($is_success?"card-success":'card-danger')?> text-center">
              <div class="card-header text-center" style="display:block">
                <h4 <?=($is_success?"style='color:green;'":"style='color:red'")?>>Verifikasi Email</h4>                    
              </div>

              <div class="card-body">
                <!-- <form action="" method="POST"> -->
                
                  <div class="form-group">
                    <?php if ($is_success) { ?>
                      <p style='color:green'>Untuk Mengaktifkan Akun Klik Tombol Aktivasi.</p>
                    <?php } else { ?>
                      <p style='color:red'>Sesi anda telah berakhir</p>
                    <?php }?>
                    
                  </div>               
                  <div class="form-group">
                  <form action="<?=base_url('register/aktiv')?>" method="post">
                  <input hidden type="text" name="email" value="<?=$email?>">
                  <input hidden type="text" name="status" value="1">
                  <button type="submit" class="btn btn-success btn-lg btn-block" name="btnReset" tabindex="4" <?=($is_success?"":"style='display:none;'")?>>Aktivasi</button>
                  </form>
                    <!-- <a href="<?=base_url()?>login"> -->
                     
                    <!-- </a> -->
                  </div>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?= base_url() ?>assets/regis/assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?= base_url() ?>assets/regis/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>assets/regis/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>