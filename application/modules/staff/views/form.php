<section class="section">
    <div class="section-header">
        <?php
            $title = "Tambah Pengurus Baru";
            if (!empty($staff['id'])) {
                $title = "Edit ". $staff['name'];
                if ($staff['id'] == $this->com_user['staff_id']) {
                    $title = "Profile " . $this->com_user['staff_name'];
                }
            }
        ?>
        <h1><?=$title?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pengurus</a></div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Pengurus</h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="form-1" class="form"  onsubmit="return false">
                            <input type="hidden" name="id" value="<?= (!empty($staff['id'])?$staff['id']:"") ?>"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Username" maxlength="30" value="<?= (!empty($staff['id'])?$staff['username']:"") ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pengurus</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nama Petugas" value="<?= (!empty($staff['id'])?$staff['name']:"") ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Identitas</label>
                                        <input type="text" class="form-control" id="no_identity" name="no_identity" placeholder="Nomor Identitas" value="<?= (!empty($staff['id'])?$staff['no_identity']:"") ?>" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="address" required="" row="30" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"><?= (!empty($staff['id'])?$staff['address']:"") ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor Telepon" maxlength="13" value="<?= (!empty($staff['id'])?$staff['phone']:"") ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= (!empty($staff['id'])?$staff['email']:"") ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="re_password" placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar Profile</label>
                                        <input type='file' class="form-control" id="imgInp" name="photo"/> <br>
                                        <?php
                                            $photo = "#";
                                            if (!empty($staff['photo'])) {
                                                $photo = base_url() . $staff['photo'];
                                            }
                                        ?>
                                        <img id="image-view" onclick='zoomImage(this)' class="img-input-profile" src="<?= $photo ?>" alt="your image" />
                                    </div>
                                </div>
                            </div>
                            <div class="row text-right" style="margin-top:20px;">
                                <div class="col-md-12">
                                    <button class="btn btn-primary mr-1" type="submit"><?=(empty($staff['id'])?"Tambah Data":"Simpan Data")?></button>
                                    <button class="btn btn-warning mr-1" onclick="location.replace('<?= base_url() ?>staff')">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    $(document).ready(function () {

        $('#form-1').submit(function () {
            /* var form */
            var form = '#form-1';
            
            if (!$(form).isValid()) {
                $(form + ' #btn-submit').attr('disabled', false); /* set button enable */
                return;
            }

            $(form + ' #btn-submit').text('Menyimpan...');
            $(form + ' #btn-submit').attr('disabled', true);
            
            var id          = $("input[name='id']").val();
            var username    = $("input[name='username']").val();
            var name        = $("input[name='name']").val();
            var no_identity = $("input[name='no_identity']").val();
            var address     = $("textarea[name='address']").val();
            var phone       = $("input[name='phone']").val();
            var email       = $("input[name='email']").val();
            var password    = $("input[name='password']").val();
            var re_password = $("input[name='re_password']").val();
            var photo       = document.getElementById('imgInp');

            var form_upload = new FormData();
            form_upload.append("username", username);
            form_upload.append("name", name);
            form_upload.append("address", address);
            form_upload.append("no_identity", no_identity);
            form_upload.append("phone", phone);
            form_upload.append("email", email);
            
            if (id != "") {
                form_upload.append("id", id);
            }
            if (password != "") {
                form_upload.append("password", password);
                form_upload.append("re_password", re_password);
            }
            
            form_upload.append("photo", photo.files[0]);
            form_upload.append('<?php echo $this->security->get_csrf_token_name() ?>', '<?php echo $this->security->get_csrf_hash() ?>');

            $.ajax({
                url: "<?php echo base_url('staff/CreateOrUpdate') ?>",
                type: 'POST',
                contentType: false,
                processData: false,
                data: form_upload,
                dataType: "JSON",
                success: function (data)
                {
                    if (data.status) /* if success close modal and reload ajax table */
                    {
                        alert(data.message);
                        location.replace("<?= base_url() ?>staff")

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

        function readURL(input) {
            
            var fileTypes = ['jpg', 'jpeg', 'png'];

            if (input.files && input.files[0]) {
                var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                    isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types

                if (isSuccess) { //yes
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-view').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                    $('#' + id).removeClass("d-none")
                    $('#' + closeId).removeClass("d-none")
                    $('#btn-pay').addClass('d-none');
                }
                else { //no
                    alert('File gambar tidak benar!');
                }
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    });

    setInputFilter(document.getElementById("no_identity"), function(value) {
        return /^[0-9]*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
    setInputFilter(document.getElementById("phone"), function(value) {
        return /^[0-9]*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
</script>