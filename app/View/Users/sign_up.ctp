<?php 
$uri1 = $this->params['pass']?>
 <script type="text/javascript">
    $(document).ready(function () {
        $("#container_image").PictureCut({
            Extensions: ["jpg", "png", "gif"],
            InputOfImageDirectory: "image",
            PluginFolderOnServer: root,
            FolderOnServer: root + "app/webroot/img/uploads/users_avatar/",
            MinimumWidthToResize: 1024,
            MinimumHeightToResize: 630,
            EnableCrop: true,
            dataType : "json",
            CropWindowStyle: "Bootstrap"
        }); 
        
        $(".img_avata").click(function(){
            $(this).remove();
            $("#container_image").css('display','block');
        });
    });
    Vcore.Home.SubmitRegis();
</script>
<div class="wrapper_regis">
    <div style="padding: 20px 20px 20px 60px">
        <a href="<?php echo $this->Html->Url('/')?>"><?php echo $this->Html->image('/images/ic_logo_login.png')?></a>
    </div>
    <div id="sign_up" class="col-xs-12">
        <div class="content_sign_up">
                <?php if($step == 1 || $step == ''){?>
                <form id="Regis" action="users/register" method="post" class="form-horizontal">
                    <input type="hidden" name="url" value="<?php echo $this->Html->Url('/')?>">
                    <div class="div_upload">
                        <?php if($this->Session->read('Auth.User.avata')){?>
                            <div id="container_image" style="display: none"></div>
                            <div class="img_avata">
                                <input type="hidden" name="image" value="<?php echo $this->Html->Url('/app/webroot/img/uploads/users_avatar/'.$this->Session->read('Auth.User.avata'))?>">
                                <?php echo $this->Html->image('/app/webroot/img/uploads/users_avatar/'.$this->Session->read('Auth.User.avata'))?>
                            </div>
                        <?php }else{?>
                            <div id="container_image"></div>
                        <?php }?>
  
                    </div>
                    <div class="col-xs-12 step">
                        <?php echo $this->Html->image('/images/step1.png')?>
                    </div>
                    
                    <h5>Step 1</h5>

                    <div class="col-lg-5 col-xs-10">    
                         <div class="form-group line-form">
                            <label>First Name</label>
                            <input type="text" autocomplete="off" name="name" class="form-control" required value="<?php echo ($this->Session->read('fb_first_name'))?$this->Session->read('fb_first_name'):$this->Session->read('first_name_rg')?>">
                         </div>
                         <div class="form-group line-form">
                            <label>Last Name</label>
                            <input type="text" autocomplete="off" name="last_name" class="form-control" required value="<?php echo ($this->Session->read('fb_last_name'))?$this->Session->read('fb_last_name'):$this->Session->read('last_name_rg')?>">
                         </div>
                         <div class="form-group line-form">
                            <label>Email Address</label>
                            <input type="email" autocomplete="off" name="email" class="form-control" required value="<?php echo ($this->Session->read('fb_email'))?$this->Session->read('fb_email'):$this->Session->read('email_rg')?>">
                         </div>

                         <div class="line-form form-group">
                            <div class="checkbox" style="padding-left: 0px; margin: 0px;;" >
                                <label>
                                    <input type="checkbox" name="agree" <?php echo ($this->Session->read('agree_rg'))?'checked = checked':''?> value="1" required>
                                    Yes, I agree to CarZapp <a href="" target="_blank">Terms of Use</a>
                                </label>
                            </div>
                         </div>
                        <div class="form-group line-form" style="margin-top: 0">
                            <div class="checkbox" style="padding-left: 0px; margin: 0px;;" >
                                <label>
                                    <input type="checkbox" <?php echo ($this->Session->read('is_principle_rg'))?'checked = checked':''?> name="is_principle" value="1">
                                    I'm a Principal
                                </label>
                            </div>
                         </div>
                    </div> 

                    <div class="col-xs-2" style="text-align: center">
                        <div class="line_col"></div>
                    </div>

                    <div class="col-lg-5 col-xs-10">
                        <div class="form-group line-form">
                            <label>Phone</label>
                            <input type="text" name="phone" autocomplete="off" class="form-control" value="<?php echo ($this->Session->read('fb_phone'))?$this->Session->read('fb_phone'):$this->Session->read('phone_rg')?>">
                         </div>
                        <div class="form-group line-form">
                            <label>Password</label>
                            <input type="password" name="password" maxlength="8" minlength="8" data-fv-stringlength-message="The password less than 8 characters" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group line-form">
                            <label>Confirm Password</label>
                            <input type="password" name="re_password" autocomplete="off" class="form-control">
                        </div>

                    </div>
                    <div class="col-xs-12" style="text-align: center">
                        <button type="submit" class="btn bt_login ">NEXT</button>
                    </div>
                    <div class="col-lg-6 col-xs-12" style="margin-top: 28px">
                        Already have an account?
                    </div>
                    <div class="col-lg-6 col-xs-12" style="text-align: center;margin-top: 20px">
                        Sign up with 
                        <a class="no-decoration" href="<?php echo $this->Html->Url("/loginfb")?>">
                            <img src="<?php echo $this->webroot ?>images/face.png">
                        </a>
                        or 
                        <a class="no-decoration" href="">
                            <img src="<?php echo $this->webroot ?>images/twitter.png">
                        </a>
                    </div>
                </form>    
                <?php }else if($step == 2){?>
                    <div class="div_upload">
                        <?php 
                        if($this->Session->read('avata_rg')){
                            echo $this->Html->image('/app/webroot/img/uploads/users_avatar/'.$this->Session->read('avata_rg'));
                        }else{
                            echo $this->Html->image('/src/img/person.png',array('class' =>'img_sign_up'));
                        }
                        ?>
                    </div>
                    <form id="Regis_2" action="users/register_2" method="post" class="form-horizontal">
                        <div class="col-xs-12 step">
                            <?php echo $this->Html->image('/images/step2.png')?>
                        </div>
                        
                        <h5>Step 2</h5>
                        
                        <div>
                            <div class="form-group line-form">
                                <div class="col-lg-4"><label>Dealership name</label></div>
                                <div class="col-lg-8">
                                    <input type="text" name="company_name" autocomplete="off" class="form-control" value="<?php echo $this->Session->read('company_name_rg')?>">
                                </div>
                            </div>
                            <div class="form-group line-form">
                                <div class="col-lg-4"><label>Dealer License Number</label></div>
                                <div class="col-lg-8">
                                    <input type="text" name="dealer_number" autocomplete="off" class="form-control" value="<?php echo $this->Session->read('dealer_number_rg')?>">
                                </div>
                            </div>

                            <div class="form-group line-form">
                                <div class="col-lg-4"><label>Data source</label></div>
                                <div class="col-lg-8">
                                    <?php foreach($data_source as $rs):?>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="data_source[]" value="<?php echo $rs['DataSourceCar']['id']?>"><?php echo $rs['DataSourceCar']['name']?></label>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12" style="text-align: center; margin-top: 15px;">
                            <a href="<?php echo $this->Html->Url('/sign_up?step=1')?>" class="btn bt_login bt_back">BACK</a>
                            <button type="submit" class="btn bt_login">NEXT</button>
                        </div>
                    </form>
                <?php }else if($step == 3){?>
                    <div class="div_upload">
                        <?php 
                        if($this->Session->read('avata_rg')){
                            echo $this->Html->image('/app/webroot/img/uploads/users_avatar/'.$this->Session->read('avata_rg'));
                        }else{
                            echo $this->Html->image('/src/img/person.png',array('class' =>'img_sign_up'));
                        }
                        ?>
                    </div>
                    <form id="Regis_3" action="users/register_3" method="post" class="form-horizontal">
                        <div class="col-xs-12 step">
                            <?php echo $this->Html->image('/images/step3.png')?>
                        </div>
                        
                        <h5>Step 3</h5>
                        
                        <div>
                            <div class="form-group line-form">
                                <div class="col-lg-4"><label>Principal CarZapp Code</label></div>
                                <div class="col-lg-7">
                                    <input type="text" name="code" value="<?php echo $this->Session->read('code_rg')?>" class="form-control"> 
                                </div>
                                <div class="col-lg-1">
                                    <input type="button" class="row btn btn-view btn_check_code" value="OK">
                                </div>
                            </div>
                            <div class="form-group line-form">
                                <div class="col-lg-4"><label>Dealership Name:</label></div>
                                <div class="col-lg-8">
                                    <input type="text" id="companyname" name="companyname" autocomplete="off" disabled="disabled" class="form-control">
                                </div>
                            </div>
                            <div class="form-group line-form">
                                <div class="col-lg-4"><label>Dealer License Number:</label></div>
                                <div class="col-lg-8">
                                    <input type="text" id="dealernumber" name="dealernumber" autocomplete="off" disabled="disable" class="form-control">
                                </div>
                            </div>
                            <div class="form-group line-form">
                                <div class="col-lg-4"><label>Data source</label></div>
                                <div class="col-lg-8">
                                    <?php foreach($data_source as $rs):?>
                                    <div class="checkbox" style="margin-left: 0">
                                        <label><input class="data_source" data_id="<?php echo $rs['DataSourceCar']['id'];?>" type="checkbox" name="data_source[]" value="<?php echo $rs['DataSourceCar']['id']?>" disabled="disabled"><?php echo $rs['DataSourceCar']['name']?></label>
                                    </div>
                                    <?php endforeach;?>
                                </div>    
                            </div>
                        </div>
                        <div class="col-lg-12" style="text-align: center">
                            <a href="<?php echo $this->Html->Url('/sign_up?step=1')?>" class="btn bt_login bt_back">BACK</a>
                            <button type="submit" class="btn bt_login">NEXT</button>
                        </div>
                    </form>
                <?php }else if($step == 4){?>
                    <div class="div_upload">
                        <?php 
                        if($this->Session->read('avata_rg')){
                            echo $this->Html->image('/app/webroot/img/uploads/users_avatar/'.$this->Session->read('avata_rg'));
                        }else{
                            echo $this->Html->image('/src/img/person.png',array('class' =>'img_sign_up'));
                        }
                        ?>
                    </div>
                    <div class="col-xs-12 step">
                        <?php echo $this->Html->image('/images/step4.png')?>
                    </div>
                               
                    <div class="form-group line-form" style="text-align: center">
                        <h4>Thank for registration!</h4>
                        Your CarZapp code is: <span id="car_code"><?php echo $this->Session->read('carzapp_code_rg')?></span>
                    </div>
                <?php }?>
              
        </div>    
    </div>
</div>
<link href="dependencies/css/prettify.css" rel="stylesheet">
<script src="dependencies/jquery/prettify.js"></script>
<script src="src/jquery.picture.cut.js"></script> 
<script type="text/javascript">
$(document).ready(function() {

    $(".btn_check_code").on("click",function(){
            var codef = $('input[name="code"]').val();
            $.post(root + 'users/check_code',{'codef':codef},function(data){
                $(".data_source").removeAttr("checked");
                if(data.error == 0){
                    $("input[name='companyname']").val(data.companyname);
                    $("input[name='dealernumber']").val(data.dealernumber);
                    $(".data_source").each(function(){
                        var data_id = parseInt($(this).attr("data_id"));
                        for(i = 0; i < data.list.length; i++){
                            var id = parseInt(data.list[i]);
                            if(id == data_id){
                                $(this).prop("checked","checked");
                                console.log(id+" - check");
                            }
                        }
                    });
                }else{
                    $(".login").prop('disabled', 'disabled');
                    jAlert('Not exits this code in system! ');
                }
            },'json');
        });

});
</script>