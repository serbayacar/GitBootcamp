<!-- BEGIN : LOGIN PAGE 5-1 -->
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset">
            <div class="login-bg">

            </div>
        </div>
        <div class="col-md-6 login-container bs-reset">
            <div class="login-content">
                <h1 style="color:#00ced1">Pickyfy Login</h1>
                <?php echo validation_errors(); ?>
                <?php echo form_open('index.php/VerifyLogin', array('class' => 'login-form')); ?>

                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>Enter any username and password. </span>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <input class="form-control form-control-solid placeholder-no-fix form-group" type="text"
                               autocomplete="off" placeholder="Username" name="username" required/></div>
                    <div class="col-xs-6">
                        <input class="form-control form-control-solid placeholder-no-fix form-group" type="password"
                               autocomplete="off" placeholder="Password" name="password" required/></div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="rem-password">
                            <label class="rememberme mt-checkbox mt-checkbox-outline">
                                <input type="checkbox" name="remember" value="1"/> Remember me <span></span> </label>
                        </div>
                    </div>
                    <div class="col-sm-8 text-right">
                        <div class="forgot-password">
                            <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                        </div>
                        <button class="btn green" type="submit">Sign In</button>
                    </div>
                </div>
                </form>
                <!-- BEGIN FORGOT PASSWORD FORM -->
                <form class="forget-form" action="javascript:;" method="post">
                    <h3 class="font-green">Forgot Password ?</h3>
                    <p> Enter your e-mail address below to reset your password. </p>

                    <div class="form-group">
                        <input class="form-control placeholder-no-fix form-group" type="text" id="email_forgetpwd"
                               autocomplete="off" placeholder="Email" name="email"/>
                    </div>

                    <div class="note success font-green" id="email_notification"
                         style="display:none;background-color:#ecf0f1;"></div>

                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
                        <button type="button" onclick="sendPassword();" id="forgetpwd_email"
                                class="btn btn-success uppercase pull-right">Submit
                        </button>
                    </div>
                </form>
                <!-- END FORGOT PASSWORD FORM -->
            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="col-xs-5 bs-reset">
                        <ul class="login-social">

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
//load the js function
if (isset($js_function)) {
    foreach ($js_function as $js) {
        $js = $js . '.js';
        ?>

        <script src="<?php echo base_url(); ?>assets/apps/<?php echo $js; ?>"></script>

        <?php
    }
}
?>
<script type="text/javascript">

    function sendPassword() {
        var dataString = "email=" + $.trim($("#email_forgetpwd").val());
        $.ajax({
            type: "POST",
            url: base_url + "/index.php/VerifyLogin/getNewPassword/",
            data: dataString,
            cache: false,

            success: function (data, textStatus, jqXHR) {
                alert(data);
                $("#email_notification").html("<strong>Password Change Offer has been sent to your email address</strong>").fadeIn(100);
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
        return false;
    }
</script>
