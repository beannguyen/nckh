<br />
<?php
    if ($total == 0)
    {
        $cnpm = $httt = $mmt = $duoc_dk = $bihuy = 0;
    }
    else
    {
        $cnpm = round(($query_tk_detai['1']/$total)*100,2);
        $httt = round(($query_tk_detai['2']/$total)*100,2);
        $mmt = round(($query_tk_detai['3']/$total)*100,2);
        $duoc_dk = round(($count_detai_dangky/$total)*100,2);
        $bihuy = 100 - $duoc_dk;
    }
?>
<div class="row">
    <div class="col-md-7" style="text-align: center!important;">
        <canvas class="img-responsive" id="canvas_detai" height="320" width="320"></canvas>
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
        		];
        	var options = {
        		tooltips: {
        			fontSize: '75.4%'
        		}
        	};
        var myChart = new Chart(document.getElementById("canvas_detai").getContext("2d"), options);
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
            <a href="javascript:void();" class="list-group-item">Công Nghệ Phần Mềm<span class="badge" style="background-color: #2ecc71;"><?php echo $query_tk_detai['1'] ?> ĐT</span></a>
            <a href="javascript:void();" class="list-group-item">Hệ Thống Thông Tin<span class="badge" style="background-color: #e74c3c;"><?php echo $query_tk_detai['2'] ?> ĐT</span></a>
            <a href="javascript:void();" class="list-group-item">Mạng Máy Tính<span class="badge" style="background-color: #8e44ad;"><?php echo $query_tk_detai['3'] ?> ĐT</span></a>
            <a href="javascript:void();" class="list-group-item">Tổng Cộng<span class="badge"><?php echo $total ?> ĐT</span></a>
        </div>
    </div>    
</div>
<hr />
<div class="row">
    <div class="col-md-7" style="text-align: center!important;">
        <canvas class="img-responsive" id="canvas_detai_bihuy" height="320" width="320"></canvas>
        <script>
        	var pieData = [
        			{
        				value : <?php echo $bihuy ?>,
        				color : "#e74c3c",
        				label : '<?php echo $bihuy.' %' ?>',
        				labelColor : 'white',
        				labelFontSize : '100%',
        				labelAlign : 'center',
        			},
        			{
        				value : <?php echo $duoc_dk ?>,
        				color : "#3498db",
        				label : '<?php echo $duoc_dk.' %' ?>',
        				labelColor : 'white',
        				labelFontSize : '100%',
        				labelAlign: 'center',
        			},                
        		];
        	var options = {
        		tooltips: {
        			fontSize: '75.4%'
        		}
        	};
        var myChart = new Chart(document.getElementById("canvas_detai_bihuy").getContext("2d"), options);
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
            <a href="javascript:void();" class="list-group-item">Đề tài có SV đăng ký<span class="badge" style="background-color: #3498db;"><?php echo $count_detai_dangky ?> ĐT</span></a>
            <a href="javascript:void();" class="list-group-item">Đề tài bị hủy<span class="badge" style="background-color: #e74c3c;"><?php echo ($total-$count_detai_dangky) ?> ĐT</span></a>
            <a href="javascript:void();" class="list-group-item">Tổng Cộng<span class="badge"><?php echo $total ?> ĐT</span></a>
        </div>
    </div>    
</div>