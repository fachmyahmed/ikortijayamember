<div class="container-fluid">
    <div class="row ">
        <nav class="col-md-3 col-lg-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky container">
                <div class="row ">
                    <div class="col-12">
                        <div class=" image d-flex flex-column justify-content-center align-items-left">
                            <?php
                            if (!empty($datamember->foto)) {
                                $foto = base_url() . 'uploads/foto/'.$datamember->foto;
                            } else {
                                $foto = base_url() . 'uploads/foto/default.png';
                            }
                            ?>
                            <div class="image d-flex flex-column justify-content-center align-items-center">
                                <img class="w-75 p-2 rounded-circle border border-white" src="<?php echo $foto; ?>" alt="">
                            </div>
                            <span class="name mt-3 font-weight-bold">Welcome, <br>
                                <span><i class="fa fa-user"></i></span>
                                <?php echo $userdata['fullname_title']; ?>
                            </span>
                            <span class="idd">No. #<?php echo $userdata['id'] ?></span>
                            <span class="idd">No induk #</span>
                            <span class="idd">Member Card</span>
                            <!-- <div class=" d-flex mt-2">
                                <button class="btn1 btn-dark">Edit Profile</button>
                            </div>
                            <div class="text mt-3">
                                <span>Eleanor Pena is a creator of minimalistic x bold graphics and digital artwork.<br><br> Artist/ Creative Director by Day #NFT minting@ with FND night. </span>
                            </div>
                            <div class=" px-2 rounded mt-4 date "> <span class="join">Joined May,2021</span> </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main role="main" class="col-md-9 col-lg-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Profile</h1>
            </div>
            <div class="">
                <h3 class="text-success"><?php echo $this->session->flashdata('message'); ?></h3>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="accordion">
                            <form method="POST" action="<?php echo base_url().'member/update_profile'?>" enctype="multipart/form-data">
                                <div class="card rounded-0">
                                    <div class="card-header bg-main" id="headingOne">
                                        <h5 class="mb-0">
                                            <a class="collapsed font-weight-bold text-light" data-toggle="collapse" role="button" data-target="#dataPribadi" aria-expanded="false" aria-controls="dataPribadi">
                                                Data Pribadi
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="dataPribadi" class="collapse show multi-collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            <div class="contact-form">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <span class="icon">Nama lengkap</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="fullname" value="<?php echo $datamember->fullname;?>">
                                                            <span class="icon"><i class="fal fa-user"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Nama lengkap dengan gelar</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="fullname_title" value="<?php echo $datamember->fullname_title;?>">
                                                            <span class="icon"><i class="fal fa-user"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <span class="icon">Jenis Kelamin</span>
                                                        <?php 

                                                            if($datamember->gender=='male'){
                                                                $male="selected";
                                                                $female="";
                                                            } else{
                                                                $male="";
                                                                $female="selected";
                                                            }
                                                        ?>
                                                        <div class="form-group">
                                                            <select name="gender" style="display: none;">
                                                                <option value="" disabled selected hidden>Pilih</option>
                                                                <option value="male" <?php echo $male ?>>Pria</option>
                                                                <option value="female" <?php echo $female ?>>Wanita</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="icon">Tempat Lahir</span>
                                                        <div class="form-group">
                                                            <input name="place_birth" type="text" placeholder="...." value="<?php echo $datamember->place_birth;?>">
                                                            <span class="icon"><i class="fal fa-location"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="icon">Tanggal Lahir</span>
                                                        <div class="form-group">
                                                            <input name="date_birth" type="text" class="has-icon datepicker-here " data-language="en" placeholder="Select Date" id="" value="<?php echo date_format(date_create($datamember->date_birth),"d/m/Y")?>">
                                                            <span class="icon"><i class="fal fa-calendar-alt"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-0">
                                    <div class="card-header bg-main" id="headingTwo">
                                        <h5 class="mb-0">
                                            <a class="collapsed font-weight-bold text-light" data-toggle="collapse" data-target="#dataKontak" role="button" aria-expanded="false" aria-controls="dataKontak">
                                                Data Kontak
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="dataKontak" class="collapse multi-collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            <div class="contact-form">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <span class="icon">Email</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="email" value="<?php echo $datamember->email;?>">
                                                            <span class="icon"><i class="fal fa-envelope"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Nomor Telepon 1</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_phone"  value="<?php echo $datamember->cb_phone;?>">
                                                            <span class="icon"><i class="fal fa-phone"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Nomor Telepon 2</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_phone2"  value="<?php echo $datamember->cb_phone2;?>">
                                                            <span class="icon"><i class="fal fa-phone"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <span class="icon">Alamat Rumah</span>
                                                        <div class="form-group">
                                                            <textarea name="correspondence_address" id="correspondence_address" placeholder="Write here"><?php echo $datamember->correspondence_address;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-0">
                                    <div class="card-header bg-main" id="headingTwo">
                                        <h5 class="mb-0">
                                            <a class="collapsed font-weight-bold text-light" data-toggle="collapse" data-target="#dataAdministrasi" role="button" aria-expanded="false" aria-controls="dataAdministrasi">
                                                Data Administrasi
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="dataAdministrasi" class="collapse multi-collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            <div class="contact-form">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <span class="icon">NPA</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="npa" value="<?php echo $datamember->npa;?>">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Cabang PDGI</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_pdgi" value="<?php echo $datamember->cb_pdgi;?>">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="fullname" id="fullname-label">Sertifikat Kompetensi (Serkom)</label><br>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Nomor</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="no_serkom" value="<?php echo $datamember->no_serkom;?>">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Berlaku sampai</span>
                                                        <div class="form-group">
                                                            <input name="serkom_exp" type="text" class="has-icon datepicker-here " data-language="en" placeholder="Select Date" id="" value="<?php echo date_format(date_create($datamember->serkom_exp),"d/m/Y")?>">
                                                            <span class="icon"><i class="fal fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="fullname" id="fullname-label">Surat Tanda Registrasi (STR)</label><br>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Nomor</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="no_str" value="<?php echo $datamember->no_str;?>">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Berlaku sampai</span>
                                                        <div class="form-group">
                                                            <input name="str_exp" type="text" class="has-icon datepicker-here " data-language="en" placeholder="Select Date" id="" value="<?php echo date_format(date_create($datamember->str_exp),"d/m/Y")?>">
                                                            <span class="icon"><i class="fal fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-0">
                                    <div class="card-header bg-main" id="headingTwo">
                                        <h5 class="mb-0">
                                            <a class="collapsed font-weight-bold text-light" data-toggle="collapse" data-target="#dataPendidikan" role="button" aria-expanded="false" aria-controls="dataPendidikan">
                                                Data Pendidikan
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="dataPendidikan" class="collapse multi-collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            <div class="contact-form">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <span class="icon">Pendidikan Dokter Gigi</span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Asal Universitas</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_pendidikan_s1"  value="<?php echo $datamember->cb_pendidikan_s1;?>">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="icon">Tahun Masuk</span>
                                                        <div class="form-group">
                                                            <input type="number" placeholder="...." name="university_year" value="<?php echo $datamember->university_year;?>">
                                                            <span class="icon"><i class="fal fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="icon">Tahun Lulus</span>
                                                        <div class="form-group">
                                                            <input type="number" placeholder="...." name="university_year_grad" value="<?php echo $datamember->university_year_grad;?>" >
                                                            <span class="icon"><i class="fal fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <span class="icon">Pendidikan Spesialis Ortodonti</span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Asal Universitas</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_pendidikan_sp" value="<?php echo $datamember->cb_pendidikan_sp;?>">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="icon">Tahun Masuk</span>
                                                        <div class="form-group">
                                                            <input type="number" placeholder="...." name="spc_year"  value="<?php echo $datamember->spc_year;?>">
                                                            <span class="icon"><i class="fal fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="icon">Tahun Lulus</span>
                                                        <div class="form-group">
                                                            <input type="number" placeholder="...." name="spc_year_grad"  value="<?php echo $datamember->spc_year_grad;?>">
                                                            <span class="icon"><i class="fal fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-0">
                                    <div class="card-header bg-main" id="headingTwo">
                                        <h5 class="mb-0">
                                            <a class="collapsed font-weight-bold text-light" data-toggle="collapse" data-target="#dataTempatKerja" role="button" aria-expanded="false" aria-controls="dataTempatKerja">
                                                Data Tempat Kerja
                                            </a><br>

                                        </h5>
                                    </div>
                                    <div id="dataTempatKerja" class="collapse multi-collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            <div class="contact-form">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <i>*Mohon diisi, agar dapat dimasukkan ke Direktori Pencarian Ortodontis dan Peta Praktek, untuk pencarian Otomatis oleh Masyarakat ataupun Anggota</i>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <span class="icon font-weight-bold">Tempat Kerja Ke-1</span>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="icon">Nama</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_praktek_name" value="<?php echo $datamember->cb_praktek_name;?>">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <span class="icon">Alamat</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_praktek" value="<?php echo $datamember->cb_praktek;?>">
                                                            <span class="icon"><i class="fal fa-map-marker"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <span class="icon font-weight-bold">Tempat Kerja Ke-2</span>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="icon">Nama</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_praktek2_name" value="<?php echo $datamember->cb_praktek2_name;?>">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <span class="icon">Alamat</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_praktek2" value="<?php echo $datamember->cb_praktek2;?>">
                                                            <span class="icon"><i class="fal fa-map-marker"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <span class="icon font-weight-bold">Tempat Kerja Ke-3</span>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="icon">Nama</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_praktek3_name" value="<?php echo $datamember->cb_praktek3_name;?>">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <span class="icon">Alamat</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_praktek3" value="<?php echo $datamember->cb_praktek3;?>">
                                                            <span class="icon"><i class="fal fa-map-marker"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-0">
                                    <div class="card-header bg-main" id="headingTwo">
                                        <h5 class="mb-0">
                                            <a class="collapsed font-weight-bold text-light" data-toggle="collapse" data-target="#filePendukung" role="button" aria-expanded="false" aria-controls="filePendukung">
                                                File Pendukung
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="filePendukung" class="collapse multi-collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            <div class="contact-form">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <span class="icon font-weight-bold">
                                                            Pas Foto
                                                        </span>
                                                        <span class="icon">
                                                            <?php
                                                            $foto = 'uploads/foto/'.$datamember->foto;
                                                            if(!empty($datamember->foto)){
                                                                $foto = base_url().'uploads/foto/'.$datamember->foto;
                                                            } else {
                                                                $foto = base_url().'uploads/foto/default.png';
                                                            }
                                                            ?>
                                                            <img class="w-100 p-2 rounded-0 border border-white" src="<?php echo $foto; ?>" alt="">
                                                        </span>
                                                        <div class="form-group">
                                                            <input type="file" placeholder="...." class="w-100" name="foto">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="icon font-weight-bold">
                                                            Sertifikat Kompetensi
                                                        </span>
                                                        <span class="icon">
                                                            <?php
                                                            if(!empty($datamember->serkom_file)) {
                                                                $serkom_file = base_url() . 'uploads/serkom/'.$datamember->serkom_file;
                                                               ?>
                                                               <br>
                                                               <a class="w-100" href="<?php echo $serkom_file; ?>" alt="">Download File</a>
                                                               <?php 
                                                            } 
                                                            ?>
                                                            
                                                        </span>
                                                        <div class="form-group">
                                                            <input type="file" placeholder="...." class="w-100" name="serkom_file">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="icon font-weight-bold">
                                                            Surat Tanda Registrasi
                                                        </span>
                                                        <span class="icon">
                                                        <?php
                                                            if(!empty($datamember->str_file)) {
                                                                $str_file = base_url() . 'uploads/serkom/'.$datamember->str_file;
                                                               ?>
                                                               <br>
                                                               <a class="w-100" href="<?php echo $str_file; ?>" alt="">Download File</a>
                                                               <?php 
                                                            } 
                                                            ?>
                                                        </span>
                                                        <div class="form-group">
                                                            <input type="file" placeholder="...." class="w-100" name="str_file">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="icon font-weight-bold">
                                                            Ijazah Pendidikan Dokter Gigi
                                                        </span>
                                                        <span class="icon">
                                                            <?php
                                                            if (file_exists('uploads/ijazah/'.$datamember->file_univ_ijazah)) {
                                                                $file_univ_ijazah = base_url() . 'uploads/ijazah/' . $datamember->file_univ_ijazah;
                                                            } else {
                                                                $file_univ_ijazah = '';
                                                            }
                                                            ?>
                                                            <br>
                                                            <a class="w-100" href="<?php echo $file_univ_ijazah; ?>" alt="">Download File</a>
                                                        </span>
                                                        <div class="form-group">
                                                            <input type="file" placeholder="...." class="w-100" name="file_univ_ijazah">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="icon font-weight-bold">
                                                            Ijazah Pendidikan Spesialis Ortodonti
                                                        </span>
                                                        <span class="icon">
                                                            <?php
                                                            if (file_exists('uploads/spc_ijazah/' . $datamember->file_spc_ijazah)) {
                                                                $file_spc_ijazah = base_url() . 'uploads/spc_ijazah/' . $datamember->file_spc_ijazah;
                                                            } else {
                                                                $file_spc_ijazah = '';
                                                            }
                                                            ?>
                                                            <br>
                                                            <a class="w-100" href="<?php echo $file_univ_ijazah; ?>" alt="">Download File</a>
                                                        </span>
                                                        <div class="form-group">
                                                            <input type="file" placeholder="...." class="w-100" name="file_spc_ijazah">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-0">
                                    <div class="card-header bg-main" id="headingTwo">
                                        <h5 class="mb-0">
                                            <a class="collapsed font-weight-bold text-light" data-toggle="collapse" data-target="#kegiatan" role="button" aria-expanded="false" aria-controls="kegiatan">
                                                Kegiatan
                                            </a><br>

                                        </h5>
                                    </div>
                                    <div id="kegiatan" class="collapse multi-collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            <div class="contact-form">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Nama Kegiatan</th>
                                                            <th scope="col">Tipe Kegiatan</th>
                                                            <th scope="col">Nomor Barcode Sertifikat</th>
                                                            <th scope="col">Sertifikat Kegiatan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>JOM 2022</td>
                                                            <td>Seminar</td>
                                                            <td>562789153499</td>
                                                            <td><a href="#">Download Certificate</a></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>JOM 2022</td>
                                                            <td>Seminar</td>
                                                            <td>562789153499</td>
                                                            <td><a href="#">Download Certificate</a></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">3</th>
                                                            <td>JOM 2022</td>
                                                            <td>Seminar</td>
                                                            <td>562789153499</td>
                                                            <td><a href="#">Download Certificate</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-left py-4 my-4">
                                    <input type="hidden" name="id" value="<?php echo $datamember->id ?>">
                                    <input class="btn btn-danger rounded-0 " type="submit" value="Save">
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>