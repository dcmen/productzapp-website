<div class="panel">
    <!--search and filter location-->
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12 no-padding">
            <form action="<?php echo $this->Html->Url('/emailcontents/list_email')?>" method="get">
                <div class="col-md-5 no-padding-left">
                    <label>Enter key:</label>
                    <input class="form-control keyword" type="text" name="key" placeholder="Keyword,Name,Subject" autocomplete="false" value="<?php echo ($keyword != '')?$keyword:''?>">
                </div>
                <div class="col-md-4 btn_control text-right pull-right no-padding" style="margin-top: 21px">
                    <input type="submit" value="Search" class="btn btn-view searchuser">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($keyword != '')?'':'style="display: none"'?>>
                    <a class="btn btn-view" href="<?php echo $this->Html->Url('/emailcontents/add_email') ?>">Add</a>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="ListCarTable" cellspacing="0" class="tablesorter table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <!--keyword-->
                        <th>
                            Keyword
                        </th>
                        <!--name-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('name', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Name 
                                <?php if($fieldsort == 'name') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--subject-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('subject', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Subject
                                <?php if($fieldsort == 'subject') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--content-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('content', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Content 
                                <?php if($fieldsort == 'content') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--action-->
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="body-list-car">
                    <?php if ($list) : ?>
                        <?php $i = $limit * ($page - 1); ?>
                        <?php foreach($list as $rs) : $i++ ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $rs->key ?></td>
                            <td><?php echo $rs->name ?></td>
                            <td><?php echo $rs->subject ?></td>
                            <td><div style="overflow-y: auto; max-height: 140px;"><?php echo $rs->content ?></div></td>
                            <td>
                                <!--<a title="View" href="<?php // echo $this->Html->Url('/emailcontents/view_email/'.$rs->_id)?>"><i class="fa fa-eye"></i></a>-->
                                <a title="Edit" href="<?php echo $this->Html->Url('/emailcontents/edit_email/'.$rs->_id)?>"><i class="fa fa-edit"></i></a>
                                <a title="Delete" href="javascript:;" class="btn-delete" data-id="<?php echo $rs->_id ?>"><i class="fa fa-times" style="color: red; font-size: 15px;"></i></a>
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
    
    function sort_head(fieldsort, sort){
//        parasOnLink.fieldsort = fieldsort;
//        parasOnLink.sort = sort;
//        
//        window.location.href = createLink(linkCurPage, parasOnLink);
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
        
        $(".btn-delete").click(function(){
            idEmailContent = $(this).attr('data-id');
            jConfirm('Are you sure you want to delete this email content?','Message',function(r) {
                if(r){
                    load_show();
                    parasOnLink.id = idEmailContent;
                    window.location.href = createLink(root + 'emailcontents/delete_email', parasOnLink);
                }
            });
            return false;
        });
    });
</script>