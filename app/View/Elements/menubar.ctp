<style>
    img.ic_logo{
        width: 103px;
    }
</style>
<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
    <button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>
    <div class="navbar-inner">
        <div class="navbar-header">
            <a href="#" class="navbar-brand">
                <?php echo $this->Html->image('/images/ic_logo_login.png',array('class' =>'ic_logo')) ?>
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>
        </div> 
        <div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
            <div>
                <div class="right clearfix">
                    <ul class="nav navbar-nav pull-right right-navbar-nav">
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle user-menu" data-toggle="dropdown">
                                <span><i class="fa fa-user"></i> <?php echo $this->Session->read('Auth.User.name')?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href=""><i class="fa fa-key"></i>&nbsp;&nbsp;Change password</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo $this->Html->Url('/logout_admin')?>"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Logout</a></li>
                            </ul>
                        </li>
                        <li><a target="_blank" href="<?php echo $this->Html->Url('/')?>"><i class="fa fa-desktop"></i> View website</a></li>
                    </ul> 
                </div> 
            </div>
        </div> 
    </div> 
</div> 