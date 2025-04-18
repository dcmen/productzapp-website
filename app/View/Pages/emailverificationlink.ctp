<style>
    .wrapper_regis p {
        margin-bottom: 20px;
    }
    .step {
        width: 100%;
    }
</style>
<div class="wrapper_regis">
    <div class="col-xs-12 pull-left col-xs-offset-2 col-lg-10 col-lg-offset-1">
        <div style="margin: 20px 0">
            <a href="<?php echo $this->Html->Url('/')?>"><?php echo $this->Html->image('/images/ic_logo_login.png')?></a>
        </div>
    </div>
    <div id="sign_up">
        <!--<div class="step" style="position: absolute;">-->
            <?php // echo $this->Html->image('/images/step3.png')?>
        <!--</div>-->
        <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 no-padding">
            <h5>Email Validation completed</h5>
            <div class="col-lg-12">
                <p>Thank you for validating your email address.</p>
                <p>Please wait for a final activation email, which will be sent to you shortly.</p>
                <p style="margin-top: 28px;">Thank you</p>
                <p style="color: rgb(30, 57, 99);">The CarZapp Team</p>
            </div>
            <div class="clearfix"></div>
            <div style="text-align: center; margin: 30px 0px 30px;">
                <a class="btn bt_login" type="button" href="<?php echo $this->Html->Url('/home_current')?>">DONE</a>
            </div>
        </div>
    </div>
</div>