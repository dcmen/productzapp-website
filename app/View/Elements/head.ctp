<?php 
$uri1 = $this->params['pass']?>
<nav class="navbar cus-navbar" id="menu" style="position: fixed; width: 100%; z-index: 1000; top: 0px; left: 0px;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed navbar-mobile" data-toggle="collapse" data-target="#navigation-bar">
                <i class="material-icons icon-menu">&#xE5D2;</i>
            </button>
            <div class="logo hidden-xs">
                <a href="<?php echo $this->Html->Url('/')?>">
                    <img src="<?php echo $this->webroot ?>images/logo.png">
                </a>
            </div> 
            <div class="logo_xs hidden-lg hidden-md hidden-sm">
                <a href="">
                    <img class="img-responsive" width="100px" src="<?php echo $this->webroot ?>images/logo.png">
                </a>
            </div> 
        </div>    
        <div class="collapse navbar-collapse" id="navigation-bar"><!--collapse navbar-collapse navbar-menu -->
            <ul class="nav navbar-right navbar-nav">
                <li>
                    <a class="<?php //echo ($uri1 == '')?'select':''?>" href="<?php echo $this->Html->Url('/')?>">Home</a>
                </li>
                <li><a href="<?php echo $this->Html->Url('/AboutUs')?>">About Us</a></li>
                <li>
                    <a href="javascript:;" data-toggle="modal" data-target="#my_login"> Login</a>
                </li>
                <li><a href="<?php echo $this->Html->Url('/Support')?>">Help</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php echo $this->element('login');?>