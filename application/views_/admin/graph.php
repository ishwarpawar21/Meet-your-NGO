<script language="javascript">
$(document).ready(function(){
if (jQuery.plot) {
        //define placeholder class
        var placeholder = $("#visitors-chart");
         if ($(placeholder).size() == 0) {
            //return;
        }
		//some data
        var d1 = [
		  <?php 
		  for($i=1;$i<13;$i++)
		  { 
		    $getrecords=$this->db->query('SELECT SUM(count) FROM tbl_visitor_master WHERE month(visit_date)='.$i.'');
	        $getcount=$getrecords->result_array(); 
		    if($getcount[0]['SUM(count)']!=0){$getsum=$getcount[0]['SUM(count)'];}else{$getsum=0;}
		  ?>
		   [<?php echo $i; ?>,<?php echo $getsum; ?>],
   <?php } ?>
		   ];
        var d2 = [
            
        ];
        var chartColours = ['#88bbc8', '#ed7a53', '#9FC569', '#bbdce3', '#9a3b1b', '#5a8022', '#2c7282'];
        //graph options
        var options = {
                grid: {
                    show: true,
                    aboveData: true,
                    color: "#3f3f3f" ,
                    labelMargin: 5,
                    axisMargin: 0, 
                    borderWidth: 0,
                    borderColor:null,
                    minBorderMargin: 5 ,
                    clickable: true, 
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 20
                },
                series: {
                    grow: {
                        active: false,
                        stepMode: "linear",
                        steps: 50,
                        stepDelay: true
                    },
                    lines: {
                        show: true,
                        fill: true,
                        lineWidth: 3,
                        steps: false
                        },
                    points: {
                        show:true,
                        radius: 4,
                        symbol: "circle",
                        fill: true,
                        borderColor: "#fff"
                    }
                },
                legend: { 
                    position: "ne", 
                    margin: [0,-25], 
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function(label, series) {
                        // just add some space to labes
                        return label+'&nbsp;&nbsp;';
                     }
                },
                yaxis: { min: 0 },
                xaxis: {ticks:11, tickDecimals: 0},
                colors: chartColours,
                shadowSize:1,
                tooltip: true, //activate tooltip
                tooltipOpts: {
                    content: "%s : %y.0",
                    defaultTheme: false,
                    shifts: {
                        x: -30,
                        y: -50
                    }
                }
            };
        $.plot(placeholder, [
            {
                label: "Visits", 
                data: d1,
                lines: {fillColor: "#f2f7f9"},
                points: {fillColor: "#88bbc8"}
            }

        ], options);
    }
	});
</script>