<section class="section">
    <div class="section-header">
        <h1><?=(!empty($payments['id'])?"Edit":"Tambah")?> Data Pembayaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pembayaran</a></div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Pembayaran</h4>
                    </div>
                    <div class="card-body">
                    <?php  if ($this->com_user['level'] == 2){?>
                        <form action="" id="form-1" class="form"  onsubmit="return false">
                            <input type="hidden" name="id" value="<?= (!empty($payments['id'])?$payments['id']:"") ?>"/>
                            <?php if (!empty($payments['student_id'])) { ?>
                                <input type="hidden" value="<?= $payments['student_id'] ?>" name="student_id">
                            <?php }?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Santri</label>
                                        <div class="selectric-wrapper selectric-form-control selectric-selectric selectric-below">
                                            <div class="selectric-hide-select">
                                                <select id="mySelect2" class="form-control selectric select2" tabindex="-1" name="student_id" value="<?= (!empty($students)?$students[0]['id']:"") ?>" <?=$readonly?>>
                                                    <?php foreach ($students as $key => $value) { ?>
                                                        <option value="<?=$value['id']?>"><?=$value['name']?></option>        
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label>Tanggal Pembayaran</label>
                                        <input type="text" name="transaction_date" value="<?= (!empty($payments['id'])?$payments['transaction_date']:"") ?>" class="form-control datepicker" <?= (($readonly=="readonly" || (empty($is_paid_off)? false : $is_paid_off ))?"readonly":"") ?>>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Jumlah Dibayarkan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="text" class="form-control uang" id="amount" name="amount" placeholder="Jumlah Dibayarkan" readonly value="<?= (!empty($payments['id'])?$payments['amount']:"") ?>" required <?= (($readonly=="readonly" || (empty($is_paid_off)? false : $is_paid_off ))?"readonly":"") ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group <?=($this->com_user['level'] == 2?"d-none":"")?>">
                                        <label>Status Disetujui</label> <br>
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" id="status" class="custom-switch-input" <?= (!empty($payments['id'])?($payments['is_approved'] == 1)?"checked":"":"") ?> <?=(($readonly=="readonly" || (empty($is_paid_off)? false : $is_paid_off ))?"readonly":"")?>>
                                            <span class="custom-switch-indicator" ></span>
                                        </label>
                                    </div>
                                    <!--<div class="form-group" style="margin-bottom: 0px;">-->
                                    <!--    <label>Bukti Pembayaran</label>-->
                                    <!--    <div id="form-upload-image" class="<?= (($readonly=="readonly" || (empty($is_paid_off)? false : $is_paid_off ))?"d-none":"") ?>" style="margin-bottom: 0px">-->
                                    <!--        <div id="upload" class="btn btn-primary" onclick="click_trigger('#file1')"><i class="fas fa-cloud-upload-alt"></i> Unggah Bukti Pembayaran</div>-->
                                    <!--        <br><br>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div id="curr-image1">
                                        <div class="image-item-upload">
                                            <input type="hidden" class="d-none theHidden" name="saved-gambar" value="<?=(!empty($payments['photo'])?$payments['photo']:"")?>">
                                            <input id="file1" class="d-none theFile" type="file" name="photo" onchange="file_onchange(event, 'image-view-file1', 'close-btn1')"/>
                                            
                                            <img src="<?= (empty($payments['photo'])? "" : $payments['photo'] ) ?>" id="image-view-file1" alt="your image" onclick="zoomImage(this)" class="<?=(!empty($payments['photo'])?"":"d-none")?> h-200 theImage"/>
                                            <img id="close-btn1" class="<?=(!empty($payments['photo']) && ($payments['is_approved'] == 1 && ($this->com_user['level'] > 1)? false : true) && !$is_paid_off? "" : "d-none")?> close remove-parent theCloseButton" src="<?=base_url()?>assets/img/close-window.png" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row text-right" style="margin-top:20px;">
                                <div class="col-md-12">

                                <?php if ($readonly != "readonly") { ?>
                                    <button id="btn-submit" class="btn btn-primary mr-1" type="submit"><?=(empty($payments['id'])?"Tambah Data":"Simpan Data")?></button> 
                                    <?php if (!empty($payments['student_id'])) {?>
                                        <button id="btn-pay" class="btn btn-success mr-1" >Langsung Bayar</button> 
                                    <?php }?>
                                <?php }?>
                                <a href="<?= base_url() ?>payments"><button type="button" class="btn btn-warning mr-1"><?=($readonly=="readonly"?"Kembali":"Batal")?></button></a>
                                </div>
                            </div>
                            
                        </form>
                        <?php } 
                                    else { ?>
                                        <div class="card-body">
                        <form action="tambahdata"  class="form" method="post" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label>Jumlah Dibayarkan Santri</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp.     
                                                </div>
                                            </div>
                                            <input type="text" class="form-control uang" name="amount" placeholder="Jumlah Dibayarkan">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row text-right" style="margin-top:20px;">
                                <div class="col-md-12">
                                <button id="btn-submit" class="btn btn-primary mr-1" type="submit">Tambah Data</button>
                                </div>
                            </div>
                            
                        </form>
                    </div> 
                                 <?php    } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function click_trigger(id){
        $(id).trigger('click');
    }
    
    function file_onchange(event, id, closeId){
        openFile(event, id, closeId);
    }
    
    var openFile = function(event, id, closeId) {
        var fileTypes = ['jpg', 'jpeg', 'png'];
        var input = event.target;

        if (input.files && input.files[0]) {
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types

            if (isSuccess) { //yes
                var reader = new FileReader();
                reader.onload = function(){
                    var dataURL = reader.result;
                    var output = document.getElementById(id);
                    output.src = dataURL;
                };

                reader.readAsDataURL(input.files[0]);
                $('#' + id).removeClass("d-none")
                $('#' + closeId).removeClass("d-none")
                $('#btn-pay').addClass('d-none');
            }
            else { //no
                alert('File gambar tidak benar!');
            }
        }
    };

    $(document).on('click', '.remove-parent', function(index){
        parent = $(this).parent().parent().attr('id');
        theFile = $(this).closest('.image-item-upload').children('.theFile').attr('id');
        theFileName = $(this).closest('.image-item-upload').children('.theFile').attr('name');
        theImage = $(this).closest('.image-item-upload').children('.theImage').attr('id');
        theCloseButton = $(this).closest('.image-item-upload').children('.theCloseButton').attr('id');
        $('#btn-pay').removeClass('d-none');
        $(this).parent().remove();

        $("#" + parent).append('<div class="image-item-upload"><input id="'+ theFile +'" class="d-none theFile" type="file" name="'+ theFileName + '" onchange="file_onchange(event,'+ "'" + theImage + "'" + ',' + "'" + theCloseButton + "'" + ')"/><img id="'+ theImage +'" alt="your image" onclick="zoomImage(this)" class="d-none h-200 theImage"/><img id="'+ theCloseButton +'" class="close d-none remove-parent theCloseButton" src="<?=base_url()?>assets/img/close-window.png"/></div>');
    });

    $(document).ready(function () {

        // for image change
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#image-view').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
        // end for image change

        // save data funtion
        function create_or_update(order_id = null, token = null){
            var form = '#form-1';
            if (!$(form).isValid()) {
                $(form + ' #btn-submit').attr('disabled', false); /* set button enable */
                return;
            }
            $(form + ' #btn-submit').attr('disabled', true);

            var form_data = $(form)[0]; // You need to use standard javascript object here
            var formData = new FormData(form_data);

            if (order_id != null) {
                formData.append("order_id", order_id);
            }
            if (token != null) {
                formData.append("token", token);
            }

            var photo     = document.getElementById('file1');
            formData.append("photo", photo.files[0]);
            
            if ($('#status').is(":checked")) {
                formData.append("status", 1);
            }else {
                formData.append("status", 0);
            }
            
            $.ajax({
                url: "<?php echo base_url('payments/create_or_update') ?>",
                type: "POST",
                contentType: false,
                processData: false,
                data: formData,
                dataType: "JSON",
                success: function (data)
                {
                    if (data.status)
                    {
                        location.replace("<?= base_url() ?>payments")

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
        }
        
        // delete cenceled order
        function delete_canceled_order(order_id = null){
            var form = '#form-1';

            if (!$(form).isValid()) {
                return;
            }

            var form_data = $(form)[0]; // You need to use standard javascript object here
            var formData = new FormData(form_data);

            var photo     = document.getElementById('file1');
            formData.append("photo", photo.files[0]);
            
            if ($('#status').is(":checked")) {
                formData.append("status", 1);
            }else {
                formData.append("status", 0);
            }
            
            $.ajax({
                url: "<?php echo base_url('payments/delete_canceled_order/')?>" + order_id,
                type: "POST",
                contentType: false,
                processData: false,
                data: formData,
                dataType: "JSON",
                success: function (data)
                {
                    console.log('closed the popup without finishing the payment');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Terjadi kesalahan saat menghubungkan ke server.');
                }
            });

        }

        // for change student on select2 widget when edit or view payment at the first load this page
        // $(function(){
        //     $('select[name="student_id"]').trigger('change');
        //     if ($('select[name="student_id"]') != null) {
        //         $('#btn-pay').removeClass('d-none');
        //     }
        // });
        

        // trigger save data on button save data (simpan data)
        $('#form-1 #btn-submit').click(function () {
            create_or_update();
        });

        $('#form-1 #btn-pay').click(function(){

            var form = '#form-1';

            if (!$(form).isValid()) {
                $(form + ' #btn-pay').attr('disabled', false); /* set button enable */
                return;
            }
            $(form + ' #btn-pay').attr('disabled', true);

            var form_data = $(form)[0]; // You need to use standard javascript object here
            var formData = new FormData(form_data);

            var photo     = document.getElementById('file1');
            formData.append("photo", photo.files[0]);
            
            if ($('#status').is(":checked")) {
                formData.append("status", 1);
            }else {
                formData.append("status", 0);
            }
            
            $.ajax({
                url: "<?php echo base_url('payments/generate_midtrans_token') ?>",
                type: "POST",
                contentType: false,
                processData: false,
                data: formData,
                dataType: "JSON",
                success: function (data)
                {
                    snap.pay(data.token, {
                        // Optional
                        onSuccess: function(result){
                            location.replace("<?= base_url() ?>payments");
                        },
                        // Optional
                        onPending: function(result){
                            create_or_update();
                        },
                        onClose: function(){
                            delete_canceled_order(data.order_id);
                        },
                        // Optional
                        onError: function(result){
                            alert('Terjadi kesalahaan, silahkan ulangi.');
                        }
                    });
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Terjadi kesalahan saat menghubungkan ke server.');
                }
            });
            $(form + ' #btn-pay').attr('disabled', false); /* set button enable */  

        });
    });

    $(function(){
        $('.select2').select2({
            minimumInputLength: 0,
            allowClear: true,
            <?=(!empty($payments) || $this->com_user['level'] == 2?"disabled:true,":"")?>
            placeholder: 'Masukan Nama Santri',
            ajax: {
                dataType: 'json',
                url: '<?=base_url()?>students/get_data',
                delay: 800,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function (data, page) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                // slug: item.slug,
                                id: item.id
                            }
                        })
                    };
                },
            }
        }).on('select2:select', function (evt) {
            // var data = $(".select2 option:selected").text();
            // alert("Data yang dipilih adalah "+data);
        });
    });

</script>
