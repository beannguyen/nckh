<script type="text/javascript" src="<?php echo base_url('public/js/Chart.js') ?>"></script>
<br />
<?php
if ($total == 0)
{
    $cnpm = $httt = $mmt = $sp = 0;
}
else 
{
    $cnpm = round(($query['1']/$total)*100,2);
    $httt = round(($query['2']/$total)*100,2);
    $mmt = round(($query['3']/$total)*100,2);
    $sp = round(($query['5']/$total)*100,2);
}
?>
<div class="row">
    <div class="col-md-7" style="text-align: center!important;">
        <canvas class="img-responsive" id="canvas_sv" height="320" width="320"></canvas>
        <script>
        	var pieData = [
        			{
        				value : <?php echo $cnpm ?>,
        				color : "#2ecc71",
        				label : '<?php echo $cnpm.' %' ?>',
        				labelColor : 'white',
        				labelFontSize : '100%',
        				labelAlign : 'center',
        			},
        			{
        				value : <?php echo $httt ?>,
        				color : "#e74c3c",
        				label : '<?php echo $httt.' %' ?>',
        				labelColor : 'white',
        				labelFontSize : '100%',
        				labelAlign: 'center',
        			},
        			{
        				value : <?php echo $mmt ?>,
        				color : "#8e44ad",
        				label : '<?php echo $mmt.' %' ?>',
        				labelColor : 'white',
        				labelFontSize : '100%',
                        labelAlign : 'center',
        			},
                    {
        				value : <?php echo $sp ?>,
        				color : "#f39c12",
        				label : '<?php echo $sp.' %' ?>',
        				labelColor : 'white',
        				labelFontSize : '100%',
                        labelAlign : 'center',
        			},
                    
        		];
        	var options = {
        		tooltips: {
        			fontSize: '75.4%'
        		}
        	};
        var myChart = new Chart(document.getElementById("canvas_sv").getContext("2d"), options);
        var myPie = myChart.Pie(pieData, {
        	animationSteps: 100,
        	animationEasing: 'easeOutBounce'
        });
        </script>
    </div>
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Chú thích</h4>
            </div>
            <a href="javascript:void();" class="list-group-item">Công Nghệ Phần Mềm<span class="badge" style="background-color: #2ecc71;"><?php echo $query['1'] ?> SV</span></a>
            <a href="javascript:void();" class="list-group-item">Hệ Thống Thông Tin<span class="badge" style="background-color: #e74c3c;"><?php echo $query['2'] ?> SV</span></a>
            <a href="javascript:void();" class="list-group-item">Mạng Máy Tính<span class="badge" style="background-color: #8e44ad;"><?php echo $query['3'] ?> SV</span></a>
            <a href="javascript:void();" class="list-group-item">Sư Phạm<span class="badge" style="background-color: #f39c12;"><?php echo $query['5'] ?> SV</span></a>
            <a href="javascript:void();" class="list-group-item">Tổng Cộng<span class="badge"><?php echo $total ?> SV</span></a>
        </div>
    </div>    
</div>