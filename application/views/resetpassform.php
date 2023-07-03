    <!-- login Area Strat-->
    <section class="login-area pt-100 pb-100">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 offset-lg-2">
                    <div class="basic-login">
                        <h3 class="text-center mb-60">Ubah Password Member IKORTIJAYA</h3>
                        <form action="<?php echo base_url() . 'auth/update_password' ?>" method="POST">
                            <?php
                            $message = $this->session->flashdata('message');
                            $error_msg = $this->session->flashdata('error_msg');
                            if (isset($message)) {
                                echo '<div class="alert alert-success">' . $message . '</div>';
                                $this->session->unset_userdata('message');
                            }

                            if (isset($error_msg)) {
                                echo '<div class="alert alert-danger">' . $error_msg . '</div>';
                                $this->session->unset_userdata('error_msg');
                            }
                            ?>
                            <label for="password">Password <span></span></label>
                            <input name="password" id="password" type="password" placeholder="Enter password address..." />
                            <input name="token" id="token" type="hidden" value="<?php echo $token; ?>" />

                            <label for="repeat_password">Repeat Password <span></span></label>
                            <input name="repeat_password" id="repeat_password" type="password" placeholder="Repeat password address..." />

                            <div class="login-action mb-20 fix"> </div>
                            <div class="py-2 my-2 text-center w-100">
                                <span class="text-danger"> <?php echo $this->session->flashdata('error_msg'); ?></span>
                            </div>
                            <button class="site-btn red w-100">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login Area End-->