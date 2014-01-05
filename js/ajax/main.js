function formatData(obj){
	var data=JSON.parse(obj);
	return data;
}

//===================for each sub diagram====================================================
function drawLine($draw,drawData,flagText)
{
	 $draw.highcharts({
		 chart:{
			 type:"line"
		 },
         title: {
             text: flagText+"："+drawData['TITLE']+"元",
             x: -20 // center
         },
         subtitle: {
             text: drawData['SUBTITLE'],
             x: -20
         },
         xAxis: {
             categories: drawData['CATEGORIES'],
             labels:{step:drawData['STEP'],
            	 rotation:-45}
         },
         yAxis: {
             title: {
                 text: ''
             },
             plotLines: [{
                 value: 0,
                 width: 1,
                 color: '#808080'
             }]
         },
         tooltip: {
             valueSuffix: '元'
         },
         legend: {
             layout: 'vertical',
             align: 'right',
             verticalAlign: 'middle',
             borderWidth: 0
         },
         series:drawData['DATA']
     });	
}

//===================for summary pie====================================================
function drawPie($draw,drawData,flagText)
{
	$draw.highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: flagText+"："+drawData['TITLE']+"元",
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                },
                showInLegend: true
            }
        },
        series: 
        	[{
        		type: 'pie',
        		name: 'Browser share',
        		data:drawData['DATA']
        	}]
    });
}

function drawColumn($draw,drawData,flagText)
{
	//alert(drawData);
	$draw.highcharts({
        chart: {
            type: 'column'
        },
        title: {
        	text: flagText+"："+drawData['TITLE']+"元",
        },
        subtitle: {
            text:drawData['SUBTITLE'],
        },
        xAxis: {
            categories:drawData['CATEGORIES']
        },
        yAxis: {
            min: 0,
            title: {
                text:""
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}元</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series:drawData['DATA']
    });
}

function draw($draw,flag,summary,ajaxLocation){
	var startDate=$draw.parent().find(".from").val();
	var endDate=$draw.parent().find(".to").val();
	var	type=(ajaxLocation==null)?$draw.attr("value"):ajaxLocation;

	$.post("../php/common/buka.php?action="+type,{
		from:startDate,
		to:endDate
	},function(data){
//		if(summary=="12")
//			{
//			alert(data);
//			}
		var drawData=formatData(data);
		var flagText=(flag=="1")?"消费总额":"收入总额";
		$draw.unblock();
		if(summary=="1")
		{
			drawPie($draw,drawData,flagText);
		}
		else if (summary=="12")
		{
			//alert(drawData);
			drawColumn($draw, drawData, flagText);
		}
		else{
			if (startDate == endDate) {
				drawColumn($draw, drawData, flagText);
			} else {
				drawLine($draw, drawData, flagText);
			}
		}
	});
}

function block($var) {
	$var.block({
		message : "<img src='../css/images/icon-loading.gif'/>",
		css : {
			width : "40px",
			heith : "40px",
			border : "none",
			background : "none"
		}
	});
}

$(function(){
	block($(".dataShow"));
	draw($("#all"),"1","1");
	draw($("#account"),"0","12",null);
	draw($("#meal"),"1",null,null);
	draw($("#shop"),"1",null,null);
	draw($("#traffic"),"1",null,null);
	draw($("#fee"),"1",null,null);
	draw($("#other"),"1",null,null);

	$(".date").datepicker({
		dateFormat:"yy-mm-dd"
	});
	
	$(".update").click(function(){
		$dateShow=$(this).parent().parent().parent().find(".dataShow");
		block($dateShow);
		var type=($dateShow.attr("value")=="drawSummaryForPie")?"1":null;
		draw($dateShow,"1",type,null);
	});
	$(".updateAccount").click(function(){
		$dateShow=$(this).parent().parent().parent().find(".dataShow");
		block($dateShow);
		draw($dateShow,"0","12",null);
	});
});