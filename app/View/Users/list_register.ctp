<div class="panel">
    <!--search and filter location-->
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12 no-padding">
            <form action="<?php echo $this->Html->Url('/users/list_register')?>" method="get">
                <div class="col-md-4 no-padding-left">
                    <label>Enter key:</label>
                    <input class="form-control keyword" placeholder="First Name, Last Name, Email, Phone" type="text" name="key" autocomplete="false" value="<?php echo ($keyword != '')?$keyword:''?>">
                </div>
                <div class="col-md-4 btn_control text-right pull-right no-padding" style="margin-top: 21px">
                    <input type="submit" value="Search" class="btn btn-view searchuser">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($keyword != '')?'':'style="display: none"'?>>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="ListRegisterTable" class="tablesorter table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <!--first name-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('first_name', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                First name 
                                <?php if($fieldsort == 'first_name') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--last name-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('last_name', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Last name
                                <?php if($fieldsort == 'last_name') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--email-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('email', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Email
                                <?php if($fieldsort == 'email') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--phone-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('phone', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Phone 
                                <?php if($fieldsort == 'phone') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--action-->
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="body-list-register">
                    <?php if ($list) : ?>
                        <?php $i = $limit * ($page - 1); ?>
                        <?php foreach($list as $rs) : $i++ ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $rs->first_name ?></td>
                            <td><?php echo $rs->last_name ?></td>
                            <td><?php echo $rs->email ?></td>
                            <td><?php echo $rs->phone ?></td>
                            <td>
                                <a data-container="body" data-original-title="Del" href="<?php echo $this->Html->Url('/users/del_user_register?email='.$rs->email.'&page='.$page)?>" data-toggle="tooltip" class="btn btn-xs btn-danger add-tooltip delete_record"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="6">Not found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
            <div class="row" style="margin: 20px 0 0;font-size: 13px; float: right">
                <div class="total_pag">
                    Total: <b><?php echo $total?></b>.             
                </div>
                <?php if($total > $limit) : ?>
                <div class="pagina_select col-lg-2 col-xs-6 no-padding form-group">
                    <label>Show</label>
                    <select id="ViewLimit" onchange="limitViewChange();">
                        <option value="20" <?php echo ($limit == 20)? 'selected' : '' ?> >20</option>
                        <option value="50" <?php echo ($limit == 50)? 'selected' : '' ?> >50</option>
                        <option value="100" <?php echo ($limit == 100)? 'selected' : '' ?> >100</option>
                        <option value="200" <?php echo ($limit == 200)? 'selected' : '' ?> >200</option>
                    </select>
                </div>
                <div class="pagecars pull-right"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function createLink(linkBase, parameters) {
        str = '';
        $.each(parameters, function(key, val) {
            str = str + key + '=' + val + '&';
        });
        str = str.replace(/^\&+|\&+$/g, '');
        
        return linkBase.replace(/^\?+|\?+$/g, '') + '?' + str;
    }
    function limitViewChange() {
        limit = $('#ViewLimit').val();
        parasOnLink.limit = limit;
        parasOnLink.page = 1;
        window.location.href = createLink(linkCurPage, parasOnLink);
    }
    
    $(document).ready(function() {
        $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: <?php echo $page?>,
            maxVisible: 5,
            leaps: true
        }).on("page", function(event, num){
            parasOnLink.page = num;
            window.location.href = createLink(linkCurPage, parasOnLink);
        });

        $(".keyword").keydown(function(){
            $(".reset_text").show();
        });
        $(".type").change(function(){
            $(".reset_text").show();
        });
        $(".reset_text").click(function(){
            window.location.href = linkCurPage;
        });
        
        $('.btn-action-delete').click(function () {
            
        });
    });
    
</script>