<style>
    .datafeed-container {
        height: 182px;
        overflow-y: auto;
    }
    .datafeed-container > .checkbox {
        margin-top: 0;
    }
    @media (max-width: 640px) {
        .datafeed-container {
            height: 175px;
        }
    }
</style>
<div class="wrapper_regis">
    <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1">
        <div class="container-logo" style="margin: 30px 0">
            <a href="<?php echo $this->Html->Url('/')?>"><?php echo $this->Html->image('/images/ic_logo_login.png')?></a>
        </div>
    </div>
    <div id="sign_up">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 no-padding">
                <div class="white-wrapper">
                    <div class="col-lg-12">
                        <h4>Registration Complete</h4>
                    </div>
                    <br>
                    <div class="col-lg-12">
                        <p>Your account has been setup and is awaiting verification.</p>
                    </div>
                    <div style="margin-top: 20px;" class="col-lg-12">
                        <p>We will send you an email when activated.</p>
                    </div>
                    <div style="margin-top: 20px;" class="col-lg-12">
                        <p>The CarZapp Team.</p>
                    </div>
                    <div class="col-lg-12">
                        <div style="text-align: right; margin: 30px 0 0;">
                            <a style="color:#009688" class="btn btn-next" type="button" href="<?php echo $this->Html->Url('/facebooks/finish_step_5') ?>">OK</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>