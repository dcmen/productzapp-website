<div class="wrapper_regis">
    <div class="col-xs-12 pull-left col-xs-offset-2 col-lg-10 col-lg-offset-1">
        <div style="margin: 20px 0">
            <a href="<?php echo $this->Html->Url('/')?>"><?php echo $this->Html->image('/images/ic_logo_login.png')?></a>
        </div>
    </div>
    <div id="sign_up">
        <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 content-complete no-padding">
            <h5>Password reset</h5>
            <?php if ($type == 555) : ?>
            <form id="Forgot2" action="<?php echo $this->Html->Url('/forgot_password?email=' . $email . '&secretstring=' . $secretstring) ?>" method="post" class="form-horizontal" >
                <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                    <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                    <div class="col-lg-12">
                        <div class="form-group">
                           <label>Enter new password</label><span class="sao">*</span>
                           <input type="password" autocomplete="off" name="password" class="form-control" required placeholder="Enter new password...">
                        </div>
                    </div>   
                    <div class="col-lg-12">
                        <div class="form-group">
                           <label>Confirm password</label><span class="sao">*</span>
                           <input type="password" autocomplete="off" name="confirm_password" class="form-control" placeholder="Confirm password">
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center" style="margin-top: 30px;">
                    <button class="btn bt_login btn_forget" type="submit">Reset Password</button>
                </div>
            </form>
            <?php elseif ($type == 666) : ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="height: 120px;">
                <p style="line-height: 120px; text-align: center;">Password reset successful.</p>
            </div>
            <div class="clearfix"></div>
            <div style="text-align: center; margin: 30px 0px 30px;">
                <a class="btn bt_login btn-continue" type="button" href="<?php echo $this->Html->Url('/home_current') ?>">Continue</a>
            </div>
            <?php elseif ($type == 0) : ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="height: 120px;">
                <p style="line-height: 120px; text-align: center;">Email does not exist in the system</p>
            </div>
            <div class="clearfix"></div>
            <div style="text-align: center; margin: 30px 0px 30px;">
                <a class="btn bt_login btn-continue" type="button" href="<?php echo $this->Html->Url('/home_current') ?>">Continue</a>
            </div>
            <?php elseif ($type == 1) : ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="height: 120px;">
                <p style="line-height: 120px; text-align: center;">Link expired</p>
            </div>
            <div class="clearfix"></div>
            <div style="text-align: center; margin: 30px 0px 30px;">
                <a class="btn bt_login btn-continue" type="button" href="<?php echo $this->Html->Url('/home_current') ?>">Continue</a>
            </div>
            <?php elseif ($type == 3) : ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="height: 120px;">
                <p style="line-height: 120px; text-align: center;">Cannot reset password</p>
            </div>
            <div class="clearfix"></div>
            <div style="text-align: center; margin: 30px 0px 30px;">
                <a class="btn bt_login btn-continue" type="button" href="<?php echo $this->Html->Url('/home_current') ?>">Continue</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>        

<script type="text/javascript">
    Vcore.Home.SubmitForGot();
</script>