<!-- login Area Strat-->
<section class="login-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="basic-login">
                    <h3 class="text-center mb-60">Ubah Password</h3>
                    <form id="changepassform" action="<?php echo base_url() . 'member/process_change_pass' ?>" method="POST">
                        <?php
                        $message = $this->session->flashdata('message');
                        if (isset($message)) {
                            echo '<div class="alert alert-info">' . $message . '</div>';
                            $this->session->unset_userdata('message');
                        }
                        // echo  $this->session->userdata('captcha_word');

                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password">Password <span></span></label>
                                <input name="email" id="email" type="hidden" value="<?php echo $datamember->email; ?>" />
                                <input name="password" id="password" type="password" placeholder="Enter password .." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="newpass">New Password <span>* minimum 6 character </span></label>
                                <input name="newpass" id="newpass" type="password" placeholder="Enter New Password ..." />
                            </div>
                            <div class="col-md-12">
                                <label for="repeatnewpass">Repeat New Password <span>** must match new password </span></label>
                                <input name="repeatnewpass" id="repeatnewpass" type="password" placeholder="Repeat New Password..." />
                            </div>
                        </div>
          
                        <div class="py-2 my-2 text-center w-100">
                            <span class="text-danger"> <?php echo $this->session->flashdata('error_msg'); ?></span>
                        </div>
                        <button class="site-btn red w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- login Area End-->

<script>
$(document).ready(function() {
    // Form validation
    $("#changepassform").submit(function(event) {
        event.preventDefault();

        // Clear previous error messages
        $(".error").remove();

        // Get input values
        var password = $("#password").val();
        var newPass = $("#newpass").val();
        var repeatNewPass = $("#repeatnewpass").val();

        // Validate password
        if (password == "") {
            $("#password").after('<span class="error">Password is required</span>');
        }

        // Validate new password
        if (newPass == "") {
            $("#newpass").after('<span class="error">New Password is required</span>');
        }

        // Validate repeat new password
        if (repeatNewPass == "") {
            $("#repeatnewpass").after('<span class="error">Repeat New Password is required</span>');
        } else if (repeatNewPass != newPass) {
            $("#repeatnewpass").after('<span class="error">New Password and Repeat New Password do not match</span>');
        }

        // If there are no errors, submit the form
        if ($(".error").length == 0) {
            this.submit();
        }
    });
});
</script>
