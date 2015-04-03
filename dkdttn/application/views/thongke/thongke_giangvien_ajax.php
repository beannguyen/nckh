<?php
$labels = '';
$data_1 = $data_2 = '';
for ($i=0;$i<=count($query_tk_giangvien);$i++)
{
     $labels .= '"'.trim($query_tk_giangvien['ten_cauhinh'][$i]).'"'.',';
     $data_1   .= round(($query_tk_giangvien['value'][$i]/$tong_detai_gv)*100,2).',';
     $data_2   .= round(($query_tk_giangvien['tong_detai'][$i]/$tong_detai)*100,2).',';
}
$labels .= '"Total"';
$data_1 .= round(($tong_detai_gv/$tong_detai)*100,2);
$data_2 .= round(($tong_detai/$tong_detai)*100,2);
?>
<br />
<div class="row">
    <div class="col-md-7">
        <canvas class="img-responsive" id="canvas_gv" height="450" width="480"></canvas>
        <script>
        	var barChartData = {
        		labels : [<?php echo $labels; ?>
                ],
        		datasets : [
        			{
        				fillColor : "rgba(220,220,220,0.5)",
        				strokeColor : "rgba(220,220,220,1)",
        				data : [<?php echo $data_1 ?>]
        			},
                    {
        				fillColor : "rgba(151,187,205,0.5)",
        				strokeColor : "rgba(151,187,205,1)",
        				data : [<?php echo $data_2 ?>]
        			}
        		]
        		
        	}
            var options = {
                scaleShowLabels : true,
                barValueSpacing : 5,
                barDatasetSpacing : 1,
            };
        var myLine = new Chart(document.getElementById("canvas_gv").getContext("2d")).Bar(barChartData,options);
        </script>
    </div>
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Chú thích</h4>
            </div>
            <?php for ($i=0;$i<=count($query_tk_giangvien);$i++): ?>
                <a href="javascript:void();" class="list-group-item">
                    <?php echo $query_tk_giangvien['ten_cauhinh'][$i] ?>
                    <span class="badge green"><?php echo $query_tk_giangvien['tong_detai'][$i] ?> </span>
                    <span class="badge red"><?php echo $query_tk_giangvien['value'][$i] ?></span>
                </a>
            <?php endfor; ?>
            <a href="javascript:void();" class="list-group-item">
                Total
                
                <span class="badge green"><?php echo $tong_detai ?></span>
                <span class="badge red"><?php echo $tong_detai_gv ?> </span>
            </a>
        </div>
    </div>
</div>