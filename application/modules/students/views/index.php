<section class="section">
    <div class="section-header">
        <h1>Santri</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Santri</div>
        </div>
    </div>

    <div class="section-body">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="<?= base_url() ?>students/detail"><button class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Data</button></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped nowrap" id="table-3" style="width:100%;">
                            <thead>                                 
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nomor Identitas</th>
                                    <th>Username</th>
                                    <th>Telepon</th>
                                    <th>Foto</th>
                                    <th style="padding-right:20px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script>

    $(document).ready(function () {

        dataTableVar = $('#table-3').DataTable({
            'ordering': false,
            'info': true,
            "bFilter": true,
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "<?php echo base_url('students/get_datatable'); ?>",
                "type": "POST"
            },
            "columns": [
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false
                },
                {
                    "orderable": false,
                    "width":"100px"
                },
                {
                    "orderable": false,
                    "width":"90px",
                    'className': 'text-right'
                }
            ]
        });

         /* Button Delete Action */
         $('#table-3').on('click', '.delete', function () {
            /* var modal dan form */
            var id = $(this).attr('data-id');
            bootbox.confirm('Apakah Anda yakin akan menghapus data ini?', function (konfirm) {
                if (konfirm) {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url('students/delete'); ?>',
                        data: 'id=' + id + '&<?php echo $CSRF_CONFIG['name']; ?>=<?php echo $CSRF_CONFIG['hash']; ?>',
                        dataType: 'JSON',
                        timeout: 5000,
                        success: function (data) {
                            if (data.status) {
                                alert('Data berhasil dihapus.');
                                dataTableVar.ajax.reload(null, false);
                            } else {
                                alert('Data gagal dihapus.<br>' + data.message);
                            }
                        },
                        error: function () {
                            dataTableVar.ajax.reload(null, false);
                            alert('Terjadi kesalahan saat menghubungkan ke server.');
                        }
                    });
                }
            });
        });
    });

</script>