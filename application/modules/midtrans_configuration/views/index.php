<section class="section">
    <div class="section-header">
        <h1>Midtrans Payment Settings</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Settings</a></div>
            <div class="breadcrumb-item active">Midtrans Payment Settings</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form id="form-1" action="" class="form"  onsubmit="return false">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Client Key</label>
                                        <input type="text" class="form-control" name="client_key" placeholder="Masukan Client Key" value="<?= (!empty($midtrans_configuration['ClientKey'])?$midtrans_configuration['ClientKey']:"") ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Server Key</label>
                                        <input type="text" class="form-control" name="server_key" placeholder="Masukan Server Key" value="<?= (!empty($midtrans_configuration['ServerKey'])?$midtrans_configuration['ServerKey']:"") ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-right" style="margin-top:20px;">
                                <div class="col-md-12">
                                    <button id="btn-submit" class="btn btn-primary mr-1" type="submit">Simpan</button>
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
    $('#form-1').submit(function () {
        /* var form */
        var form = '#form-1';
        if (!$(form).isValid()) {
            $(form + ' #btn-submit').attr('disabled', false); /* set button enable */
            return;
        }
        $(form + ' #btn-submit').attr('disabled', true);

        $.ajax({
            url: "<?php echo base_url('midtrans_configuration/update') ?>",
            type: "POST",
            data: $(this).serialize(),
            timeout: 5000,
            dataType: "JSON",
            success: function (data)
            {
                if (data.status)
                {
                    alert(data.message);
                    location.replace("<?= base_url() ?>dashboard")
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
</script>