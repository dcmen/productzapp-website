<div class="main-page">
    <?php // echo $this->element('cz_breadcrumb'); ?>
    <?php // echo $this->element('cz_title_page'); ?>
    
    <?php echo $this->element('cz_menu_bar_customer'); ?>
    <div class="mg-bottom-25 clearfix"></div>
    
    <div id="CustomerPage" class="pd-content-01">
        <div class="col-lg-12">
            <?php if(count($list)>0) : ?>
            <div class="wg-box-shadow data-content" style="padding: 30px 20px 40px;">
                <div id="CustomerTable" class="table-responsive col-xs-12" data-pattern="priority-columns">
                    <table cellspacing="0" id="tech-companies-1" class="table customer">
                        <thead>
                            <th><input type="checkbox" id="checkall" name="sa"  value=""></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th class="text-right">Actions</th>
                        </thead>
                        <tbody class="result_search">
                            <?php foreach($list as $rs) : ?>
                            <tr>
                                <td><input type="checkbox" class="check" name="ar_id[]" value="<?php echo $rs->_id?>" <?php if(isset($rs->is_owner) && $rs->is_owner == 1) { echo "disabled"; }?> ></td>
                                <td><?php echo $rs->full_name?></td>
                                <td><?php echo $rs->email?></td>
                                <td><?php echo $rs->phone?></td>
                                <td align="right">
                                    <?php if(isset($rs->is_owner) && $rs->is_owner == 0){?>
                                    <a href="javascript:;" class="editcustomer" title="Edit" data_id="<?php echo $rs->_id?>"><i class="fa fa-pencil-square-o color-orange"></i></a>
                                    <a href="<?php echo $this->Html->Url('/customer_del/'.$rs->_id)?>" title="Remove" class="del_customer"><i class="fa fa-times color-red"></i></a>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="total-datatable"><span>Total:</span> <strong class="total-count"><?php echo count($list) ?></strong></div>

                <div class="clearfix"></div>
            </div>
            <?php endif; ?>

            <div class="msg-no-data mg-top-50 text-center font-size-24 <?php echo (count($list)>0)? 'dis-none' : '' ?>"><span>No data to display</span></div>    
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
                    <form id="CustomerAdd" method="post" class="form-horizontal" action="customer">
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="type" value="add" />
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>

<script type="text/javascript">
    Vcore.Customer();
    
    $(document).ready(function() {
        $('#addcustomer .close').click(function () {
            $('#CustomerAdd').trigger('reset');
            $('#CustomerAdd').formValidation('updateStatus', 'full_name', 'NOT_VALIDATED')
                        .formValidation('updateStatus', 'email', 'NOT_VALIDATED')
                        .formValidation('updateStatus', 'phone', 'NOT_VALIDATED');
        });
        
        $('.editcustomer').click(function() {
            id = $(this).attr('data_id');
            load_show();
            $.get(root + 'editcustomer/'+id,function(data){
                load_hide();
                $("#myModal").html(data);
                $('#myModal').modal('show');
            });
        });
        
        $('#CustomerAdd').formValidation({
            framework: 'bootstrap',
            message: 'This value is not valid',
            fields: {
                full_name: {
                    validators: {
                        notEmpty: {
                            message: 'The full name is required and can\'t be empty'
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
        });
    });
</script>