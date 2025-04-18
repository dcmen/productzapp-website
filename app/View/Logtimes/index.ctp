<div style="width: 100%;margin: 20px 0">
<fieldset>
    <legend>Search</legend>
    <form action="<?php echo $this->Html->Url('/logtimes')?>" method="get">
        Date star:
        <input type="text" name="date_star" id="date_star" value="<?php echo ($date_star)?date('d-m-Y',$date_star):''?>">
        Date end:
        <input type="text" name="date_end" id="date_end" value="<?php echo ($date_end)?date('d-m-Y',$date_end):''?>">
        <input type="submit" value="Search">
    </form>
</fieldset>
</div>
<?php
$array_date = array();
$str_data_0 = '';
$str_data_1 = '';
$str_data_2 = '';
$k = '';

for ($i = $date_star; $i <= $date_end;$i = $i + 86400) {
    $array_date[] = $i;
    $str_0 = $this->requestAction('Logtimes/CountLoginTime/'.$i.'/1');
    $str_data_0 .= '0,'.$str_0.',';
    $str_1 = $this->requestAction('Logtimes/CountLoginTime/'.$i.'/2');
    $str_data_1 .= '0,'.$str_1.',';
    $str_2 = $this->requestAction('Logtimes/CountLoginTime/'.$i.'/3');
    $str_data_2 .= '0,'.$str_2.',';
}
$str_day = '';

foreach ($array_date as $d) {
    $date = date("d/m/Y",$d);
    $str_day .= '\'' . $date . '\'' . ',';
}
$arr_day = substr($str_day, 0, -1);
?>
<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            title: {
                text: 'Monthly Average Temperature',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: WorldClimate.com',
                x: -20
            },
            xAxis: {
                categories: [<?php echo $arr_day;?>],
                title: {
                    text: 'Day'
                }
            },
            yAxis: {
                title: {
                    text: 'Temperature (/person)'
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            tooltip: {
                valueSuffix: '/person'
            },
      
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                    name: 'IOS',
                    data: [<?php echo $str_data_0?>]
                }, {
                    name: 'Android',
                    data: [<?php echo $str_data_1?>]
                }, {
                    name: 'Web',
                    data: [<?php echo $str_data_2?>]
                }]
        });
    });
     $('#date_star').datepicker({
         timePicker: true,
         timePickerIncrement: 15,
         format: 'dd-mm-yyyy'
     });
     $('#date_end').datepicker({
         timePicker: true,
         timePickerIncrement: 15,
         format: 'dd-mm-yyyy'
     });
</script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<?php
echo $this->Html->script(
        array(
            'highcharts',
            'exporting'
        )
);
?>