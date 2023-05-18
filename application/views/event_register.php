<!-- login Area Strat-->
<section class="login-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-10 offset-lg-1"> -->
            <div class="col-lg-12">
                <div class="basic-login">
                    <h3 class="text-center">Register Event</h3>
                    <h3 class="text-center mb-60"><?php echo $event_detail->title; ?></h3>
                    <form id="registerform" action="<?php echo base_url() . 'events/register_process' ?>" method="POST" enctype="multipart/form-data">
                        <?php
                        $message = $this->session->flashdata('message');
                        if (isset($message)) {
                            echo '<div class="alert alert-info">' . $message . '</div>';
                            $this->session->unset_userdata('message');
                        }
                        // echo  $this->session->userdata('captcha_word');

                        ?>
                        <input name="id_event" id="id_event" type="hidden" value="<?php echo $event_id; ?>" />
                        <div class="row">
                            <div class="col-md-12">
                                <img src="<?php echo base_url() . '../ikortijaya/uploads/' . $event_detail->image; ?>">
                            </div>
                            <div class="col-md-12">
                                <video class="w-100" src="<?php echo base_url() . '../ikortijaya/uploads/' . $event_detail->video; ?>" playsinline autoplay muted loop>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <?php echo $event_detail->contents; ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="fullname">Nama Lengkap <span>*Sesuai STR</span></label>
                                <input name="fullname" id="fullname" type="text" placeholder="Enter fullname .." value="<?php echo $userdata['fullname'] ?>" />
                            </div>
                            <div class="col-md-6">
                                <label for="npa">NPA PDGI <span></span></label>
                                <input name="npa" id="npa" type="text" placeholder="Enter NPA ..." value="<?php echo $userdata['npa'] ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email">Email <span>**</span></label>
                                <input name="email" id="email" type="text" placeholder="Enter Email address..." value="<?php echo $userdata['email'] ?>" />
                            </div>
                            <div class="col-md-6">
                                <label for="cb_phone">Handphone/Phone number <span></span></label>
                                <input name="cb_phone" id="cb_phone" type="text" placeholder="Enter phone number..." value="<?php echo $userdata['cb_phone'] ?>" />
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="payment_proof">Upload Bukti Pembayaran <span></span></label>
                                <input type="file" name="payment_proof" style="padding-top: 16px;">
                            </div>
                            <div class="col-md-6">
                                <label for="tgl_trf">Tanggal Transfer<span></span></label>
                                <input name="tgl_trf" type="text" class="has-icon datepicker-here " data-language="en" placeholder="Select Date" id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama_bank">Nama Bank <span></span></label>
                                <input name="nama_bank" id="nama_bank" type="text" placeholder="..." />
                            </div>
                            <div class="col-md-6">
                                <label for="pemilik_rek">Nama Pemilik Rekening <span></span></label>
                                <input name="pemilik_rek" id="pemilik_rek" type="text" placeholder="..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nomor_rek">Nomor Rekening <span></span></label>
                                <input name="nomor_rek" id="nomor_rek" type="text" placeholder="..." />
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
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <button class="site-btn red w-100">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- login Area End-->