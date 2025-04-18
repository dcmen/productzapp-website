<div class="wrap_content">
    <div class="col-xs-12">
        <div class="title_response ridbon">
            <?php echo $this->Html->image('/images/search_plus.png')?>
            Set & forget flicka
        </div>
    </div>
    <div id="Notifi" class="col-xs-12"s>
        <?php 
        if($list){?>
            <ul>
                <?php foreach($list as $m):?>
                <li>
                    <div class="col-xs-11">
                        <a href="<?php echo $this->Html->Url('/set_forget_id/'.$m->_id)?>">
                            <i class="fa fa-car"></i>
                            <?php
                            $rel = json_decode($m->search_params);
                            $a = '';
                            if(isset($rel->make)){
                            $a .= $rel->make;
                            }
                            if(isset($rel->model)){
                            $a .= $rel->model;
                            }
                            if(isset($rel->series)){
                            $a .= $rel->series;
                            }
                            if(isset($rel->gearbox)){
                            $a .= $rel->gearbox;
                            }
                            echo ($a != '')?' '.$a.' - ':' Not set - ';
                            echo ($m->updated_at)?$m->updated_at:'Not set';
                            ?>
                        </a>
                    </div>    
                    <div class="col-xs-1">
                    <a href="javascript:;" class="del_setforget" setforgetid="<?php echo $m->_id?>"><i class="fa fa-trash-o" style="color: #fff"></i></a>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
        <?php }?>
    </div>
</div>


<script type="text/javascript">
Vcore.Flicka.Setforget();
</script>