<div class="ridbon">
    <?php echo $this->Html->image('/images/search_plus.png')?>
     My customers
</div>
<div class="wrap_content">
    <div id="Cars_for_sale">
        <div class="countcars"></div>
        <div class="tabbable">
            <div id="customers">
                <div class="search" style="margin-bottom: 30px;">
                    <input type="text" placeholder="Search" autocomplete="off" id="key" name="keysearch" value="<?php echo $keyword;?>">
                    <input type="button" class="submit_search_customer" value="">
                </div>
                <div class="col-lg-2 col-lg-offset-10 col-xs-6 form-group">
                    <a class="btn btn-view col-xs-12"  href="javascript:;" data-toggle="modal" data-target="#addcustomer">Add</a>
                </div>
                <div>
                    <table class="customer">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </thead>
                        <tbody class="result_search">
                            <?php 
                            $i=0;
                            foreach($list as $rs):?>
                            <tr class="row<?=$i?>">
                                <td><?php echo $rs->name?></td>
                                <td><?php echo $rs->email?></td>
                                <td><?php echo $rs->phone?></td>
                                <td align="center">
                                    <a href="javascript:;" class="add_customer_search" data-name="<?php echo $rs->name?>" data-email="<?php echo $rs->email?>" data-phone="<?php echo $rs->phone?>"><i class="material-icons">add</i></a>
                                </td>
                            </tr>
                            <?php 
                            $i=1-$i;
                            endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="addcustomer" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Customer</h4>
                </div>
                <div class="modal-body">
                    <form id="CustomerAdd" method="post" class="form-horizontal">
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <div class="col-lg-3"><label>Full name</label></div>
                            <div class="col-lg-9"><input type="text" class="form-control" name="full_name" value=""></div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3"><label>Email</label></div>
                            <div class="col-lg-9"><input type="text" class="form-control" name="email" value=""></div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3"><label>Phone</label></div>
                            <div class="col-lg-9"><input type="text" class="form-control"  name="phone" value=""></div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-view close_pop">Save</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
   </div>
</div>

<script type="text/javascript">
    Vcore.Customer(); 
    Vcore.Popup();
    $('#CustomerAdd').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            full_name: {
                validators: {
                    notEmpty: {
                        message: 'The full_name is required and can\'t be empty'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'The phone is required and can\'t be empty'
                    },
                    regexp: {
                        regexp: /^[0-9+]+$/,
                        message: 'The value is not valid phone number'
                    },
                    stringLength: {
                        min: 6,
                        max: 20,
                        message: 'Phone number must be between 6-20 characters in length'
                    }
                }
            } 
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        var $form = $(e.target),
        validator = $form.data('bootstrapValidator');
        load_show();
        $.post(root + 'addcustomer', $form.serialize(),function(data){
            if(data.error == 0){
                window.location.href = root + 'customer';
            }else{
                jAlert(data.msg,'Messages');
            }
            load_hide();
        },'json');
    });
    $(".add_customer_search").click(function(){
        name = $(this).attr('data-name');
        email = $(this).attr('data-email');
        phone = $(this).attr('data-phone');
        
        jConfirm('Are you sure want to add this customer?','Message', function(r) {
          if(r){
                load_show();
                $.post(root + 'cars/addcustomer_ajax',{'full_name': name,'phone': phone,'email': email},function(data){
                    if(data.error == 0){
                        window.location.href = root + 'cars/redirectCustomerAfterAddSuccess';
                    }else{
                        showMessage(data.msg, 1);
                    }
                    load_hide();
                },'json');
          }
          return false;
        });
        
    });
</script>