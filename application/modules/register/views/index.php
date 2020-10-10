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
  <link rel="stylesheet" href="<?= base_url() ?>assets/regis/assets/css/style.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
                <a href="<?= base_url() ?>">
                  <img src="<?= base_url() ?>assets/frontend/img/ppspa.png" alt="logo"  width="80" class="shadow-light rounded-circle">
                </a>
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Registrasi</h4>
                <div class="card-header-action">
                  <input type="button" value="Back" class="btn btn-primary" onclick="window.history.back();">
                </div>                          
              </div>

              <div class="card-body">
                <form action="" id="form-1" class="form"  onsubmit="return false">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" autofocus required="">
                  </div>
                  <div class="form-group">
                    <label for="name">Nama Pengguna</label>
                    <input id="name" type="text" class="form-control" name="name" required="">
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="no_identity">No identitas</label>
                      <input id="no_identity" type="text" class="form-control" name="no_identity" required="" maxlength="16">
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="">Alamat</label>
                      <input id="alamat" type="text" class="form-control" name="address" required="">
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>

                    <div class="row">
                    <div class="form-group col-6">
                      <label for="email">Email</label>
                      <input id="email" type="text" class="form-control" name="email" required="">
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="no_hp">Nomor Telepon</label>
                      <input id="no_hp" type="text" class="form-control" name="phone" required="" maxlength="13">
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Kata Sandi</label>
                      <input id="password" type="password" class="form-control" data-indicator="pwindicator" name="password" required="" >
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="ulang_password" class="d-block">Ulangi Kata Sandi</label>
                      <input id="ulang_password" type="password" name="re_password" class="form-control" data-indicator="pwindicator" required="">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label>
                        <input type="checkbox" onchange="document.getElementById('btn-submit').disabled = !this.checked;"> Saya menyatakan bahwa saya sudah membaca, memahami dan menyetujui 
                        <a data-toggle="modal" data-target="#myModal"><font color=blue><b>privacy</b></a> and 
                        <a data-toggle="modal" data-target="#myModal"><font color=blue><b>policy</b></a>
                      </label>
                    </div>  
                  </div>

                  <a href="<?= base_url() ?>login">Sudah punya akun?</a> 
                  <div class="form-group">
                    <button id="btn-submit" type="submit" class="btn btn-primary btn-lg btn-block" name="btn-submit" disabled>
                      Buat
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <!-- <h4 class="modal-title">PRIVACY AND POLICY</h4> -->
        </div>
        <div class="modal-body">
          <p>- Setiap calon penghuni asrama harus mengetahui sebelumnya bahwa asrama ini adalah asrama plus yang dihuni oleh mereka-mereka beragama islam yang taat dan menganut faham ahli sunnah waljamaah, bagi mereka yang bukan paham itu, TIDAK DI IZINKAN BERTEMPAT TINGGAL DI ASRAMA INI, ini semua demi kenyamanan bersama. </p>
          <p>- Setiap penghuni asrama diwajibkan berpakaian  sederhana, sopan, tidak transparan dan pantas dipandang. </p>
          <p>- Setiap penghuni asrama diwajibkan selalu ada di asrama, apabila meninggalkan asrama lebih dari 1 hari harus meminta izin dulu kepada pengurus yang selanjutnya pengurus akan melaporkan kepada pengasuh. </p>
          <p>- Setiap penghuni asrama wajib bersikap sopan santun, saling menghormati kepada teman, pengurus serta pengasuh dan keluarganya. </p>
          <p>- Setiap penghuni asrama diwajibkan mengikuti semua kegiatan-kegiatan yang ada diasrama mahasiswi komplek 6 putri seperti: Shalat berjamaah, wiridan, mengaji, muhadorroh, mujahadah kamis wage, tahlil, ziaroh, dibaan.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">TUTUP</button>
        </div>
      </div>
      
    </div>
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

  <script>
    $('#form-1').submit(function () {
        /* var form */
        var form = '#form-1';
        // if (!$(form).isValid()) {
        //     $(form + ' #btn-submit').attr('disabled', false); /* set button enable */
        //     return;
        // }
        $(form + ' #btn-submit').attr('disabled', true);

        $.ajax({
            url: "<?php echo base_url('register/create') ?>",
            type: "POST",
            data: $(this).serialize(),
            timeout: 5000,
            dataType: "JSON",
            success: function (data)
            {
                if (data.status) /* if success close modal and reload ajax table */
                {
                    alert(data.message);
                    // $(form)[0].reset();
                    location.replace("<?= base_url() ?>login")
                } else {
                    alert(data.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Terjadi kesalahan saat menghubungkan ke server.');
            }
        });
        $(form + ' #btn-submit').attr('disabled', false); /* set button enable */
    });

  setInputFilter(document.getElementById("no_hp"), function(value) {
    return /^[0-9]*$/.test(value); // Allow digits and '.' only, using a RegExp
  });
  setInputFilter(document.getElementById("no_identity"), function(value) {
    return /^[0-9]*$/.test(value); // Allow digits and '.' only, using a RegExp
  });
  // Restricts input for the given textbox to the given inputFilter function.
  function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
      textbox.addEventListener(event, function() {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    });
  }
  </script>
</body>
</html>
