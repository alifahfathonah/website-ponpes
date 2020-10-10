<?php if ($this->com_user['level'] != 2){?>
<section class="section">
    <div class="section-header">
    <h1>Halaman utama</h1>
    </div>
    <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Data Pengurus</h4>
            </div>
            <div class="card-body">
            <?= $data_pengurus ?>
            </div>

            <a href="<?=base_url()?>staff" class="small-box-footer <?=$this->com_user['level'] == 2?"d-none":""?>">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
            <i class="far fa-newspaper"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Data Santri</h4>
            </div>
            <div class="card-body">
            <?= $data_santri ?>
            </div>
            <a href="<?=base_url()?>students" class="small-box-footer <?=$this->com_user['level'] == 2?"d-none":""?>">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Data Kamar</h4>
            </div>
            <div class="card-body">
            <?= $data_kamar ?>
            </div>
            <a href="<?=base_url()?>rooms" class="small-box-footer <?=$this->com_user['level'] == 2?"d-none":""?>">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-success">
            <i class="fas fa-circle"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Data Pembayaran</h4>
            </div>
            <div class="card-body">
            <?= $data_pembayaran ?>
            </div>
            <a href="<?=base_url()?>payments" class="small-box-footer <?=$this->com_user['level'] == 2?"d-none":""?>">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-header">
            <h4>Calendar</h4>
        </div>
        <div class="card-body">
            <div class="fc-overflow">
            <div id="myEvent"></div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
         <?php } ?>

         <?php if ($this->com_user['level'] == 2){?>
<section class="section">
    <div class="section-header">
    <h1>Halaman utama</h1>
    </div>
    <!-- <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Data Pengurus</h4>
            </div>
            <div class="card-body">
            <?= $data_pengurus ?>
            </div>

            <a href="<?=base_url()?>staff" class="small-box-footer <?=$this->com_user['level'] == 2?"d-none":""?>">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
            <i class="far fa-newspaper"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Data Santri</h4>
            </div>
            <div class="card-body">
            <?= $data_santri ?>
            </div>
            <a href="<?=base_url()?>students" class="small-box-footer <?=$this->com_user['level'] == 2?"d-none":""?>">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Data Kamar</h4>
            </div>
            <div class="card-body">
            <?= $data_kamar ?>
            </div>
            <a href="<?=base_url()?>rooms" class="small-box-footer <?=$this->com_user['level'] == 2?"d-none":""?>">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-success">
            <i class="fas fa-circle"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Data Pembayaran</h4>
            </div>
            <div class="card-body">
            <?= $data_pembayaran ?>
            </div>
            <a href="<?=base_url()?>payments" class="small-box-footer <?=$this->com_user['level'] == 2?"d-none":""?>">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>
    </div> -->
    <div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-header">
            <h4>Calendar</h4>
        </div>
        <div class="card-body">
            <div class="fc-overflow">
            <div id="myEvent"></div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
         <?php } ?>