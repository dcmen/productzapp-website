<div class="col-xs-12" style="margin-top: 20px">
    <?php if($this->Paginator->param('count') > 0 ){?>
    <div class="total_pag col-lg-2 col-xs-6 no-padding">
        Total: <b><?php echo $this->Paginator->param('count')?></b>.             
    </div>
    <div class="pagina_select col-lg-2 col-xs-6 no-padding form-group">
        <?php
            $limit = (isset($this->params->query['limit'])) ? $this->params->query['limit'] : '6';
            $options = array(6 => '6', 12 => '12', 18 => '18', 24 => '24');

            echo $this->Form->create(array('type' => 'get'));
        ?>
        <label>Show</label>
        <?php
            echo $this->Form->select('limit', $options, array(
                'value' => $limit,
                'default' => 10,
                'empty' => FALSE,
                'onChange' => 'this.form.submit();',
                'name' => 'limit'
                    )
            );
            echo $this->Form->end();
        ?>
    </div>
    <?php }?>
    <div class="col-lg-8 col-xs-12 no-padding">
        <?php if($this->Paginator->numbers()){?>
        <ul class="pagination pull-right">
            <?php
                echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            ?>
        </ul>
        <?php }?>
    </div>
    
</div>
