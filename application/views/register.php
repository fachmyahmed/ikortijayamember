    <!-- login Area Strat-->
    <section class="login-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="basic-login">
                        <h3 class="text-center mb-60">Register Member IKORTIJaya</h3>
                        <form action="<?php echo base_url().'member/process_register' ?>" method="POST">
                            <label for="email">Email <span>**</span></label>
                            <input name="email" id="email" type="text" placeholder="Enter Email address..." />
                            <label for="pass">Password <span>**</span></label>
                            <input name="password" id="password" type="password" placeholder="Enter password..." />
                            <label for="repeatpass">Repeat Password <span>**</span></label>
                            <input name="repeat_password" id="repeat_password" type="password" placeholder="Repeat password..." />
                            <div class="login-action mb-20 fix">
                                <span class="log-rem f-left">
                                    <input id="remember" type="checkbox" />
                                    <label for="remember">Remember me!</label>
                                </span>
                                <span class="forgot-login f-right">
                                    <a href="#">Lost your password?</a>
                                </span>
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