<style>
    .kb-alert-message-content {
        padding: 10px;
        width:300px;
    }
    .kb-alert-message-header {
        background-color: #fff;
        border-bottom: 1px dashed #1e3963;
        padding-bottom: 6px;
    }
    .kb-alert-message-header > img {
        height: 35px;
        width: auto;
    }
    .kb-alert-message-footer {
        background-color: #fff;
        padding: 0;
    }
    .kb-alert-message-body {
        margin-top: 0;
        height: auto;
        padding: 18px;
    }
    button.message-box.close {
        background-color: #064b86;
        padding: 8px 22px;
        border-radius: 4px;
        color: #fff;
    }
    button.message-box.close:hover, button.message-box.close:active, button.message-box.close:focus {
        background-color: #014075 !important;
        color: #fff;
        opacity: 1;
    }
    .kb-alert-message-header > .close_message {
        cursor: pointer;
        float: right;
        color: #444;
        font-size: 23px;
        margin: 3px 10px;
    }
    .kb-alert-message-header > .close_message:hover {
        opacity: 0.7;
    }
    @media (max-width:480px){
        .kb-alert-message-content {
            padding: 10px;
            width: 90%;
            margin: 0 auto;
        }
    }
</style>
<div id="cz-kb-alert-message" class="kb-alert-message-popup">
    <!-- kb-alert-message content -->
    <div class="kb-alert-message-content">
        <div class="kb-alert-message-header">
            <img src="<?php echo $this->webroot; ?>images/ic_logo_login.png">
            <div title="Close" class="close_message">×</div>
        </div>
        <div class="kb-alert-message-body">

        </div>
        <div class="kb-alert-message-footer">
            <button class="text-right close message-box">OK</button>
        </div>
    </div>
</div>