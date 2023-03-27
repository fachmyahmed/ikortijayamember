<div class="container-fluid">
    <div class="row ">
        <nav class="col-md-3 col-lg-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky container">
                <div class="row ">
                    <div class="col-12">
                        <div class=" image d-flex flex-column justify-content-center align-items-left">
                            <?php
                            if (file_exists(base_url() . 'uploads/foto/' . $userdata['foto'])) {
                                $foto = base_url() . 'uploads/foto/' . $userdata['foto'];
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

        <main role="main" class="col-md-8 col-lg-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Profile</h1>
            </div>
            <div class="">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="accordion">
                            <form action="/action_page.php">
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
                                                            <input type="text" placeholder="...." name="fullname">
                                                            <span class="icon"><i class="fal fa-user"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Nama lengkap dengan gelar</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="fullname_title">
                                                            <span class="icon"><i class="fal fa-user"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <span class="icon">Jenis Kelamin</span>
                                                        <div class="form-group">
                                                            <select name="gender" style="display: none;">
                                                                <option value="" disabled selected hidden>Pilih</option>
                                                                <option value="male">Pria</option>
                                                                <option value="female">Wanita</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="icon">Tempat Lahir</span>
                                                        <div class="form-group">
                                                            <input name="place_birth" type="text" placeholder="....">
                                                            <span class="icon"><i class="fal fa-location"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="icon">Tanggal Lahir</span>
                                                        <div class="form-group">
                                                            <input name="date_birth" type="text" class="has-icon datepicker-here hasDatepicker" data-language="en" placeholder="Select Date" id="">
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
                                                            <input type="text" placeholder="...." name="email">
                                                            <span class="icon"><i class="fal fa-envelope"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Nomor Telepon 1</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_phone">
                                                            <span class="icon"><i class="fal fa-phone"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Nomor Telepon 2</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_phone2">
                                                            <span class="icon"><i class="fal fa-phone"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <span class="icon">Alamat Rumah</span>
                                                        <div class="form-group">
                                                            <textarea name="correspondence_address" id="correspondence_address" placeholder="Write here"></textarea>
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
                                                            <input type="text" placeholder="...." name="npa">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Cabang PDGI</span>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="...." name="cb_phone">
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
                                                            <input type="text" placeholder="...." name="no_serkom">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Berlaku sampai</span>
                                                        <div class="form-group">
                                                        <input name="serkom_exp" type="text" class="has-icon datepicker-here hasDatepicker" data-language="en" placeholder="Select Date" id="">
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
                                                            <input type="text" placeholder="...." name="no_str">
                                                            <span class="icon"><i class="fal fa-id-card"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="icon">Berlaku sampai</span>
                                                        <div class="form-group">
                                                        <input name="str_exp" type="text" class="has-icon datepicker-here hasDatepicker" data-language="en" placeholder="Select Date" id="">
                                                            <span class="icon"><i class="fal fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>