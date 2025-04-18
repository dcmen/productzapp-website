<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            </div>
            <div class="title_right">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <!-- top tiles -->
            <div class="row tile_count">
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                    <div class="count">2500</div>
                    <span class="count_bottom"><i class="green">4% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
                    <div class="count">123.50</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
                    <div class="count green">2,500</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
                    <div class="count">4,567</div>
                    <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
                    <div class="count">2,315</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
                    <div class="count">7,325</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                </div>
            </div>
            <!-- /top tiles -->
            <!--Search form-->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group form_search">
                    <form id="SearchUser" method="get">
                        <div class="col-lg-3" style="padding: 0px 0px 0px 4px;;">
                            <label for="sel1">Flatform</label>
                            <select name="type" class="form-control">
                                <option>All</option>
                                <option>New registration</option>
                                <option>Email verified</option>
                                <option>Admin approved</option>
                                <option>Blocked</option>
                            </select>

                        </div>
                        <div class="col-lg-3" style="padding: 0px 0px 0px 4px;;">
                            <label for="sel1">Version</label>
                            <select name="type" class="form-control">
                                <option>All</option>
                                <option>New registration</option>
                                <option>Email verified</option>
                                <option>Admin approved</option>
                                <option>Blocked</option>
                            </select>

                        </div>
                        <div class="view_search col-lg-4" >
                            <div class="col-lg-12" style="padding: 0px;">
                                <div class="col-lg-6" style="padding: 0px 3px 0px 2px;">
                                    <label>Start date</label>
                                    <input type="text" value="" class="form-control date" id="date_from" name="date_from">
                                </div>
                                <div class="col-lg-6" style="padding: 0px 2px 0px 3px;">
                                    <label>End date</label>
                                    <input type="text" value="" class="form-control date" id="date_to" name="date_to">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-2 btn_control text-right" style="margin-top: 24px; ">
                            <input type="submit" value="Refresh" class="btn btn-view searchuser">
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
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <i class="fa fa-bars" aria-hidden="true" style="margin: 10px 0;"></i>
                        </div>
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
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <i class="fa fa-bars" aria-hidden="true" style="margin: 10px 0;"></i>
                        </div>
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
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <i class="fa fa-bars" aria-hidden="true" style="margin: 10px 0;"></i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="graph_bar1" style="width:100%; height:280px;"></div>
                    </div>
                </div>
            </div>
            <!-- /bar charts -->
            <!--table-->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-12" style="text-align: center">
                            <h2>Last 20 days report the number user open<h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!--/table-->

        </div>
    </div>
</div>
<!-- morris.js -->
<script>
    $(document).ready(function() {
        Morris.Bar({
            element: 'graph_bar',
            data: [
                {device: 'iPhone 4', geekbench: 1380},
                {device: 'iPhone 4S', geekbench: 655},
                {device: 'iPhone 3GS', geekbench: 275},
                {device: 'iPhone 5', geekbench: 1571},
                {device: 'iPhone 5S', geekbench: 655},
                {device: 'iPhone 6', geekbench: 2154},
                {device: 'iPhone 6 Plus', geekbench: 1144},
                {device: 'iPhone 6S', geekbench: 2371},
                {device: 'iPhone 6S Plus', geekbench: 1471},
                {device: 'Other', geekbench: 1371}
            ],
            xkey: 'device',
            ykeys: ['geekbench'],
            labels: ['Geekbench'],
            barRatio: 0.4,
            barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
            xLabelAngle: 35,
            hideHover: 'auto',
            resize: true
        });
        Morris.Bar({
            element: 'graph_bar1',
            data: [
                {device: 'iPhone 4', geekbench: 380},
                {device: 'iPhone 4S', geekbench: 655},
                {device: 'iPhone 3GS', geekbench: 275},
                {device: 'iPhone 5', geekbench: 1571},
                {device: 'iPhone 5S', geekbench: 655},
                {device: 'iPhone 6', geekbench: 2154},
                {device: 'iPhone 6 Plus', geekbench: 1144},
                {device: 'iPhone 6S', geekbench: 2371},
                {device: 'iPhone 6S Plus', geekbench: 1471},
                {device: 'Other', geekbench: 1371}
            ],
            xkey: 'device',
            ykeys: ['geekbench'],
            labels: ['Geekbench'],
            barRatio: 0.4,
            barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
            xLabelAngle: 35,
            hideHover: 'auto',
            resize: true
        });

        Morris.Line({
            element: 'graph_line',
            xkey: 'year',
            ykeys: ['value'],
            labels: ['Value'],
            hideHover: 'auto',
            lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
            data: [
                {year: '2012', value: 20},
                {year: '2013', value: 10},
                {year: '2014', value: 5},
                {year: '2015', value: 5},
                {year: '2016', value: 20}
            ],
            resize: true
        });

        $MENU_TOGGLE.on('click', function() {
            $(window).resize();
        });
    });

</script>
<!-- /morris.js -->
<script>
    $('#date_from').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        enableOnReadonly: true,
    }).on('changeDate', function (e) {
        $('input[name="date_from"]').datepicker('setStartDate', $('input[name="date_from"]').datepicker('getDate'));
        var startDate = new Date($('#date_from').val());
        var endDate = new Date($('#date_to').val());
        if (startDate > endDate){
            // Do something
            jAlert("Date (from) must be less than date (to)");
            $("input[name='date_from']").val('');
        }
    });
    $('#date_to').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        enableOnReadonly: true,
    }).on('changeDate', function (e) {
        $('input[name="date_to"]').datepicker('setEndDate', $('input[name="date_to"]').datepicker('getDate'));
        var startDate = new Date($('#date_from').val());
        var endDate = new Date($('#date_to').val());
        if (startDate > endDate){
            // Do something
            jAlert("Date (from) must be less than date (to)");
            $("input[name='date_to']").val('');
        }
    });
    //

</script>