<section class="section">
    <div class="section-header">
        <?php
            $title = "Tambah Santri Baru";
            if (!empty($students['id'])) {
                $title = "Edit ". $students['name'];
                if ($students['id'] == $this->com_user['student_id']) {
                    $title = "Profile " . $this->com_user['student_name'];
                }
            }
        ?>
        <h1><?=$title?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Santri</a></div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Santri</h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="form-1" class="form"  onsubmit="return false">
                            <input type="hidden" name="id" value="<?= (!empty($students['id'])?$students['id']:"") ?>"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Identitas</label>
                                        <input type="text" class="form-control" id="no_identity" name="no_identity" placeholder="Nomor Identitas" value="<?= (!empty($students['id'])?$students['no_identity']:"") ?>" <?=$readonly?> required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Santri</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap Santri" value="<?= (!empty($students['id'])?$students['name']:"") ?>" <?=$readonly?> required>
                                    </div>
                                    <div class="form-group">
                                        <label>Username Santri</label>
                                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?= (!empty($students['id'])?$students['username']:"") ?>" required>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= (!empty($students['id'])?$students['email']:"") ?>" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="address" placeholder="Alamat" required="" row="30" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"><?= (!empty($students['id'])?$students['address']:"") ?></textarea> <br>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="Nomor Telepon" value="<?= (!empty($students['id'])?$students['phone']:"") ?>" required>
                                    </div>
                                  <?php 
                                
                                   if ($this->com_user['level'] != 2){?>
                                    
                                    <div class="form-group">
                                        <label>Tipe Kamar</label>
                                        <select class="form-control select2" name="room_type" onchange="onChangeRoomType()" value="<?= (!empty($students['id'])?$students['room_type']:"") ?>" <?=$readonly?>>
                                            <option value="0">-- Pilih Tipe Kamar --</option>
                                            <?php foreach ($room_types as $key => $value) { ?>

                                                <?php if (!empty($students['id']) && $value['id'] == $students['room_type']) { ?>
                                                    <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                <?php } ?>
                                                
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Kamar</label>
                                        <select class="form-control select2" name="room" value="<?= (!empty($students['id'])?$students['room_id']:"") ?>">
                                            <option value="0">-- Pilih Nomor Kamar --</option>
                                        </select>
                                    </div>
                                    <?php }   ?>

                                    <?php
                                    $kamar= $students['room'] ;

                                    if ($this->com_user['level'] == 2){
                                    if ($kamar!=0){?>
                                        <div class="form-group">
                                        <label>Tipe Kamar</label>
                                        <select class="form-control select2" name="room_type" onchange="onChangeRoomType()" value="<?= (!empty($students['id'])?$students['room_type']:"") ?>" <?=$readonly?>>
                                            <option value="0">-- Pilih Tipe Kamar --</option>
                                            <?php foreach ($room_types as $key => $value) { ?>

                                                <?php if (!empty($students['id']) && $value['id'] == $students['room_type']) { ?>
                                                    <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                <?php } ?>
                                                
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Kamar</label>
                                        <select class="form-control select2" name="room" value="<?= (!empty($students['id'])?$students['room_id']:"") ?>">
                                            <option value="0">-- Pilih Nomor Kamar --</option>
                                        </select>
                                    </div>
                                   <?php }}   ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="re_password" placeholder="Confirm Password">
                                    </div>
                                    <?php if ($this->com_user['level'] != 2) {?>
                                        <div class="form-group">
                                            <label>Email Terverifikasi</label><label style="margin-left:50px;">Status Akun Aktif</label> <br>
                                            <label class="custom-switch mt-2">
                                                <input type="checkbox" id="is_email_verified" class="custom-switch-input" <?= (!empty($students['id'])?($students['is_email_verified'] == 1)?"checked":"":"") ?>>
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                            <label class="custom-switch mt-2" style="margin-left:119px;">
                                                <input type="checkbox" id="status" class="custom-switch-input" <?= (!empty($students['id'])?($students['status'] == 1)?"checked":"":"") ?>>
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </div>
                                    <?php }?>
                                    
                                    <div class="form-group">
                                        <label>Gambar Profile</label>
                                        <input type='file' class="form-control" id="imgInp" name="photo"/> <br>
                                        <?php
                                            $photo = "#";
                                            if (!empty($students['photo'])) {
                                                $photo = base_url() . $students['photo'];
                                            }
                                        ?>
                                        <img id="image-view" onclick='zoomImage(this)' class="img-input-profile" src="<?= $photo ?>" alt="your image" />
                                    </div>
                                </div>
                            </div>
                            <div class="row text-right" style="margin-top:20px;">
                                <div class="col-md-12">
                                    <button class="btn btn-primary mr-1" type="submit"><?=(empty($students['id'])?"Tambah Data":"Simpan Data")?></button>
                                    <div class="btn btn-warning mr-1" onclick="location.replace('<?= base_url() ?>students')">Batal</div>
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
        <?php if (!empty($students)) { ?>
            $('select[name="room_type"]').trigger('change');
        <?php }?>
        
        $('#form-1').submit(function () {
            /* var form */
            var form = '#form-1';
            if (!$(form).isValid()) {
                $(form + ' #btn-submit').attr('disabled', false); /* set button enable */
                return;
            }
            $(form + ' #btn-submit').text('Menyimpan...');
            $(form + ' #btn-submit').attr('disabled', true);

            var form_data = $(form)[0]; // You need to use standard javascript object here
            var formData = new FormData(form_data);

            var photo       = document.getElementById('imgInp');
            formData.append("photo", photo.files[0]);
            
            <?php if ($this->com_user['level'] != 2) {?>
                if ($('#status').is(":checked")) {
                    formData.append("status", 1);
                }else {
                    formData.append("status", 0);
                }
            <?php }?>
            
            if ($('#is_email_verified').is(":checked")) {
                formData.append("is_email_verified", 1);
            }else {
                formData.append("is_email_verified", 0);
            }
            
            $.ajax({
                url: "<?php echo base_url('students/CreateOrUpdate') ?>",
                type: "POST",
                contentType: false,
                processData: false,
                data: formData,
                dataType: "JSON",
                success: function (data)
                {
                    if (data.status) /* if success close modal and reload ajax table */
                    {
                        alert(data.message);
                        <?php if ($this->com_user['level'] != 2) { ?>
                            location.replace("<?= base_url() ?>students")
                        <?php }?>
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

    var room_id = <?=(!empty($students['room_id'])?$students['room_id']:"0")?>;
    function onChangeRoomType (){
        var form = new FormData();
        form.append("room_type_id", $('select[name="room_type"]').val());
        form.append("room_id", <?=(!empty($students['room_id'])?$students['room_id']:0)?>);
        <?php if (!empty($students)) { ?>
            
        <?php }?>
        $.ajax({
            url: "<?php echo base_url('rooms/get_room_available/')?>",
            type: "POST",
            contentType: false,
            processData: false,
            data: form,
            dataType: "JSON",
            success: function (data)
            {
                options = '<option value="0">-- Pilih Nomor Kamar --</option>';
                for (index = 0; index < data.length; index++) {
                    if (data[index]['id'] == room_id) {
                        options += "<option value='"+ data[index]['id'] +"' selected> "+ data[index]['room_number'] +"</options>";
                    }else {
                        options += "<option value='"+ data[index]['id'] +"'> "+ data[index]['room_number'] +"</options>";
                    }
                    
                }
                $('select[name="room"]').html(options);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Terjadi kesalahan saat menghubungkan ke server.');
            }
        });
    }

    $(function(){
        $('.select2').select2({
            minimumInputLength: 0,
            allowClear: true,
            <?=($readonly=="readonly" || $this->com_user['level'] == 2?"disabled:true,":"")?>
        }).on('select2:select', function (evt) {
            // var data = $(".select2 option:selected").text();
            // alert("Data yang dipilih adalah "+data);
        });
    });

    
</script>