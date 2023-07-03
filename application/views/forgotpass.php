    <!-- login Area Strat-->
    <section class="login-area pt-100 pb-100">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 offset-lg-2">
                    <div class="basic-login">
                        <h3 class="text-center mb-60">Reset Password Member IKORTIJAYA</h3>
                        <form action="<?php echo base_url() . 'auth/reset_password' ?>" method="POST">
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
                            <label for="email">Email <span>**</span></label>
                            <input name="email" id="email" type="text" placeholder="Enter Email address..." />

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