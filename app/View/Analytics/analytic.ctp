<style type="text/css">
    .x_panel {
        min-height: 350px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <!-- top tiles -->
            <div class="row tile_count">
                <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i>  Users</span>
                    <div
                        class="count"><?php echo isset($result1) && $result1 ? $result1->user_download_app : '' ?></div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-clock-o"></i> Sessions</span>
                    <div class="count"><?php echo isset($result1) && $result1 ? $result1->total_session : '' ?></div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Screen views</span>
                    <div
                        class="count green"><?php echo isset($result1) && $result1 ? $result1->total_screent : '' ?></div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Screeen/Session</span>
                    <div
                        class="count"><?php echo isset($result1) && $result1 ? $result1->total_screent_div_session : '' ?></div>
                </div>
            </div>
            <!-- /top tiles -->
            <!--Search form-->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <form id="refreshanalytics">
                        <div class="col-lg-3" style="padding: 0px 0px 0px 4px;;">
                            <label for="sel1">Flatform</label>
                            <select id="platform" class="form-control">
                                <option value="all">All</option>
                                <option value="ios">IOS</option>
                                <option value="android">ANDROID</option>
                                <option value="web">WEB</option>
                            </select>

                        </div>
                        <div class="col-lg-3" style="padding: 0px 0px 0px 4px;;">
                            <label for="sel1">Version</label>
                            <select id="version" class="form-control">
                                <option value="all">All</option>
                                <option value="2.1.2">2.1.2</option>
                                <option value="2.1.3">2.1.3</option>
                            </select>
                        </div>
                        <div class="view_search col-lg-4">
                            <div class="col-lg-12" style="padding: 0px;">
                                <div class="col-lg-6" style="padding: 0px 3px 0px 2px;">
                                    <label>Start date</label>
                                    <input type="text" value="" class="form-control date" id="date_from"
                                           name="date_from">
                                </div>
                                <div class="col-lg-6" style="padding: 0px 2px 0px 3px;">
                                    <label>End date</label>
                                    <input type="text" value="" class="form-control date" id="date_to" name="date_to"
                                           data-date="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 btn_control text-right" style="margin-top: 24px; ">
                            <button type="submit" class="btn btn-view btn-refreshanalytic">Refresh</button>
                        </div>
                    </form>

                </div>
            </div>
            <!--/Search form-->
            <!-- bar chart -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-1">
                            <h2><i class="fa fa fa-square-o" aria-hidden="true"> Total</i></h2>
                        </div>
                        <div class="col-lg-10" style="text-align: center">

                            <h2>New user<h2>
                        </div>
<!--                        <div class="col-md-1 col-sm-1 col-xs-12">-->
<!--                            <i class="fa fa-bars" aria-hidden="true" style="margin: 10px 0;"></i>-->
<!--                        </div>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="graph_bar" style="width:100%; height:280px;"></div>
                    </div>
                </div>
            </div>
            <!-- /bar charts -->
            <!-- line graph -->
            <div class="col-md-12  col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-1">
                            <h2><i class="fa fa-hand-o-right" aria-hidden="true"> Daily</i></h2>
                        </div>
                        <div class="col-lg-10" style="text-align: center">
                            <h2>Session count<h2>
                        </div>
<!--                        <div class="col-md-1 col-sm-1 col-xs-12">-->
<!--                            <i class="fa fa-bars" aria-hidden="true" style="margin: 10px 0;"></i>-->
<!--                        </div>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content2">
                        <div id="graph_line" style="width:100%; height:300px;"></div>
                    </div>
                </div>
            </div>
            <!-- /line graph -->
            <!-- bar chart -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-1">
                            <h2><i class="fa fa fa-square-o" aria-hidden="true"> Total</i></h2>
                        </div>
                        <div class="col-lg-10" style="text-align: center">
                            <h2>Screens/Session<h2>
                        </div>
<!--                        <div class="col-md-1 col-sm-1 col-xs-12">-->
<!--                            <i class="fa fa-bars" aria-hidden="true" style="margin: 10px 0;"></i>-->
<!--                        </div>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content2">
                        <div id="graph_bar1" style="width:100%; height:280px;"></div>
                    </div>
                </div>
            </div>
            <!-- /bar charts -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-12" style="text-align: center">
                            <h2>Report the number user open from <span id="dtfrom"></span> to <span id="dtto"></span>
                                <h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content table-responsive">
                        <table id="rendertable" style="table-layout: fixed;" class="table table-striped rendertableclc">
                        </table>


                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- morris.js -->
<script>

</script>
<!-- /morris.js -->
<script>

    var load_screent = <?php echo json_encode($data['screent_div_session_count']); ?>;
    var load_newuser = <?php echo json_encode($data['newuser_count']); ?>;
    var load_session = <?php echo json_encode($data['session_count']); ?>;
    var load_screent_view_first = <?php echo json_encode($data['analytics_screent_view'][0]); ?>;
    var load_screent_view = <?php echo json_encode($data['analytics_screent_view']); ?>;
    /**
     * @Hung
     */
    function renderautotable(load_screent_view_first, load_screent_view) {
        var html = '<tr>';
        $.each(load_screent_view, function (id, post) {
            html += '<th style="width:30px;" >' + post +'<th>';
        });
        var html = '<thead>';
        html += '<th style="width:30px;">.No</th>';
        html += '<th style="width:100px;">Screen</th>';
        $.each(load_screent_view, function (id, post) {
            html += '<th style="width:80px;text-align:center;" >' + post.day +'<th>';
        });
        html += '</tr>';
        html += '</thead>';
        html += '<tbody><tr>';
        var title = {
            "count_dashboard": "Dash Doard", "count_carforsale": "Car For Sale",
            "count_followcar": "Follow Car", "count_flickar": "Flickar", "count_mynetwork": "My Network",
            "count_mystock": "My Stock", "count_offerboard": "Offer Board"
        };
        var i = 0;
        $.each(load_screent_view_first, function (key, value) {
            if (key != 'day') {
                i++;
                html += '<td style="width:30px;" >' + i;
                html += '</td>'
                html += '<td style="width:30px;" >' + title[key];
                html += '</td>'
                $.each(load_screent_view, function (id, post) {
                    html += '<td style="width:80px;text-align:center;" >' + post[key]+'<td>';
                });
                html += '</tr>';
            }
        });
        html += '</tbody>'
        $("#rendertable").html("");
        $("#rendertable").append(html);
    }
    renderautotable(load_screent_view_first, load_screent_view);

    //GRAPH
    var graph = Morris.Bar({
        element: 'graph_bar1',
        data: datascreen(load_screent),
        xkey: 'day',
        ykeys: ['total'],
        labels: ['Total'],
        barRatio: 0.4,
        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        xLabelAngle: 20,
        hideHover: 'auto',
        resize: true
    });
    function datascreen(screent_div_session_count) {
        var arr = [];
        for (i = 0; i < screent_div_session_count.length; i++) {
            var dataItem = screent_div_session_count[i];
            var item = {day: dataItem.day, total: dataItem.total};
            arr.push(item);
        }
        return arr;
    }
    //GRAPH1
    var graph1 = Morris.Bar({
        element: 'graph_bar',
        data: datanewuser(load_newuser),
        xkey: 'day',
        ykeys: ['total'],
        labels: ['Total'],
        barRatio: 0.4,
        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        xLabelAngle: 20,
        hideHover: 'auto',
        resize: true
    });
    function datanewuser(newuser_count) {
        var arr = [];
        for (i = 0; i < newuser_count.length; i++) {
            var dataItem = newuser_count[i];
            var item = {day: dataItem.day, total: dataItem.total};
            arr.push(item);
        }
        return arr;
    }
    //Line
    var line1 = Morris.Line({
        element: 'graph_line',
        xkey: 'year',
        ykeys: ['total'],
        labels: ['Total'],
        hideHover: 'auto',
        lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        data: datasession(load_session),
        resize: true,
        parseTime: false,
    });
    function datasession(session_count) {
        var arr = [];
        for (i = 0; i < session_count.length; i++) {
            var dataItem = session_count[i];
            var item = {year: dataItem.day, total: dataItem.total};
            arr.push(item);
        }
        return arr;
    }
    $('#platform').change(function () {
        var platform = $(this).val();
    });
    $('#version').change(function () {
        var version = $(this).val();
    });
    $(document).ready(function () {
        //get current day
        var d = new Date();
        var Date_to = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();
        d.setDate(d.getDate() - 15);
        var Date_from = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();
        $('#date_to').val(Date_to);
        $('#date_from').val(Date_from);
        $('#dtfrom').html(Date_from);
        $('#dtto').html(Date_to);


        $('#date_from').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            enableOnReadonly: true,
        }).on('changeDate', function (e) {
            $('input[name="date_from"]').datepicker('setStartDate', $('input[name="date_from"]').datepicker('getDate'));
            var startDate = new Date($('#date_from').val());
            var endDate = new Date($('#date_to').val());
            if (startDate > endDate) {
                // Do something
                jAlert("Date (from) must be less than date (to)");
                $("input[name='date_from']").val('');
            }

        });
        $('#date_to').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            enableOnReadonly: true,
        }).on('changeDate', function (e) {
            $('input[name="date_to"]').datepicker('setEndDate', $('input[name="date_to"]').datepicker('getDate'));
            var startDate = new Date($('#date_from').val());
            var endDate = new Date($('#date_to').val());
            if (startDate > endDate) {
                // Do something
                jAlert("Date (from) must be less than date (to)");
                $("input[name='date_to']").val('');
            }
        });
        //refresh analytics chart
        $('.btn-refreshanalytic').click(function () {
            var startDate = $('#date_from').val();
            var endDate = $('#date_to').val();
            var platform = $('#platform').val();
            var version = $('#version').val();
            load_show();
            $.post(root + 'Analytics/getallanalytic', {
                platform: platform,
                version: version,
                day_from: startDate,
                day_to: endDate
            }, function (data) {
                if (data.error == 0) {
                    load_hide();
                    graph.setData(datascreen(data.screent_div_session_count));
                    graph1.setData(datanewuser(data.newuser_count));
                    line1.setData(datasession(data.session_count));
                    renderautotable(data.analytics_screent_view_first, data.analytics_screent_view);
                    $('#dtfrom').html(startDate);
                    $('#dtto').html(endDate);


                } else {
                    load_hide();
                    showMessage('Failure', 1);
                }
            }, 'json');
            return false;
        });
    });
</script>