<!-- login Area Strat-->
<section class="login-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="basic-login">
                    <h3 class="text-center mb-60">Register Member IKORTIJAYA</h3>
                    <form id="registerform" action="<?php echo base_url() . 'auth/register_process' ?>" method="POST" enctype="multipart/form-data">
                        <?php
                        $message = $this->session->flashdata('message');
                        $error = $this->session->flashdata('error');
                        if (isset($message)) {
                            echo '<div class="alert alert-info">' . $message . '</div>';
                            $this->session->unset_userdata('message');
                        }

                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                            $this->session->unset_userdata('error');
                        }
                        // echo  $this->session->userdata('captcha_word');

                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="fullname">Nama Lengkap <span></span></label>
                                <input name="fullname" id="fullname" type="text" placeholder="Enter fullname .." />
                            </div>
                            <div class="col-md-6">
                                <label for="fullname_title">Nama Lengkap Dengan Gelar</label>
                                <input name="fullname_title" id="fullname_title" type="text" placeholder="Enter fullname with title .." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="npa">NPA <span></span></label>
                                <input name="npa" id="npa" type="text" placeholder="Enter NPA ..." />
                            </div>
                            <div class="col-md-6">
                                <label for="cb_phone">No. Handphone <span>**</span></label>
                                <input name="cb_phone" id="cb_phone" type="text" placeholder="Enter phone number..." />
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-md-6">
                                <label for="email">Gender <span></span></label>
                                <select name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <span class="icon">Tempat Lahir</span>
                                <div class="form-group">
                                    <input name="place_birth" type="text" placeholder="...." value="<?php echo $datamember->place_birth; ?>">
                                   
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <span class="icon">Tanggal Lahir *bulan/tanggal/tahun</span>
                                <div class="form-group">
                                    <input name="date_birth" type="text" class="has-icon hasdatepicker" data-language="en" placeholder="Select Date" id="datepicker">
                               
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <span class="icon">Pendidikan Dokter Gigi</span><br>
                            </div>
                            <div class="col-lg-6">
                                <span class="icon">Asal Universitas</span>
                                <div class="form-group">
                                    <input type="text" placeholder="...." name="cb_pendidikan_s1" value="">

                                </div>
                            </div>
                            <div class="col-lg-3">
                                <span class="icon">Tahun Masuk</span>
                                <div class="form-group">
                                    <input type="number" placeholder="...." name="university_year" value="">

                                </div>
                            </div>
                            <div class="col-lg-3">
                                <span class="icon">Tahun Lulus</span>
                                <div class="form-group">
                                    <input type="number" placeholder="...." name="university_year_grad" value="">

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
                                    <input type="text" placeholder="...." name="cb_pendidikan_sp" value="">

                                </div>
                            </div>
                            <div class="col-lg-3">
                                <span class="icon">Tahun Masuk</span>
                                <div class="form-group">
                                    <input type="number" placeholder="...." name="spc_year" value="">

                                </div>
                            </div>
                            <div class="col-lg-3">
                                <span class="icon">Tahun Lulus</span>
                                <div class="form-group">
                                    <input type="number" placeholder="...." name="spc_year_grad" value="">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="icon">Pas Foto</span>
                                <div class="form-group">
                                    <input type="file" placeholder="...." class="w-100" name="foto" style="padding: 15px 20px;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Email <span>**</span></label>
                                <input name="email" id="email" type="text" placeholder="Enter Email address..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password">Password <span>**</span></label>
                                <input name="password" id="password" type="password" placeholder="Enter password..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="repeatpass">Repeat Password <span>**</span></label>
                                <input name="password_confirmation" id="password_confirmation" type="password" placeholder="Repeat password..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <?php echo $captcha_image; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Captcha:</label>
                                <input type="text" name="captcha">
                            </div>
                        </div>

                        <div class="py-2 my-2 text-center w-100">
                            <span class="text-danger"> <?php echo $this->session->flashdata('error_msg'); ?></span>
                        </div>
                        <button class="site-btn red w-100">Register</button>
                        <div class="or-divide"><span>or</span></div>
                        <a href="<?php echo base_url("login"); ?>" class="text-center site-btn w-100">Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- login Area End-->