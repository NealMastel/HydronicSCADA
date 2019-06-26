<!- DOCTYPE html ->
<html>

<head>
	<!-- CSS included files test-->
	<link href="css/style.css" rel="stylesheet" type="text/css">
	
	<!-- included Javascript files -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	
	<style>
		body {
			background-color: #D3D3D3;
			}
			
			* {	padding: 0; margin: 0; vertical-align: top; }
			
		#ahufan {
		-webkit-animation: rotation 1.2s infinite linear;
		}

		@-webkit-keyframes rotation {
			from {
					-webkit-transform: rotate(0deg);
			}
			
		to {
				-webkit-transform: rotate(359deg);
			}
		}	
		
		#GarageHangingHeaterFan {
		-webkit-animation: rotation 1.2s infinite linear;
		}

		@-webkit-keyframes rotation {
			from {
					-webkit-transform: rotate(0deg);
			}
			
		to {
				-webkit-transform: rotate(359deg);
			}
		}	
	</style>
	
	<!-- Javascript for OWB Supply Gauge -->
	<script type="text/javascript">
	
	/* Load libraries for Google Charts */
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
	google.charts.setOnLoadCallback(drawBTUchart);
	
	/* Initialize variables */
	var M250Supply1WaterTemp
	var M250Supply2WaterTemp
	var M250Return1WaterTemp
	var M250Return2WaterTemp
	var M250Return1FlowRate
	var M250Return2FlowRate
	var M250Supply1CirculatorRPM = .5;
	var M250Supply2CirculatorRPM = 1;
	var AirHandlingUnitCirculatorRPM = 1;
	var DomesticHotWaterCirculatorRPM = .5;
	var M250StackTemp
	var M250HopperLevel
	var M250WaterLevel
	var M250SupplyReturnSpeed = 1;
	var HouseSupplyReturnSpeed = 3;
	var HouseSupplyWaterTemp = 0;
	var HouseReturnWaterTemp = 0;
	var HouseReturnFlowRate = 0;
	var AirHandlingUnitSupplyWaterTemp = 0;
	var AirHandlingUnitReturnWaterTemp = 0;
	var AirHandlingUnitReturnFlowRate = 0;
	var AirHandlingUnitSupplyReturnSpeed = 2;
	var AirHandlingUnitFanSpeed = 2;
	var AirHandlingUnitSupplyAirTemp = 0;
	var AirHandlingUnitSupplyAirCFM = 0;
	var AirHandlingUnitReturnAirTemp = 2;
	var AirHandlingUnitElectricStripPower = 0;
	var AirHandlingUnitSupplyAirRH = 0;
	var AirHandlingUnitReturnAirRH = 0;
	var DomesticHotWaterSupplyReturnSpeed = 1;
	var DomesticHotWaterSupplyWaterTemp = 2;
	var DomesticHotWaterFlatPlateReturnWaterTemp = 2;
	var DomesticHotWaterSupplyFlowRate = 0;
	var DomesticHotWaterShellReturnWaterTemp = 2;
	var DomesticHotWaterPotableSpeed = 5;
	var DomesticHotWaterPotableSupplyTemp = 0;
	var DomesticHotWaterPotableSupplyFlowRate = 0;
	var DomesticHotWaterPotableFlatPlateSupplyTemp = 0;
	var DomesticHotWaterPotableHotSupplyTemp = 0;
	var DomesticHotWaterPotableTemperedSupplyTemp = 0;
	var DomesticHotWaterPotableShellSupplyTemp = 0;
	var DomesticHotWaterPotableShellReturnTemp = 0;
	var GarageSupplyWaterTemp = 0;
	var GarageReturnWaterTemp = 0;
	var GarageReturnFlowRate = 0;
	
	/* Initialize Javascript array for SVG animation control and HTML element updates from JSON file data -------------------------------------------------------------- */
	var dataArray = [];
	
	/* JSON file query for SVG animation control and HTML element updates */
	function getSVGHTMLJSON() {
		$.getJSON( "mysql/results.json", function(data){
		dataArray = data;
		M250Supply1WaterTemp = dataArray[0];
		M250Supply2WaterTemp = dataArray[1];
		M250Return1WaterTemp = dataArray[2];
		M250Return2WaterTemp = dataArray[3];
		M250Return1FlowRate = dataArray[4];
		M250Return2FlowRate = dataArray[5];
		AirHandlingUnitSupplyWaterTemp = dataArray[6];
		AirHandlingUnitReturnWaterTemp = dataArray[7];
		AirHandlingUnitReturnFlowRate = dataArray[8];
		HouseSupplyWaterTemp = dataArray[9];
		HouseReturnWaterTemp = dataArray[10];
		HouseReturnFlowRate = dataArray[11];
		DomesticHotWaterSupplyWaterTemp = dataArray[12];
		DomesticHotWaterFlatPlateReturnWaterTemp = dataArray[13];
		DomesticHotWaterSupplyFlowRate = dataArray[14];
		DomesticHotWaterShellReturnWaterTemp = dataArray[15];
		DomesticHotWaterPotableSupplyTemp = dataArray[16];
		DomesticHotWaterPotableSupplyFlowRate = dataArray[17];
		DomesticHotWaterPotableFlatPlateSupplyTemp = dataArray[18];
		DomesticHotWaterPotableHotSupplyTemp = dataArray[19];
		M250StackTemp = dataArray[20];
		M250HopperLevel = dataArray[21];
		M250WaterLevel = dataArray[22];
		AirHandlingUnitReturnAirTemp = dataArray[23];
		AirHandlingUnitSupplyAirTemp = dataArray[24];
		AirHandlingUnitSupplyAirCFM = dataArray[25];
		AirHandlingUnitElectricStripPower = dataArray[26];
		AirHandlingUnitSupplyAirRH = dataArray[27];
		AirHandlingUnitReturnAirRH = dataArray[28];
		DomesticHotWaterPotableTemperedSupplyTemp = dataArray[29];
		DomesticHotWaterPotableShellSupplyTemp = dataArray[30];
		DomesticHotWaterPotableShellReturnTemp = dataArray[31];
		GarageSupplyWaterTemp = dataArray[32];
		GarageReturnWaterTemp = dataArray[33];
		GarageReturnFlowRate = dataArray[34];
		
		/* Log M250Supply1WaterTemp to verify JSON data population */
		console.log(M250Supply1WaterTemp);
		});
    };
	
	/* Call getSVGHTMLJSON function so there is no delay for the first call */
	getSVGHTMLJSON();
	
	/* Set getSVGHTMLJSON update frequency */
	updategetSVGHTMLJSONInterval = setInterval(getSVGHTMLJSON,5000);
	
	/* Initialize Javascript array for Google Chart updates from JSON file data ---------------------------------------------------------------------------------------- */
	var googleChartDataArray = [];
	
	/* JSON file for Google Charts update */
	function googleChartJSON() {
		$.getJSON( "mysql/chartresults.json", function(data){
		googleChartDataArray = data;
		});
		
		/* Log googleChartDataArray[500] to verify JSON data population */
		console.log(googleChartDataArray[500]);
    };
	
	/* Call googleChartJSON function so there is no delay for the first call */
	googleChartJSON();

	/* Set googleChartJSON update frequency */
	updategoogleChartJSONInterval = setInterval(googleChartJSON,5000);
	
	/* Assembly of the drawChart() function for Google line chart */
	function drawChart() {
		var data = new google.visualization.DataTable();
	  
		/* Time is buit from MySQL timestamp from JSON data file (UNIX_TIMESTAMP() MySQL function) formatted in hAxis option */
		data.addColumn('datetime', 'Time');
		data.addColumn('number', 'Thermocouple 1');
		data.addColumn('number', 'Thermocouple 2');
		data.addColumn('number', 'Thermocouple 3');

		/* JSON data was built for 5 thermocouples, only uing 3 at present */
		data.addRows([
			[new Date(googleChartDataArray[1000]*1000),  parseFloat(googleChartDataArray[500]), parseFloat(googleChartDataArray[501]), parseFloat(googleChartDataArray[502])],
			[new Date(googleChartDataArray[1005]*1000),  parseFloat(googleChartDataArray[505]), parseFloat(googleChartDataArray[506]), parseFloat(googleChartDataArray[507])],
			[new Date(googleChartDataArray[1010]*1000),  parseFloat(googleChartDataArray[510]), parseFloat(googleChartDataArray[511]), parseFloat(googleChartDataArray[512])],
			[new Date(googleChartDataArray[1015]*1000),  parseFloat(googleChartDataArray[515]), parseFloat(googleChartDataArray[516]), parseFloat(googleChartDataArray[517])],
			[new Date(googleChartDataArray[1020]*1000),  parseFloat(googleChartDataArray[520]), parseFloat(googleChartDataArray[521]), parseFloat(googleChartDataArray[522])],
			[new Date(googleChartDataArray[1025]*1000),  parseFloat(googleChartDataArray[525]), parseFloat(googleChartDataArray[526]), parseFloat(googleChartDataArray[527])],
			[new Date(googleChartDataArray[1030]*1000),  parseFloat(googleChartDataArray[530]), parseFloat(googleChartDataArray[531]), parseFloat(googleChartDataArray[532])],
			[new Date(googleChartDataArray[1035]*1000),  parseFloat(googleChartDataArray[535]), parseFloat(googleChartDataArray[536]), parseFloat(googleChartDataArray[537])],
			[new Date(googleChartDataArray[1040]*1000),  parseFloat(googleChartDataArray[540]), parseFloat(googleChartDataArray[541]), parseFloat(googleChartDataArray[542])],
			[new Date(googleChartDataArray[1045]*1000),  parseFloat(googleChartDataArray[545]), parseFloat(googleChartDataArray[546]), parseFloat(googleChartDataArray[547])],
			[new Date(googleChartDataArray[1050]*1000),  parseFloat(googleChartDataArray[550]), parseFloat(googleChartDataArray[551]), parseFloat(googleChartDataArray[552])],
			[new Date(googleChartDataArray[1055]*1000),  parseFloat(googleChartDataArray[555]), parseFloat(googleChartDataArray[556]), parseFloat(googleChartDataArray[557])],
			[new Date(googleChartDataArray[1060]*1000),  parseFloat(googleChartDataArray[560]), parseFloat(googleChartDataArray[561]), parseFloat(googleChartDataArray[562])],
			[new Date(googleChartDataArray[1065]*1000),  parseFloat(googleChartDataArray[565]), parseFloat(googleChartDataArray[566]), parseFloat(googleChartDataArray[567])],
			[new Date(googleChartDataArray[1070]*1000),  parseFloat(googleChartDataArray[570]), parseFloat(googleChartDataArray[571]), parseFloat(googleChartDataArray[572])],
			[new Date(googleChartDataArray[1075]*1000),  parseFloat(googleChartDataArray[575]), parseFloat(googleChartDataArray[576]), parseFloat(googleChartDataArray[577])],
			[new Date(googleChartDataArray[1080]*1000),  parseFloat(googleChartDataArray[580]), parseFloat(googleChartDataArray[581]), parseFloat(googleChartDataArray[582])],
			[new Date(googleChartDataArray[1085]*1000),  parseFloat(googleChartDataArray[585]), parseFloat(googleChartDataArray[586]), parseFloat(googleChartDataArray[587])],
			[new Date(googleChartDataArray[1090]*1000),  parseFloat(googleChartDataArray[590]), parseFloat(googleChartDataArray[591]), parseFloat(googleChartDataArray[592])],
			[new Date(googleChartDataArray[1095]*1000),  parseFloat(googleChartDataArray[595]), parseFloat(googleChartDataArray[596]), parseFloat(googleChartDataArray[597])]
		]);
		
		/* Assmble Google Chart options */
		var options = {
			backgroundColor: { fill:'transparent' },
			legend: {position: 'middle', textStyle: {fontSize: 14}},
			crosshair: { trigger: 'both' },
			chartArea:{left:30,top:10,width:'65%',height:'90%'},
			curveType: "function",
			width: 575,
			height: 300,
			hAxis: {
				format: 'HH:mm'
			},
			vAxis: {
				gridlines: {count: 5},
			}
		};
		
		/* Instantiate and draw the chart. */
      var chart = new google.visualization.LineChart(document.getElementById('googleChartDIV'));
      chart.draw(data, options);
    };
	
	/* Set the interval for Google line chart redrawing */
    setInterval(drawChart, 20000);
	
	/* Assembly of the drawBTUchart() function for Google bar graph */
	function drawBTUchart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "BTU's", { role: "style" } ],
        ["House Total", HouseBTUs = HouseReturnFlowRate * (HouseSupplyWaterTemp - HouseReturnWaterTemp) * 500, "black"],
        ["Forced Air", AirHandlingUnitReturnFlowRate * (AirHandlingUnitSupplyWaterTemp - AirHandlingUnitReturnWaterTemp) * 500, "black"],
        ["DHW", (DomesticHotWaterSupplyFlowRate * (DomesticHotWaterSupplyWaterTemp - DomesticHotWaterFlatPlateReturnWaterTemp) * 500)+(DomesticHotWaterSupplyFlowRate * (DomesticHotWaterFlatPlateReturnWaterTemp - DomesticHotWaterShellReturnWaterTemp) * 500), "black"],
        ["Towel Warmer", (AirHandlingUnitReturnFlowRate * (AirHandlingUnitSupplyWaterTemp - AirHandlingUnitReturnWaterTemp) * 500)*.83, "black"],
		["Infloor Heat", (AirHandlingUnitReturnFlowRate * (AirHandlingUnitSupplyWaterTemp - AirHandlingUnitReturnWaterTemp) * 500)*.75, "black"],
		["Swimming Pool", (AirHandlingUnitReturnFlowRate * (AirHandlingUnitSupplyWaterTemp - AirHandlingUnitReturnWaterTemp) * 500)*1.25, "black"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "BTU Consumption",
		backgroundColor: { fill:'transparent' },
		chartArea:{left:50,top:50},
        width: 600,
        height: 300,
        bar: {groupWidth: "80%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("googleColumnChart"));
      chart.draw(view, options);
	}
	
	/* Set the interval for Google line chart redrawing */
    setInterval(drawBTUchart, 1000);
	
	</script>

</head>

<body style="width:100%;">

<div style="width: 100%; height: 100%;">
	
	
	<!-- DIV for M250 Cut Away Image -->
	<div id="M250" style="position: absolute; top: 80px; left: 45px; width: 150px; height: 150px; background-color: transparent;" >
		<img src="/images/m250.png" style='height: 100%; width: 100%; object-fit: contain'/>
	</div>
	
	<!-- DIV for M250 Stack Temp (innerHTML change via Javascript) -->
	<div id="M250StackTempDIV" style="position: absolute; top: 50px; left: 70px; font-size: 12px; font-weight: bold;" >Stack Temp
	</div>
	
	<!-- DIV for M250 WaterLevel (innerHTML change via Javascript) -->
	<div id="M250WaterLevelDIV" style="position: absolute; top: 95px; left: 15px; font-size: 12px; font-weight: bold;" >Water Level
	</div>
	
	<!-- DIV for M250 Hopper Level (innerHTML change via Javascript) -->
	<div id="M250HopperLevelDIV" style="position: absolute; top: 125px; left: 100px; font-size: 12px; font-weight: bold;" >Hopper Level
	</div>
	
	<!-- DIV for M250 Supply 1 Circulator -->
	<div id="M250Supply1CirculatorDIV" style="position: absolute; top: 150px; left: 167px; width: 40px; height: 40px; background-color: transparent;" >
		<img src="/images/circ.png" style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; object-fit: contain"/>
		<svg width="100" height="100" viewbox="-22 -23 145 145">
			<polygon points="0,0 20,10 0,20">
				<animateTransform 
					id="M250Supply1Circulator"
					attributeName="transform"
					attributeType="css"
					type="rotate"
					from="0 7 10"
					to="360 7 10"
					dur="6"
					repeatCount="indefinite"
				/>
			</polygon>
			
		</svg>
	</div>
	
	<!-- DIV for M250 Water Pipe -->
	<div id="M250WaterPipe" style="position: absolute; top: 0px; left: 0px;" >
		<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<svg
			xmlns:svg="http://www.w3.org/2000/svg"
			xmlns="http://www.w3.org/2000/svg"
			version="1.1"
			width="1200"
			height="1600"
		>
			<style type="text/css">  
				@keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-moz-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-webkit-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
			</style>  
			
			<!-- Path of M250 Supply 1 Black Water Pipe Walls ------------------------------------------------------------------------------------------------------->
			<path
				d="M205,173
				L440,173
				L440,87
				L490,87"
				fill="none"
				id="M250Supply1BlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:9" 
			/>
	   
			<!-- Path of M250 Supply 1 Red Interior Water Pipe -->
			<path
				d="M205,173
				L440,173
				L440,87
				L490,87"
				fill="none"
				id="M250Supply1RedInteriorWaterPipe"
				style="stroke:#ff0000;stroke-width:7" 
			/> 
	   
			<!-- Path of M250 Supply 1 Red #1 Water Pipe -->
			<path
				d="M205,173
				L440,173
				L440,87
				L490,87"
				fill="none"
				id="M250Supply1Red1WaterPipe"
				style="stroke:#ff3232;stroke-width:7;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; " 
			/>
		
			<!-- Path of M250 Supply 1 Red #2 Water Pipe -->
			<path
				d="M205,173
				L440,173
				L440,87
				L490,87"
				fill="none"
				id="M250Supply1Red2WaterPipe"
				style="stroke:#ff6666;stroke-width:7;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; " 
			/>
		
			<!-- Path of M250 Supply 1 Red #3 Water Pipe -->
			<path
				d="M205,173
				L440,173
				L440,87
				L490,87"
				fill="none"
				id="M250Supply1Red3WaterPipe"
				style="stroke:#ff9999;stroke-width:7;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; " 
			/>
		
			<!-- Path of M250 Supply 1 Red #4 Water Pipe -->	
			<path
				d="M205,173
				L440,173
				L440,87
				L490,87"
				fill="none"
				id="M250Supply1Red4WaterPipe"
				style="stroke:#ffcccc;stroke-width:7;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; "  
			/>
			
			<!-- Path of M250 Return 1 Black Water Pipe Walls -------------------------------------------------------------------------------------------------->
			<path
				d="M490,153
				L465,153
				L465,200
				L168,200
				"
				fill="none"
				id="M250Return1BlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:9" />
	   
			<!-- Path of M250 Return 1 Blue Interior Water Pipe -->
			<path
				d="M490,153
				L465,153
				L465,200
				L168,200
				"
				fill="none"
				id="M250Return1BlueInteriorWaterPipe"
				style="stroke:#0000ff;stroke-width:7" 
			/> 
	   
			<!-- Path of M250 Return 1 Blue #1 Water Pipe -->
			<path
				d="M490,153
				L465,153
				L465,200
				L168,200
				"
				fill="none"
				id="M250Return1Blue1WaterPipe"
				style="stroke:#3232ff;stroke-width:7;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; " 
			/>
		
			<!-- Path of M250 Return 1 Blue #2 Water Pipe -->
			<path
				d="M490,153
				L465,153
				L465,200
				L168,200
				"
				fill="none"
				id="M250Return1Blue2WaterPipe"
				style="stroke:#6666ff;stroke-width:7;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; " 
			/>
		
			<!-- Path of M250 Return 1 Blue #3 Water Pipe -->
			<path
				d="M490,153
				L465,153
				L465,200
				L168,200
				"
				fill="none"
				id="M250Return1Blue3WaterPipe"
				style="stroke:#9999ff;stroke-width:7;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; "  
			/>
		
			<!-- Path of M250 Return 1 Blue #4 Water Pipe -->
			<path
				d="M490,153
				L465,153
				L465,200
				L168,200
				"
				fill="none"
				id="M250Return1Blue4WaterPipe"
				style="stroke:#ccccff;stroke-width:7;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; "  
			/>
			
			<!-- Path of M250 Supply 2 Black Water Pipe Walls --------------------------------------------------------------------------------------->
			<path
				d="M150,222
				L150,270
				L170,270
				M204,270
				L630,270
				L630,1600
				"
				fill="none"
				id="M250Supply2BlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" 
			/>
	   
			<!-- Path of M250 Supply 2 Red Interior Water Pipe -->
			<path
				d="M150,222
				L150,270
				L170,270
				M204,270
				L630,270
				L630,1600
				"
				fill="none"
				id="M250Supply2RedInteriorWaterPipe"
				style="stroke:#ff0000;stroke-width:3" 
			/> 
	   
			<!-- Path of M250 Supply 2 Red #1 Water Pipe -->
			<path
				d="M150,222
				L150,270
				L170,270
				M204,270
				L630,270
				L630,1600
				"
				fill="none"
				id="M250Supply2Red1WaterPipe"
				style="stroke:#ff3232;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; " 
			/>
		
			<!-- Path of M250 Supply 2 Red #2 Water Pipe -->
			<path
				d="M150,222
				L150,270
				L170,270
				M204,270
				L630,270
				L630,1600
				"
				fill="none"
				id="M250Supply2Red2WaterPipe"
				style="stroke:#ff6666;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; " 
			/>
		
			<!-- Path of M250 Supply 2 Red #3 Water Pipe -->
			<path
				d="M150,222
				L150,270
				L170,270
				M204,270
				L630,270
				L630,1600
				"
				fill="none"
				id="M250Supply2Red3WaterPipe"
				style="stroke:#ff9999;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; " 
			/>
		
			<!-- Path of M250 Supply 2 Red #4 Water Pipe -->	
			<path
				d="M150,222
				L150,270
				L170,270
				M204,270
				L630,270
				L630,1600
				"
				fill="none"
				id="M250Supply2Red4WaterPipe"
				style="stroke:#ffcccc;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; "  
			/>
			
			<!-- Path of M250 Return 2 Black Water Pipe Walls -------------------------------------------------------------------------------------------------->
			<path
				d="M600,1600
				L600,290
				L130,290
				L130,225
				"
				fill="none"
				id="M250Return2BlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" />
	   
			<!-- Path of M250 Return 2 Blue Interior Water Pipe -->
			<path
				d="M600,1600
				L600,290
				L130,290
				L130,225
				"
				fill="none"
				id="M250Return2BlueInteriorWaterPipe"
				style="stroke:#0000ff;stroke-width:3" 
			/> 
	   
			<!-- Path of M250 Return 2 Blue #1 Water Pipe -->
			<path
				d="M600,1600
				L600,290
				L130,290
				L130,225
				"
				fill="none"
				id="M250Return2Blue1WaterPipe"
				style="stroke:#3232ff;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; " 
			/>
		
			<!-- Path of M250 Return 2 Blue #2 Water Pipe -->
			<path
				d="M600,1600
				L600,290
				L130,290
				L130,225
				"
				fill="none"
				id="M250Return2Blue2WaterPipe"
				style="stroke:#6666ff;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; " 
			/>
		
			<!-- Path of M250 Return 2 Blue #3 Water Pipe -->
			<path
				d="M600,1600
				L600,290
				L130,290
				L130,225
				"
				fill="none"
				id="M250Return2Blue3WaterPipe"
				style="stroke:#9999ff;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; "  
			/>
		
			<!-- Path of M250 Return 2 Blue #4 Water Pipe -->
			<path
				d="M600,1600
				L600,290
				L130,290
				L130,225
				"
				fill="none"
				id="M250Return2Blue4WaterPipe"
				style="stroke:#ccccff;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite; "  
			/>
				
			
		</svg>
	</div>	
	
	<!-- DIV for M250 Supply 1 Water Temp Text (innerHTML change via Javascript) -->
	<div id="M250Supply1WaterTempTextDIV" style="position: absolute; top: 150px; left: 215px; font-size: 12px; font-weight: bold;" > M250 Supply 1 Temp
	</div>
	
	<!-- DIV for M250 Return 1 Water Temp Text (innerHTML change via Javascript) -->
	<div id="M250Return1WaterTempTextDIV" style="position: absolute; top: 180px; left: 215px; font-size: 12px; font-weight: bold;" > M250 Return 1 Temp
	</div>
	
	<!-- DIV for M250 Supply 2 Circulator -->
	<div id="M250Supply2CirculatorDIV" style="position: absolute; top: 247px; left: 167px; width: 40px; height: 40px; background-color: transparent;" >
		<img src="/images/circ.png" style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; object-fit: contain"/>
		<svg width="100" height="100" viewbox="-22 -23 145 145">
			<polygon points="0,0 20,10 0,20">
				<animateTransform 
					id="M250Supply2Circulator"
					attributeName="transform"
					attributeType="css"
					type="rotate"
					from="0 7 10"
					to="360 7 10"
					dur="6"
					repeatCount="indefinite"
				/>
			</polygon>
		</svg>
	</div>	
	
	<!-- DIV for M250 Supply 2 Water Temp Text (innerHTML change via Javascript) -->
	<div id="M250Supply2WaterTempTextDIV" style="position: absolute; top: 250px; left: 215px; font-size: 12px; font-weight: bold;" > Temp
	</div>
	
	<!-- DIV for Bulk Bin Image -->
	<div id="Bulkbin" style="position: absolute; top: -20px; left: 185px; width: 200px; height: 200px; background-color: transparent;" >
		<img src="/images/bulkbin.png" style='height: 100%; width: 100%; object-fit: contain'/>
	</div>
	
	<!-- DIV for Bulk Bin Auger SVG Feed Tube -->
	<div id="owbaugercontroller" style="position: absolute; top: 0px; left: 0px;" >
		<svg width="1024" height="768">
			<!-- PVC Feed Tube -->
			<rect x="193" y="120" rx="5" ry="5" width="10" height="20" style="fill:white;" />
			<rect x="193" y="55" width="10" height="10" style="fill:black;" />
			<rect x="167" y="130" width="30" height="10" style="fill:white;" />
	</svg>
	
	</div>	
	
	<!-- DIV for Halo Sensor Image -->
	<div id="Bulkbin" style="position: absolute; top: 65px; left: 168px; width: 60px; height: 60px; background-color: transparent;" >
		<img src="/images/halo.png" style='height: 100%; width: 100%; object-fit: contain'/>
	</div>
	
	<!-- DIV for Caleffi Hydrolic Seperator -->
	<div id="C548" style="position: absolute; top: 25px; left: 420px; width: 200px; height: 200px; background-color: transparent;" >
		<img src="/images/c548.png" style='height: 100%; width: 100%; object-fit: contain'/>
	</div>
	
	<!-- DIV for House Supply Water Temp Text (innerHTML change via Javascript) -->
	<div id="HouseWaterSupplyTempTextDIV" style="position: absolute; top: 65px; left: 580px; font-size: 12px; font-weight: bold;" > House Water Supply Temp
	</div>
	
	<!-- DIV for House Return Water Temp and BTU Text (innerHTML change via Javascript) -->
	<div id="HouseWaterReturnTempTextDIV" style="position: absolute; top: 165px; left: 560px; font-size: 12px; font-weight: bold;" > House Water Return Temp
	</div>
	
	<!-- DIV for House Water Pipe -->
	<div id="HouseWaterPipeDIV" style="position: absolute; top: 0px; left: 0px;" >
		<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<svg
			xmlns:svg="http://www.w3.org/2000/svg"
			xmlns="http://www.w3.org/2000/svg"
			version="1.1"
			width="1200"
			height="1600"
		>
			<style type="text/css">  
				@keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-moz-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-webkit-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
			</style>  
  
			<!-- Path of House Supply Black Water Pipe Walls -->
			<path
				d="M557,87
				L700,87
				L700,1600
				"
				fill="none"
				id="HouseSupplyBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:9" 
			/>
	   
			<!-- Path of House Supply Red Interior Water Pipe -->
			<path
				d="M557,87
				L700,87
				L700,1600
				"
				fill="none"
				id="HouseSupplyRedInteriorWaterPipe"
				style="stroke:#ff0000;stroke-width:7" 
			/> 
	   
			<!-- Path of House Supply Red #1 Water Pipe -->
			<path
				d="M557,87
				L700,87
				L700,1600
				"
				fill="none"
				id="HouseSupplyRed1WaterPipe"
				style="stroke:#ff3232;stroke-width:7;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of House Supply Red #2 Water Pipe -->
			<path
				d="M557,87
				L700,87
				L700,1600
				"
				fill="none"
				id="HouseSupplyRed2WaterPipe"
				style="stroke:#ff6666;stroke-width:7;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of House Supply Red #3 Water Pipe -->
			<path
				d="M557,87
				L700,87
				L700,1600
				"
				fill="none"
				id="HouseSupplyRed3WaterPipe"
				style="stroke:#ff9999;stroke-width:7;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of House Supply Red #4 Water Pipe -->	
			<path
				d="M557,87
				L700,87
				L700,1600
				"
				fill="none"
				id="HouseSupplyRed4WaterPipe"
				style="stroke:#ffcccc;stroke-width:7;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
			
			<!-- Path of House Return Black Water Pipe Walls ----------------------------------------------------------------------------------------->
			<path
				d="M666,1600
				L666,153
				L557,153
				"
				fill="none"
				id="HouseReturnBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:9" 
			/>
	   
			<!-- Path of House Return Blue Interior Water Pipe -->
			<path
				d="M666,1600
				L666,153
				L557,153
				"
				fill="none"
				id="HouseReturnBlue1InteriorWaterPipe"
				style="stroke:#0000ff;stroke-width:7" 
			/> 
	   
			<!-- Path of House Return Blue #1 Water Pipe -->
			<path
				d="M666,1600
				L666,153
				L557,153
				"
				fill="none"
				id="HouseReturnBlue1WaterPipe"
				style="stroke:#3232ff;stroke-width:7;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of House Return Blue #2 Water Pipe -->
			<path
				d="M666,1600
				L666,153
				L557,153
				"
				fill="none"
				id="HouseReturnBlue2WaterPipe"
				style="stroke:#6666ff;stroke-width:7;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of House Return Blue #3 Water Pipe -->
			<path
				d="M666,1600
				L666,153
				L557,153
				"
				fill="none"
				id="HouseReturnBlue3WaterPipe"
				style="stroke:#9999ff;stroke-width:7;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of House Return Blue #4 Water Pipe -->	
			<path
				d="M666,1600
				L666,153
				L557,153
				"
				fill="none"
				id="HouseReturnBlue4WaterPipe"
				style="stroke:#ccccff;stroke-width:7;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		</svg>
		
	</div>	
	
	<!-- DIV for House Forced Air Label Text -->
	<div id="HouseForcedAirLabelTextDIV" style="position: absolute; top: 10px; left: 916px; font-size: 20px; font-weight: bold;" > House Forced Air
	</div>
	
	<!-- DIV for House Forced Air Border SVG -->
	<div id="HouseForcedAirBorderSVGDIV" style="position: absolute; background-color: transparent;" >
		<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<svg
			xmlns:svg="http://www.w3.org/2000/svg"
			xmlns="http://www.w3.org/2000/svg"
			version="1.1"
			width="1800"
			height="768"
		>
			<style type="text/css">  
				@keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-moz-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-webkit-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
			</style>  
  
			<!-- Drawing of House Forced Air Border -->
			<path
				d="	M 736 6
					L 1316 6
					L 1316 320
					L 736 320
					L 736 6
				"
				fill="none"
				id="HouseForcedAirBorder"
				style="stroke:#000000;stroke-width:3;stroke-dasharray:5,5;" 
			/>
	</div>
	
</body>

	<!-- DIV for Air Handling Unit Fan -->
	<div id="AirHandlingUnitFanDIV" style="position: absolute; top: 225px; left: 956px; width: 70; height: 70; background-color: transparent;" >
		<img id="ahufan" src="/images/fan.png" style='height: 100%; width: 100%; object-fit: contain'/>
	</div>

	<!-- DIV for Air Handling Unit Circulator -->
	<div id="AirHandlingUnitCirculatorDIV" style="position: absolute; top: 82px; left: 766px; width: 40px; height: 40px; background-color: transparent;" >
		<img src="/images/circ.png" style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; object-fit: contain"/>
		<svg width="100" height="100" viewbox="-22 -23 145 145">
			<polygon points="0,0 20,10 0,20">
				<animateTransform 
					id="AirHandlingUnitCirculatorTriangle"
					attributeName="transform"
					attributeType="css"
					type="rotate"
					from="0 7 10"
					to="360 7 10"
					dur="6"
					repeatCount="indefinite"
				/>
			</polygon>
			
		</svg>
	</div>

	<!-- DIV for Air Handling Unit Water Pipe -->
	<div id="AirHandlingUnitWaterPipeDIV" style="position: absolute; top: 0px; left: 0px;" >
		<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<svg
			xmlns:svg="http://www.w3.org/2000/svg"
			xmlns="http://www.w3.org/2000/svg"
			version="1.1"
			width="1800"
			height="768"
		>
			<style type="text/css">  
				@keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-moz-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-webkit-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
			</style>  
  
			<!-- Path of Air Handling Unit Stub Supply Black Water Pipe Walls -->
			<path
				d="	M 704 105
					L 768 105
					M 804 105
					L 1016 105
					Q 1041 115 1016 125
				"
				fill="none"
				id="AirHandlingUnitSupplyBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" 
			/>
			
			<!-- Path of Air Handling Unit Stub Supply Red Interior Water Pipe -->
			<path
				d="	M 704 105
					L 768 105
					M 804 105
					L 1016 105
					Q 1041 115 1016 125
				"
				fill="none"
				id="AirHandlingUnitSupplyRedInteriorWaterPipe"
				style="stroke:#ff0000;stroke-width:3" 
			/> 
	   
			<!-- Path of Air Handling Unit Stub Supply Red #1 Water Pipe -->
			<path
				d="	M 704 105
					L 768 105
					M 804 105
					L 1016 105
					Q 1041 115 1016 125
				"
				fill="none"
				id="AirHandlingUnitSupplyRed1WaterPipe"
				style="stroke:#ff3232;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Air Handling Unit Stub Supply Red #2 Water Pipe -->
			<path
				d="	M 704 105
					L 768 105
					M 804 105
					L 1016 105
					Q 1041 115 1016 125
				"
				fill="none"
				id="AirHandlingUnitSupplyRed2WaterPipe"
				style="stroke:#ff6666;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Air Handling Unit Stub Supply Red #3 Water Pipe -->
			<path
				d="	M 704 105
					L 768 105
					M 804 105
					L 1016 105
					Q 1041 115 1016 125
				"
				fill="none"
				id="AirHandlingUnitSupplyRed3WaterPipe"
				style="stroke:#ff9999;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Air Handling Unit Stub Supply Red #4 Water Pipe -->	
			<path
				d="	M 704 105
					L 768 105
					M 804 105
					L 1016 105
					Q 1041 115 1016 125
				"
				fill="none"
				id="AirHandlingUnitSupplyRed4WaterPipe"
				style="stroke:#ffcccc;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
			
			<!-- Path of Air Handling Unit Return Black Water Pipe Walls ------------------------------------------------------------------------------------------->
			<path
				d="	M 1017 125
					L 796 125
					L 796 170
					L 720 170
					Q 699 140 680 170
					L 670 170
				"
				fill="none"
				id="AirHandlingUnitReturnBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" 
			/>
	   
			<!-- Path of Air Handling Unit Blue Interior Water Pipe -->
			<path
				d="	M 1017 125
					L 796 125
					L 796 170
					L 720 170
					Q 699 140 680 170
					L 670 170
				"
				fill="none"
				id="AirHandlingUnitRedInteriorWaterPipe"
				style="stroke:#0000ff;stroke-width:3" 
			/> 
	   
			<!-- Path of Air Handling Unit Blue #1 Water Pipe -->
			<path
				d="	M 1017 125
					L 796 125
					L 796 170
					L 720 170
					Q 699 140 680 170
					L 670 170
				"
				fill="none"
				id="AirHandlingUnitBlue1WaterPipe"
				style="stroke:#3232ff;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Air Handling Unit Blue #2 Water Pipe -->
			<path
				d="	M 1017 125
					L 796 125
					L 796 170
					L 720 170
					Q 699 140 680 170
					L 670 170
				"
				fill="none"
				id="AirHandlingUnitBlue2WaterPipe"
				style="stroke:#6666ff;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Air Handling Unit Blue #3 Water Pipe -->
			<path
				d="	M 1017 125
					L 796 125
					L 796 170
					L 720 170
					Q 699 140 680 170
					L 670 170
				"
				fill="none"
				id="AirHandlingUnitBlue3WaterPipe"
				style="stroke:#9999ff;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Air Handling Unit Blue #4 Water Pipe -->	
			<path
				d="	M 1017 125
					L 796 125
					L 796 170
					L 720 170
					Q 699 140 680 170
					L 670 170
				"
				fill="none"
				id="AirHandlingUnitBlue4WaterPipe"
				style="stroke:#ccccff;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		</svg>
		
	</div>	
	
	<!-- DIV for Air Handling Unit SVG -->
	<div id="AirHandlingUnitSVGDIV" style="position: absolute; background-color: transparent;" >
		<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<svg
			xmlns:svg="http://www.w3.org/2000/svg"
			xmlns="http://www.w3.org/2000/svg"
			version="1.1"
			width="1800"
			height="768"
		>
			<style type="text/css">  
				@keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-moz-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-webkit-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
			</style>  
  
			<!-- Drawing of Air Handling Unit -->
			<path
				d="	M 946 60
					L 946 300
					L 1096 300
					L 1096 200
					M 1036 250
					L 1036 60
				"
				fill="none"
				id="AirHandlingUnit"
				style="stroke:#000000;stroke-width:3" 
			/>
			
			<!-- Drawing of Air Handling Unit Heat Exchanger Fins -->
			<path
				d="	M 951 95
					L 951 135
					M 956 95
					L 956 135
					M 961 95
					L 961 135
					M 966 95
					L 966 135
					M 971 95
					L 971 135
					M 976 95
					L 976 135
					M 981 95
					L 981 135
					M 986 95
					L 986 135
					M 991 95
					L 991 135
					M 996 95
					L 996 135
					M 1001 95
					L 1001 135
					M 1006 95
					L 1006 135
					M 1011 95
					L 1011 135
					M 1016 95
					L 1016 135
					M 1021 95
					L 1021 135
					M 1026 95
					L 1026 135
					M 1031 95
					L 1031 135
				"
				fill="none"
				id="AirHandlingUnitFins"
				style="stroke:#000000;stroke-width:1" 
			/>
			
			<!-- Drawing of Air Handling Unit Backup Electric Strips -->
			<path
				d="	M 956 185
					L 1026 185
					M 956 195
					L 1026 195
				"
				fill="none"
				id="AirHandlingUnitBackupElectricStrips"
				style="stroke:#000000;stroke-width:3" 
			/>
	</div>
	
</body>

	<!-- DIV for Air Handling Unit Supply Air Temp Text (innerHTML change via Javascript) -->
	<div id="AirHandlingUnitAirSupplyTempTextDIV" style="position: absolute; top: 38px; left: 846px; font-size: 12px; font-weight: bold;" > Air Handling Unit Supply Air Temp
	</div>
	
	<!-- DIV for Air Handling Unit Return Air Temp Text (innerHTML change via Javascript) -->
	<div id="AirHandlingUnitAirReturnTempTextDIV" style="position: absolute; top: 170px; left: 1056px; font-size: 12px; font-weight: bold;" > Air Handling Unit Return Air Temp
	</div>
	
	<!-- DIV for Air Handling Unit Supply Water Temp Text (innerHTML change via Javascript) -->
	<div id="AirHandlingUnitWaterSupplyTempTextDIV" style="position: absolute; top: 85px; left: 815px; font-size: 12px; font-weight: bold;" > Air Handling Unit Supply Water Temp
	</div>
	
	<!-- DIV for Air Handling Unit Return Water Temp Text (innerHTML change via Javascript) -->
	<div id="AirHandlingUnitWaterReturnTempTextDIV" style="position: absolute; top: 130px; left: 815px; font-size: 12px; font-weight: bold;" > Air Handling Unit Return Water Temp
	</div>
	
	<!-- DIV for Air Handling Unit Return Water BTU Consumed Text (innerHTML change via Javascript) -->
	<div id="AirHandlingUnitWaterReturnBTUTextDIV" style="position: absolute; top: 150px; left: 815px; font-size: 12px; font-weight: bold;" > Air Handling Unit BTUs Consumed
	</div>
	
	<!-- DIV for Air Handling Unit Electric Backup Strips Text (innerHTML change via Javascript) -->
	<div id="AirHandlingUnitBackupElectricStripsTextDIV" style="position: absolute; top: 185px; left: 776px; font-size: 12px; font-weight: bold;" > Backup Electric Strips
	</div>
	
	<!-- DIV for Domestic Hot Water Circulator -->
	<div id="DomesticHotWaterCirculatorDIV" style="position: absolute; top: 422px; left: 766px; width: 40px; height: 40px; background-color: transparent;" >
		<img src="/images/circ.png" style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; object-fit: contain"/>
		<svg width="100" height="100" viewbox="-22 -23 145 145">
			<polygon points="0,0 20,10 0,20">
				<animateTransform 
					id="DomesticHotWaterCirculatorTriangle"
					attributeName="transform"
					attributeType="css"
					type="rotate"
					from="0 7 10"
					to="360 7 10"
					dur="6"
					repeatCount="indefinite"
				/>
			</polygon>
			
		</svg>
	</div>

	<!-- DIV for Domestic Hot Water Flat Plate Heat Exchanger Image -->
	<div id="DomesticHotWaterFlatPlateHeatExchangerDIV" style="position: absolute; top: 433px; left: 846px; width: 100px; height: 100px; background-color: transparent;" >
		<img src="/images/flatplate.png" style='height: 100%; width: 100%; object-fit: contain'/>
	</div>
	
	<!-- DIV for Domestic Hot Water Mixing Valve Image -->
	<div id="DomesticHotWaterMixingValveDIV" style="position: absolute; top: 437px; left: 1396px; width: 75px; height: 75px; background-color: transparent;" >
		<img src="/images/mixingvalve.png" style='height: 100%; width: 100%; object-fit: contain'/>
	</div>
	
	<!-- DIV for Domestic Hot Water Water Heater Image -->
	<div id="DomesticHotWaterWaterHeaterDIV" style="position: absolute; top: 490px; left: 1146px; width: 300px; height: 300px; background-color: transparent;" >
		<img src="/images/waterheater.png" style='height: 100%; width: 100%; object-fit: contain'/>
	</div>
	
	<!-- DIV for Domestic Hot Water Water Pipe -->
	<div id="DomesticHotWaterWaterPipeDIV" style="position: absolute; top: 90px; left: -54px;" >
		<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<svg
			xmlns:svg="http://www.w3.org/2000/svg"
			xmlns="http://www.w3.org/2000/svg"
			version="1.1"
			width="1800"
			height="768"
		>
			<style type="text/css">  
				@keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-moz-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-webkit-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
			</style>  
			
			<!-- Path of Domestic Hot Water Supply Black Water Pipe Walls --------------------------------------------------------------------------------------------->
			<path
				d="	M 758 355
					L 822 355
					M 858 355
					L 941 355
					M 941 432
					L 900 432
					L 900 475
					L 1200 475
				"
				fill="none"
				id="DomesticHotWaterSupplyBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" 
			/>
			
			<!-- Path of Domestic Hot Water Supply Red Interior Water Pipe -->
			<path
				d="	M 758 355
					L 822 355
					M 858 355
					L 941 355
					M 941 432
					L 900 432
					L 900 475
					L 1200 475
				"
				fill="none"
				id="DomesticHotWaterSupplyRedInteriorWaterPipe"
				style="stroke:#ff0000;stroke-width:3" 
			/> 
	   
			<!-- Path of Domestic Hot Water Supply Red #1 Water Pipe -->
			<path
				d="	M 758 355
					L 822 355
					M 858 355
					L 941 355
					M 941 432
					L 900 432
					L 900 475
					L 1200 475
				"
				fill="none"
				id="DomesticHotWaterSupplyRed1WaterPipe"
				style="stroke:#ff3232;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Domestic Hot Water Supply Red #2 Water Pipe -->
			<path
				d="	M 758 355
					L 822 355
					M 858 355
					L 941 355
					M 941 432
					L 900 432
					L 900 475
					L 1200 475
				"
				fill="none"
				id="DomesticHotWaterSupplyRed2WaterPipe"
				style="stroke:#ff6666;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Domestic Hot Water Supply Red #3 Water Pipe -->
			<path
				d="	M 758 355
					L 822 355
					M 858 355
					L 941 355
					M 941 432
					L 900 432
					L 900 475
					L 1200 475
				"
				fill="none"
				id="DomesticHotWaterSupplyRed3WaterPipe"
				style="stroke:#ff9999;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Supply Red #4 Water Pipe -->	
			<path
				d="	M 758 355
					L 822 355
					M 858 355
					L 941 355
					M 941 432
					L 900 432
					L 900 475
					L 1200 475
				"
				fill="none"
				id="DomesticHotWaterSupplyRed4WaterPipe"
				style="stroke:#ffcccc;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
			
			<!-- Path of Domestic Hot Water Return Black Water Pipe Walls ------------------------------------------------------------------------------------------->
			<path
				d="	M 1200 630
					L 850 630
					L 850 420
					L 774 420
					Q 754 390 734 420
					L 724 420
				"
				fill="none"
				id="DomesticHotWaterReturnBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" 
			/>
	   
			<!-- Path of Domestic Hot Water Blue Interior Water Pipe -->
			<path
				d="	M 1200 630
					L 850 630
					L 850 420
					L 774 420
					Q 754 390 734 420
					L 724 420
				"
				fill="none"
				id="DomesticHotWaterBlueInteriorWaterPipe"
				style="stroke:#0000ff;stroke-width:3" 
			/> 
	   
			<!-- Path of Domestic Hot Water Blue #1 Water Pipe -->
			<path
				d="	M 1200 630
					L 850 630
					L 850 420
					L 774 420
					Q 754 390 734 420
					L 724 420
				"
				fill="none"
				id="DomesticHotWaterBlue1WaterPipe"
				style="stroke:#3232ff;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Blue #2 Water Pipe -->
			<path
				d="	M 1200 630
					L 850 630
					L 850 420
					L 774 420
					Q 754 390 734 420
					L 724 420
				"
				fill="none"
				id="DomesticHotWaterBlue2WaterPipe"
				style="stroke:#6666ff;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Domestic Hot Water Blue #3 Water Pipe -->
			<path
				d="	M 1200 630
					L 850 630
					L 850 420
					L 774 420
					Q 754 390 734 420
					L 724 420
				"
				fill="none"
				id="DomesticHotWaterBlue3WaterPipe"
				style="stroke:#9999ff;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Blue #4 Water Pipe -->	
			<path
				d="	M 1200 630
					L 850 630
					L 850 420
					L 774 420
					Q 754 390 734 420
					L 724 420
				"
				fill="none"
				id="DomesticHotWaterBlue4WaterPipe"
				style="stroke:#ccccff;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
			
			<!-- Path of Domestic Hot Water Potable Hot Supply Black Water Pipe Walls --------------------------------------------------------------------------------------------->
			<path
				d="	M 1314 430
					L 1314 325
					L 1545 325
					L 1545 380
					L 1525 380
					M 1488 421
					L 1488 460
				"
				fill="none"
				id="DomesticHotWaterPotableHotSupplyBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" 
			/>
			
			<!-- Path of Domestic Hot Water Potable Hot Red Interior Water Pipe -->
			<path
				d="	M 1314 430
					L 1314 325
					L 1545 325
					L 1545 380
					L 1525 380
					M 1488 421
					L 1488 460
				"
				fill="none"
				id="DomesticHotWaterSupplyPotableHotRedInteriorWaterPipe"
				style="stroke:#ff0000;stroke-width:3" 
			/> 
	   
			<!-- Path of Domestic Hot Water Potable Hot Red #1 Water Pipe -->
			<path
				d="	M 1314 430
					L 1314 325
					L 1545 325
					L 1545 380
					L 1525 380
					M 1488 421
					L 1488 460
				"
				fill="none"
				id="DomesticHotWaterPotableHotRed1WaterPipe"
				style="stroke:#ff3232;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Domestic Hot Water Potable Hot Red #2 Water Pipe -->
			<path
				d="	M 1314 430
					L 1314 325
					L 1545 325
					L 1545 380
					L 1525 380
					M 1488 421
					L 1488 460
				"
				fill="none"
				id="DomesticHotWaterPotableHotRed2WaterPipe"
				style="stroke:#ff6666;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Domestic Hot Water Potable Hot Red #3 Water Pipe -->
			<path
				d="	M 1314 430
					L 1314 325
					L 1545 325
					L 1545 380
					L 1525 380
					M 1488 421
					L 1488 460
				"
				fill="none"
				id="DomesticHotWaterPotableHotRed3WaterPipe"
				style="stroke:#ff9999;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Potable Hot Red #4 Water Pipe -->	
			<path
				d="	M 1314 430
					L 1314 325
					L 1545 325
					L 1545 380
					L 1525 380
					M 1488 421
					L 1488 460
				"
				fill="none"
				id="DomesticHotWaterPotableHotRed4WaterPipe"
				style="stroke:#ffcccc;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
			
			<!-- Path of Domestic Hot Water Potable Cold Supply Black Water Pipe Walls --------------------------------------------------------------------------------------------->
			<path
				d="	M 1050 432
					L 959 432
					M 959 355
					L 1294 355
					Q 1314 325 1334 355
					L 1415 355
					L 1415 380
					L 1450 380
					M 1386 355
					L 1386 640
				"
				fill="none"
				id="DomesticHotWaterPotableColdSupplyBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" 
			/>
			
			<!-- Path of Domestic Hot Water Potable Cold Blue Interior Water Pipe -->
			<path
				d="	M 1050 432
					L 959 432
					M 959 355
					L 1294 355
					Q 1314 325 1334 355
					L 1415 355
					L 1415 380
					L 1450 380
					M 1386 355
					L 1386 640
				"
				fill="none"
				id="DomesticHotWaterPotableColdBlueInteriorWaterPipe"
				style="stroke:#0000ff;stroke-width:3" 
			/> 
	   
			<!-- Path of Domestic Hot Water Potable Cold Blue #1 Water Pipe -->
			<path
				d="	M 1050 432
					L 959 432
					M 959 355
					L 1294 355
					Q 1314 325 1334 355
					L 1415 355
					L 1415 380
					L 1450 380
					M 1386 355
					L 1386 640
				"
				fill="none"
				id="DomesticHotWaterPotableColdBlue1WaterPipe"
				style="stroke:#3232ff;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Potable Cold Blue #2 Water Pipe -->
			<path
				d="	M 1050 432
					L 959 432
					M 959 355
					L 1294 355
					Q 1314 325 1334 355
					L 1415 355
					L 1415 380
					L 1450 380
					M 1386 355
					L 1386 640
				"
				fill="none"
				id="DomesticHotWaterPotableColdBlue2WaterPipe"
				style="stroke:#6666ff;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Domestic Hot Water Potable Cold Blue #3 Water Pipe -->
			<path
				d="	M 1050 432
					L 959 432
					M 959 355
					L 1294 355
					Q 1314 325 1334 355
					L 1415 355
					L 1415 380
					L 1450 380
					M 1386 355
					L 1386 640
				"
				fill="none"
				id="DomesticHotWaterPotableColdBlue3WaterPipe"
				style="stroke:#9999ff;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Potable Cold Blue #4 Water Pipe -->	
			<path
				d="	M 1050 432
					L 959 432
					M 959 355
					L 1294 355
					Q 1314 325 1334 355
					L 1415 355
					L 1415 380
					L 1450 380
					M 1386 355
					L 1386 640
				"
				fill="none"
				id="DomesticHotWaterPotableColdBlue4WaterPipe"
				style="stroke:#ccccff;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
			
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Black Water Pipe Walls ------------------------------------------------------------------------------------------->
			<path
				d="	M 1200 455
					L 1200 650
				"
				fill="none"
				id="DomesticHotWaterShellExchangerBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:21" 
			/>
	   
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Interior Water Pipe -->
			<path
				d="	M 1200 455
					L 1200 650
				"
				fill="none"
				id="DomesticHotWaterShellExchangerInteriorWaterPipe"
				style="stroke:#ff0000;stroke-width:19"  
			/> 
	   
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Red #1 Water Pipe -->
			<path
				d="	M 1200 455
					L 1200 650
				"
				fill="none"
				id="DomesticHotWaterShellExchangerRed1WaterPipe"
				style="stroke:#ff3232;stroke-width:19;stroke-dasharray:0, 12, 72, 13;
				animation-duration: 3s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Red #2 Water Pipe -->
			<path
				d="	M 1200 455
					L 1200 650
				"
				fill="none"
				id="DomesticHotWaterShellExchangerRed2WaterPipe"
				style="stroke:#ff6666;stroke-width:19;stroke-dasharray:0, 24, 48, 24;
				animation-duration: 3s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Red #3 Water Pipe -->
			<path
				d="	M 1200 455
					L 1200 650
				"
				fill="none"
				id="DomesticHotWaterShellExchanger3WaterPipe"
				style="stroke:#ff9999;stroke-width:19;stroke-dasharray:0, 36, 24, 36;
				animation-duration: 3s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Red #4 Water Pipe -->	
			<path
				d="	M 1200 455
					L 1200 650
				"
				fill="none"
				id="DomesticHotWaterShellExchangerRed4WaterPipe"
				style="stroke:#ffcccc;stroke-width:19;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: 3s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
			
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Potable Black Water Pipe Walls ------------------------------------------------------------------------------------------->
			<path
				d="	M 1300 665
					L 1200 665
					L 1200 555
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" 
			/>
	   
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Potable Interior Water Pipe -->
			<path
				d="	M 1300 665
					L 1200 665
					L 1200 555
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableInteriorWaterPipe"
				style="stroke:#0000ff;stroke-width:3"  
			/> 
	   
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Potable Blue #1 Water Pipe -->
			<path
				d="	M 1300 665
					L 1200 665
					L 1200 555
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableBlue1WaterPipe"
				style="stroke:#3232ff;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: 5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Potable Blue #2 Water Pipe -->
			<path
				d="	M 1300 665
					L 1200 665
					L 1200 555
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableBlue2WaterPipe"
				style="stroke:#6666ff;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: 5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Potable Blue #3 Water Pipe -->
			<path
				d="	M 1300 665
					L 1200 665
					L 1200 555
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableBlue3WaterPipe"
				style="stroke:#9999ff;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: 5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Blue #4 Water Pipe -->	
			<path
				d="	M 1300 665
					L 1200 665
					L 1200 555
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableBlue4WaterPipe"
				style="stroke:#ccccff;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: 5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
			
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Potable Black Water Pipe Walls ------------------------------------------------------------------------------------------->
			<path
				d="	M 1200 555
					L 1200 400
					L 1312 400
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableRedBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" 
			/>
	   
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Potable Interior Water Pipe -->
			<path
				d="	M 1200 555
					L 1200 400
					L 1312 400
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableRedInteriorWaterPipe"
				style="stroke:#ff0000;stroke-width:3"  
			/> 
	   
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Potable Red #1 Water Pipe -->
			<path
				d="	M 1200 555
					L 1200 400
					L 1312 400
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableRed1WaterPipe"
				style="stroke:#ff3232;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: 5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Potable Red #2 Water Pipe -->
			<path
				d="	M 1200 555
					L 1200 400
					L 1312 400
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableRed2WaterPipe"
				style="stroke:#ff6666;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: 5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Potable Red #3 Water Pipe -->
			<path
				d="	M 1200 555
					L 1200 400
					L 1312 400
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableRed3WaterPipe"
				style="stroke:#ff9999;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: 5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Domestic Hot Water Shell Heat Exchanger Red #4 Water Pipe -->	
			<path
				d="	M 1200 555
					L 1200 400
					L 1312 400
				"
				fill="none"
				id="DomesticHotWaterShellExchangerPotableRed4WaterPipe"
				style="stroke:#ffcccc;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: 5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
			
		</svg>
		
	</div>	
	
	<!-- DIV for Domestic Hot Water Supply Temp Text (innerHTML change via Javascript) -->
	<div id="DomesticHotWaterSupplyTempTextDIV" style="position: absolute; top: 425px; left: 811px; font-size: 14px; font-weight: bold;" > Domestic Hot Water Supply Temp
	</div>
	
	<!-- DIV for Domestic Hot Water Flat Plate Return Temp Text (innerHTML change via Javascript) -->
	<div id="DomesticHotWaterFlatPlateReturnTempTextDIV" style="position: absolute; top: 575px; left: 841px; font-size: 14px; font-weight: bold;" > Domestic Hot Water Flat Plate Temp
	</div>
	
	<!-- DIV for Domestic Hot Water Shell Return Temp Text (innerHTML change via Javascript) -->
	<div id="DomesticHotWaterShellReturnTempTextDIV" style="position: absolute; top: 732px; left: 832px; font-size: 14px; font-weight: bold;" > Domestic Hot Water Shell Temp
	</div>
	
	<!-- DIV for Domestic Hot Water Potable Supply Temp Text (innerHTML change via Javascript) -->
	<div id="DomesticHotWaterPotableSupplyTempTextDIV" style="position: absolute; top: 500px; left: 1001px; font-size: 14px; font-weight: bold;" > Domestic Hot Water Potable Supply Temp
	</div>
	
	<!-- DIV for Domestic Hot Water Potable Flat Plate Supply Temp Text (innerHTML change via Javascript) -->
	<div id="DomesticHotWaterPotableFlatPlateSupplyTempTextDIV" style="position: absolute; top: 425px; left: 926px; font-size: 14px; font-weight: bold;" > Domestic Hot Water Potable Flat Plate Supply Temp
	</div>
	
	<!-- DIV for Domestic Hot Water Potable Hot Supply Temp Text (innerHTML change via Javascript) -->
	<div id="DomesticHotWaterPotableHotSupplyTempTextDIV" style="position: absolute; top: 395px; left: 1356px; font-size: 14px; font-weight: bold;" > Domestic Hot Water Potable Hot Supply Temp
	</div>
	
	<!-- DIV for Domestic Hot Water Potable Tempered Supply Temp Text (innerHTML change via Javascript) -->
	<div id="DomesticHotWaterPotableTemperedSupplyTempTextDIV" style="position: absolute; top: 560px; left: 1421px; font-size: 14px; font-weight: bold;" > Domestic Hot Water Supply Temp
	</div>
	
	<!-- DIV for Domestic Hot Water Potable Shell Supply Temp Text (innerHTML change via Javascript) -->
	<div id="DomesticHotWaterPotableShellSupplyTempTextDIV" style="position: absolute; top: 730px; left: 1166px; font-size: 14px; font-weight: bold;" > Domestic Hot Water Potable Shell Supply Temp
	</div>
	
	<!-- DIV for Domestic Hot Water Potable Shell Return Temp Text (innerHTML change via Javascript) -->
	<div id="DomesticHotWaterPotableShellReturnTempTextDIV" style="position: absolute; top: 470px; left: 1166px; font-size: 14px; font-weight: bold;" > Domestic Hot Water Potable Shell Return Temp
	</div>
	
	<!-- DIV for House Domestic Hot Water Label Text -->
	<div id="HouseDomesticHotWaterLabelTextDIV" style="position: absolute; top: 350px; left: 916px; font-size: 20px; font-weight: bold;" >House Domestic Hot Water
	</div>
	
	<!-- DIV for House Domestic Hot Water Border SVG -->
	<div id="HouseForcedAirBorderSVGDIV" style="position: absolute; background-color: transparent;" >
		<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<svg
			xmlns:svg="http://www.w3.org/2000/svg"
			xmlns="http://www.w3.org/2000/svg"
			version="1.1"
			width="1800"
			height="1600"
		>
			<style type="text/css">  
				@keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-moz-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-webkit-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
			</style>  
  
			<!-- Drawing of Domestic Hot Water Border -->
			<path
				d="	M 736 335
					L 1616 335
					L 1616 820
					L 736 820
					L 736 335
				"
				fill="none"
				id="HouseDomesticHotWaterBorder"
				style="stroke:#000000;stroke-width:3;stroke-dasharray:5,5;" 
			/>
	</div>
	
</body>

	<!-- DIV for Garage Hanging Heater SVG -->
	<div id="GarageHangingHeaterSVGDIV" style="position: absolute; top: 350px; left: 0px; background-color: transparent;" >
		<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<svg
			xmlns:svg="http://www.w3.org/2000/svg"
			xmlns="http://www.w3.org/2000/svg"
			version="1.1"
			width="1800"
			height="800"
		>
			<style type="text/css">  
				@keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-moz-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-webkit-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
			</style>  
  
			<!-- Drawing of Air Handling Unit -->
			<path
				d="	M 375 730
					L 230 730
					M 375 640
					L 230 640
				"
				fill="none"
				id="AirHandlingUnit"
				style="stroke:#000000;stroke-width:3" 
			/>
			
			<!-- Drawing of Air Handling Unit Heat Exchanger Fins -->
			<path
				d="
				M 250 725
				L 290 725
				M 250 720
				L 290 720
				M 250 715
				L 290 715
				M 250 710
				L 290 710
				M 250 705
				L 290 705
				M 250 700
				L 290 700
				M 250 695
				L 290 695
				M 250 690
				L 290 690
				M 250 685
				L 290 685
				M 250 680
				L 290 680
				M 250 675
				L 290 675
				M 250 670
				L 290 670
				M 250 665
				L 290 665
				M 250 660
				L 290 660
				M 250 655
				L 290 655
				M 250 650
				L 290 650
				M 250 645
				L 290 645
				"
				fill="none"
				id="AirHandlingUnitFins"
				style="stroke:#000000;stroke-width:1" 
			/>
			
	</div>
	
</body>

	<!-- DIV for Garage Hanging Heater Fan -->
	<div id="GarageHanginHeaterFanDIV" style="position: absolute; top: 1000px; left: 300px; width: 70; height: 70; background-color: transparent;" >
		<img id="GarageHangingHeaterFan" src="/images/fan.png" style='height: 100%; width: 100%; object-fit: contain'/>
	</div>

	<!-- DIV for Garage Supply Temp Text (innerHTML change via Javascript) -->
	<div id="GarageSupplyTempTextDIV" style="position: absolute; top: 1095px; left: 210px; font-size: 14px; font-weight: bold;" > Garage Supply Temp
	</div>
	
	<!-- DIV for Garage Return Temp Text (innerHTML change via Javascript) -->
	<div id="GarageReturnTempTextDIV" style="position: absolute; top: 1060px; left: 390px; font-size: 14px; font-weight: bold;" > Garage Return Temp
	</div>
	
	<!-- DIV for Dog House Infloor Heating Mixing Valve Image -->
	<div id="DomesticHotWaterMixingValveDIV" style="position: absolute; top: 1230px; left: 450px; width: 75px; height: 75px; background-color: transparent;" >
		<img src="/images/mixingvalve.png" style='height: 100%; width: 100%; object-fit: contain'/>
	</div>

	<!-- DIV for Dog House Infloor Water Pipe -->
	<div id="HouseWaterPipeDIV" style="position: absolute; top: 850px; left: 0px;" >
		<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<svg
			xmlns:svg="http://www.w3.org/2000/svg"
			xmlns="http://www.w3.org/2000/svg"
			version="1.1"
			width="1024"
			height="768"
		>
			<style type="text/css">  
				@keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-moz-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-webkit-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
			</style>  
  
			<!-- Path of Dog House Infloor Supply Black Water Pipe Walls -->
			<path
				d="M488,454
				L488,540
				L438,540
				M401,540
				L350,540
				Q335,450 320,540
				Q305,630 290,540
				Q275,450 260,540
				Q245,630 230,540
				Q215,450 200,540
				Q185,630 170,540
				L118,540
				"
				fill="none"
				id="DogHouseInfloorSupplyBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" 
			/>
	   
			<!-- Path of Dog House Infloor Supply Red Interior Water Pipe -->
			<path
				d="M488,454
				L488,540
				L438,540
				M401,540
				L350,540
				Q335,450 320,540
				Q305,630 290,540
				Q275,450 260,540
				Q245,630 230,540
				Q215,450 200,540
				Q185,630 170,540
				L118,540
				"
				fill="none"
				id="DogHouseInfloorSupplyRedInteriorWaterPipe"
				style="stroke:#ff0000;stroke-width:3" 
			/> 
	   
			<!-- Path of Dog House Infloor Supply Red #1 Water Pipe -->
			<path
				d="M488,454
				L488,540
				L438,540
				M401,540
				L350,540
				Q335,450 320,540
				Q305,630 290,540
				Q275,450 260,540
				Q245,630 230,540
				Q215,450 200,540
				Q185,630 170,540
				L118,540
				"
				fill="none"
				id="DogHouseInfloorSupplyRed1WaterPipe"
				style="stroke:#ff3232;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Dog House Infloor Supply Red #2 Water Pipe -->
			<path
				d="M488,454
				L488,540
				L438,540
				M401,540
				L350,540
				Q335,450 320,540
				Q305,630 290,540
				Q275,450 260,540
				Q245,630 230,540
				Q215,450 200,540
				Q185,630 170,540
				L118,540
				"
				fill="none"
				id="DogHouseInfloorSupplyRed2WaterPipe"
				style="stroke:#ff6666;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Dog House Infloor Supply Red #3 Water Pipe -->
			<path
				d="M488,454
				L488,540
				L438,540
				M401,540
				L350,540
				Q335,450 320,540
				Q305,630 290,540
				Q275,450 260,540
				Q245,630 230,540
				Q215,450 200,540
				Q185,630 170,540
				L118,540
				"
				fill="none"
				id="DogHouseInfloorSupplyRed3WaterPipe"
				style="stroke:#ff9999;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of Dog House Infloor Supply Red #4 Water Pipe -->	
			<path
				d="M488,454
				L488,540
				L438,540
				M401,540
				L350,540
				Q335,450 320,540
				Q305,630 290,540
				Q275,450 260,540
				Q245,630 230,540
				Q215,450 200,540
				Q185,630 170,540
				L118,540
				"
				fill="none"
				id="DogHouseInfloorSupplyRed4WaterPipe"
				style="stroke:#ffcccc;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
			
			<!-- Path of Dog House Infloor Return Black Water Pipe Walls ----------------------------------------------------------------------------------------->
			<path
				d="M120,542
				L120,412
				L450,412
				M400,413
				L400,368
				"
				fill="none"
				id="DogHouseInfloorReturnBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:5" 
			/>
	   
			<!-- Path of Dog House Infloor Return Blue Interior Water Pipe -->
			<path
				d="M120,542
				L120,412
				L450,412
				M400,413
				L400,368
				"
				fill="none"
				id="DogHouseInfloorReturnBlue1InteriorWaterPipe"
				style="stroke:#0000ff;stroke-width:3" 
			/> 
	   
			<!-- Path of Dog House Infloor Return Blue #1 Water Pipe -->
			<path
				d="M120,542
				L120,412
				L450,412
				M400,413
				L400,368
				"
				fill="none"
				id="DogHouseInfloorReturnBlue1WaterPipe"
				style="stroke:#3232ff;stroke-width:3;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Dog House Infloor Return Blue #2 Water Pipe -->
			<path
				d="M120,542
				L120,412
				L450,412
				M400,413
				L400,368
				"
				fill="none"
				id="DogHouseInfloorReturnBlue2WaterPipe"
				style="stroke:#6666ff;stroke-width:3;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Dog House Infloor Return Blue #3 Water Pipe -->
			<path
				d="M120,542
				L120,412
				L450,412
				M400,413
				L400,368
				"
				fill="none"
				id="DogHouseInfloorReturnBlue3WaterPipe"
				style="stroke:#9999ff;stroke-width:3;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of Dog House Infloor Return Blue #4 Water Pipe -->	
			<path
				d="M120,542
				L120,412
				L450,412
				M400,413
				L400,368
				"
				fill="none"
				id="DogHouseInfloorReturnBlue4WaterPipe"
				style="stroke:#ccccff;stroke-width:3;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		</svg>
		
	</div>
	
	<!-- DIV for Dog House Infloor Circulator -->
	<div id="Dog House InfloorCirculatorDIV" style="position: absolute; top: 1367px; left: 400px; width: 40px; height: 40px; background-color: transparent;" >
		<img src="/images/circ.png" style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; object-fit: contain"/>
		<svg width="100" height="100" viewbox="-22 -23 145 145">
			<polygon points="0,0 20,10 0,20">
				<animateTransform 
					id="Dog House InfloorCirculator"
					attributeName="transform"
					attributeType="css"
					type="rotate"
					from="360 7 10"
					to="0 7 10"
					dur="1"
					repeatCount="indefinite"
				/>
			</polygon>
			
		</svg>
	</div>
	
	<!-- DIV for House Master Bathroom Towel Warmer and Infloor Heat -->
	<div id="HouseMasterBathTowelWarmerInfloorPipeDIV" style="position: absolute; top: 0px; left: 0px;" >
		<?xml version="1.0" encoding="UTF-8" standalone="no"?>
		<svg
			xmlns:svg="http://www.w3.org/2000/svg"
			xmlns="http://www.w3.org/2000/svg"
			version="1.1"
			width="1600"
			height="1800"
		>
			<style type="text/css">  
				@keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-moz-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
				@-webkit-keyframes move {  
					from {  stroke-dashoffset: 96;  }  
					to   {  stroke-dashoffset: 0;  }  
				}  
			</style>  
  
			<!-- Path of House Master Bath Towel Warmer and Infloor Supply Black Water Pipe Walls -->
			<path
				d="M945,1150
				L945,920
				L1100,920
				L1100,950
				L960,950
				L960,980
				L1100,980
				L1100,1010
				L960,1010
				L960,1040
				L1100,1040
				L1100,1070
				L960,1070
				L960,1100
				L1100,1100
				L1100,1170
				L1400,1170
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorSupplyBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:7" 
			/>
	   
			<!-- Path of House Master Bath Towel Warmer and Infloor Supply Red Interior Water Pipe -->
			<path
				d="M945,1150
				L945,920
				L1100,920
				L1100,950
				L960,950
				L960,980
				L1100,980
				L1100,1010
				L960,1010
				L960,1040
				L1100,1040
				L1100,1070
				L960,1070
				L960,1100
				L1100,1100
				L1100,1170
				L1400,1170
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorSupplyRedInteriorWaterPipe"
				style="stroke:#ff0000;stroke-width:5" 
			/> 
	   
			<!-- Path of House Master Bath Towel Warmer and Infloor Supply Red #1 Water Pipe -->
			<path
				d="M945,1150
				L945,920
				L1100,920
				L1100,950
				L960,950
				L960,980
				L1100,980
				L1100,1010
				L960,1010
				L960,1040
				L1100,1040
				L1100,1070
				L960,1070
				L960,1100
				L1100,1100
				L1100,1170
				L1400,1170
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorSupplyRed1WaterPipe"
				style="stroke:#ff3232;stroke-width:5;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of House Master Bath Towel Warmer and Infloor Supply Red #2 Water Pipe -->
			<path
				d="M945,1150
				L945,920
				L1100,920
				L1100,950
				L960,950
				L960,980
				L1100,980
				L1100,1010
				L960,1010
				L960,1040
				L1100,1040
				L1100,1070
				L960,1070
				L960,1100
				L1100,1100
				L1100,1170
				L1400,1170
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorSupplyRed2WaterPipe"
				style="stroke:#ff6666;stroke-width:5;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of House Master Bath Towel Warmer and Infloor Supply Red #3 Water Pipe -->
			<path
				d="M945,1150
				L945,920
				L1100,920
				L1100,950
				L960,950
				L960,980
				L1100,980
				L1100,1010
				L960,1010
				L960,1040
				L1100,1040
				L1100,1070
				L960,1070
				L960,1100
				L1100,1100
				L1100,1170
				L1400,1170
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorSupplyRed3WaterPipe"
				style="stroke:#ff9999;stroke-width:5;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;"  
			/>
		
			<!-- Path of House Master Bath Towel Warmer and Infloor Supply Red #4 Water Pipe -->	
			<path
				d="M945,1150
				L945,920
				L1100,920
				L1100,950
				L960,950
				L960,980
				L1100,980
				L1100,1010
				L960,1010
				L960,1040
				L1100,1040
				L1100,1070
				L960,1070
				L960,1100
				L1100,1100
				L1100,1170
				L1400,1170
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorSupplyRed4WaterPipe"
				style="stroke:#ffcccc;stroke-width:5;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
			
			<!-- Path of House Master Bath Towel Warmer and Infloor Return Black Water Pipe Walls ----------------------------------------------------------------------------------------->
			<path
				d="M709,1600
				
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorReturnBlackWaterPipeWalls"
				style="stroke:#000000;stroke-width:9" 
			/>
	   
			<!-- Path of House Master Bath Towel Warmer and Infloor Return Blue Interior Water Pipe -->
			<path
				d="M709,1600
				
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorReturnBlue1InteriorWaterPipe"
				style="stroke:#0000ff;stroke-width:7" 
			/> 
	   
			<!-- Path of House Master Bath Towel Warmer and Infloor Return Blue #1 Water Pipe -->
			<path
				d="M709,1600
				
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorReturnBlue1WaterPipe"
				style="stroke:#3232ff;stroke-width:7;stroke-dasharray:0, 12, 72, 13;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of House Master Bath Towel Warmer and Infloor Return Blue #2 Water Pipe -->
			<path
				d="M709,1600
				
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorReturnBlue2WaterPipe"
				style="stroke:#6666ff;stroke-width:7;stroke-dasharray:0, 24, 48, 24;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of House Master Bath Towel Warmer and Infloor Return Blue #3 Water Pipe -->
			<path
				d="M709,1600
				
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorReturnBlue3WaterPipe"
				style="stroke:#9999ff;stroke-width:7;stroke-dasharray:0, 36, 24, 36;
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		
			<!-- Path of House Master Bath Towel Warmer and Infloor Return Blue #4 Water Pipe -->	
			<path
				d="M709,1600
				
				"
				fill="none"
				id="HouseMasterBathTowelWarmerandInfloorReturnBlue4WaterPipe"
				style="stroke:#ccccff;stroke-width:7;stroke-dasharray:0, 45, 6, 45;   
				animation-duration: .5s;  
				animation-name: move; 
				animation-timing-function: linear; 
				animation-iteration-count: infinite;" 
			/>
		</svg>
		
	</div>	
	
	
	<!-- DIV for googleBarChart  -->
	<div id="googleColumnChart" style="position: absolute; top: 650px; left: 10px; width: 600px; height: 300px; background-color: transparent;" >
	</div>
	
	<!-- DIV for googleChart  -->
	<div id="googleChartDIV" style="position: absolute; top: 350px; left: 10px; width: 600px; height: 300px; background-color: transparent;" >
	</div>

	
	<!-- Javascript for water pipe -->
	<script type="text/javascript">
	
	/* Initialize variables for water pipe speed */
	var M250SupplyReturnSpeedString = String(M250SupplyReturnSpeed) + "s";
	var HouseSupplyReturnSpeedString = String(HouseSupplyReturnSpeed) + "s";
	var AirHandlingUnitSupplyReturnSpeedString = String(AirHandlingUnitSupplyReturnSpeed) + "s";
	var DomesticHotWaterSupplyReturnSpeedString = String(DomesticHotWaterSupplyReturnSpeed) + "s";
	var DomesticHotWaterPotableSpeedString = String(DomesticHotWaterPotableSpeed) + "s";
	
	
	/* Set the M250 supply & return water pipe animation duration attribute */
	document.getElementById("M250Supply1Red1WaterPipe").style.animationDuration = M250SupplyReturnSpeedString;
	document.getElementById("M250Supply1Red2WaterPipe").style.animationDuration = M250SupplyReturnSpeedString;
	document.getElementById("M250Supply1Red3WaterPipe").style.animationDuration = M250SupplyReturnSpeedString;
	document.getElementById("M250Supply1Red4WaterPipe").style.animationDuration = M250SupplyReturnSpeedString;
	document.getElementById("M250Return1Blue1WaterPipe").style.animationDuration = M250SupplyReturnSpeedString;
	document.getElementById("M250Return1Blue2WaterPipe").style.animationDuration = M250SupplyReturnSpeedString;
	document.getElementById("M250Return1Blue3WaterPipe").style.animationDuration = M250SupplyReturnSpeedString;
	document.getElementById("M250Return1Blue4WaterPipe").style.animationDuration = M250SupplyReturnSpeedString;
	
	/* Set the House supply & return water pipe animation duration attribute */ 
	document.getElementById("HouseSupplyRed1WaterPipe").style.animationDuration = HouseSupplyReturnSpeedString;
	document.getElementById("HouseSupplyRed2WaterPipe").style.animationDuration = HouseSupplyReturnSpeedString;
	document.getElementById("HouseSupplyRed3WaterPipe").style.animationDuration = HouseSupplyReturnSpeedString;
	document.getElementById("HouseSupplyRed4WaterPipe").style.animationDuration = HouseSupplyReturnSpeedString;
	document.getElementById("HouseReturnBlue1WaterPipe").style.animationDuration = HouseSupplyReturnSpeedString;
	document.getElementById("HouseReturnBlue2WaterPipe").style.animationDuration = HouseSupplyReturnSpeedString;
	document.getElementById("HouseReturnBlue3WaterPipe").style.animationDuration = HouseSupplyReturnSpeedString;
	document.getElementById("HouseReturnBlue4WaterPipe").style.animationDuration = HouseSupplyReturnSpeedString;
	
	/* Set the Air Handling Unit supply & return water pipe animation duration attribute */ 
	document.getElementById("AirHandlingUnitSupplyRed1WaterPipe").style.animationDuration = AirHandlingUnitSupplyReturnSpeedString;
	document.getElementById("AirHandlingUnitSupplyRed2WaterPipe").style.animationDuration = AirHandlingUnitSupplyReturnSpeedString;
	document.getElementById("AirHandlingUnitSupplyRed3WaterPipe").style.animationDuration = AirHandlingUnitSupplyReturnSpeedString;
	document.getElementById("AirHandlingUnitSupplyRed4WaterPipe").style.animationDuration = AirHandlingUnitSupplyReturnSpeedString;
	document.getElementById("AirHandlingUnitBlue1WaterPipe").style.animationDuration = AirHandlingUnitSupplyReturnSpeedString;
	document.getElementById("AirHandlingUnitBlue2WaterPipe").style.animationDuration = AirHandlingUnitSupplyReturnSpeedString;
	document.getElementById("AirHandlingUnitBlue3WaterPipe").style.animationDuration = AirHandlingUnitSupplyReturnSpeedString;
	document.getElementById("AirHandlingUnitBlue4WaterPipe").style.animationDuration = AirHandlingUnitSupplyReturnSpeedString;
	
	/* Set the Domestic Hot Water supply & return water pipe animation duration attribute */ 
	document.getElementById("DomesticHotWaterSupplyRed1WaterPipe").style.animationDuration = DomesticHotWaterSupplyReturnSpeedString;
	document.getElementById("DomesticHotWaterSupplyRed2WaterPipe").style.animationDuration = DomesticHotWaterSupplyReturnSpeedString;
	document.getElementById("DomesticHotWaterSupplyRed3WaterPipe").style.animationDuration = DomesticHotWaterSupplyReturnSpeedString;
	document.getElementById("DomesticHotWaterSupplyRed4WaterPipe").style.animationDuration = DomesticHotWaterSupplyReturnSpeedString;
	document.getElementById("DomesticHotWaterBlue1WaterPipe").style.animationDuration = DomesticHotWaterSupplyReturnSpeedString;
	document.getElementById("DomesticHotWaterBlue2WaterPipe").style.animationDuration = DomesticHotWaterSupplyReturnSpeedString;
	document.getElementById("DomesticHotWaterBlue3WaterPipe").style.animationDuration = DomesticHotWaterSupplyReturnSpeedString;
	document.getElementById("DomesticHotWaterBlue4WaterPipe").style.animationDuration = DomesticHotWaterSupplyReturnSpeedString;
	
	/* Set the Domestic Hot Water potable water pipe animation duration attribute */ 
	document.getElementById("DomesticHotWaterPotableHotRed1WaterPipe").style.animationDuration = DomesticHotWaterPotableSpeedString;
	document.getElementById("DomesticHotWaterPotableHotRed2WaterPipe").style.animationDuration = DomesticHotWaterPotableSpeedString;
	document.getElementById("DomesticHotWaterPotableHotRed3WaterPipe").style.animationDuration = DomesticHotWaterPotableSpeedString;
	document.getElementById("DomesticHotWaterPotableHotRed4WaterPipe").style.animationDuration = DomesticHotWaterPotableSpeedString;
	document.getElementById("DomesticHotWaterPotableColdBlue1WaterPipe").style.animationDuration = DomesticHotWaterPotableSpeedString;
	document.getElementById("DomesticHotWaterPotableColdBlue2WaterPipe").style.animationDuration = DomesticHotWaterPotableSpeedString;
	document.getElementById("DomesticHotWaterPotableColdBlue3WaterPipe").style.animationDuration = DomesticHotWaterPotableSpeedString;
	document.getElementById("DomesticHotWaterPotableColdBlue4WaterPipe").style.animationDuration = DomesticHotWaterPotableSpeedString;
	
	</script>
	
	<!-- Javascript for gauges and texts -->
	<script type="text/javascript">

	/* Update gauge1 Text query, */
	function updatetext() {
		
		/* M250 Supply 1 Temp Text Update */
		if (M250Supply1WaterTemp < 180) {
			document.getElementById("M250Supply1WaterTempTextDIV").innerHTML = M250Supply1WaterTemp+'&#176';
			document.getElementById("M250Supply1WaterTempTextDIV").style.color = "blue";
			
		} else if (M250Supply1WaterTemp > 190) {
			document.getElementById("M250Supply1WaterTempTextDIV").innerHTML = M250Supply1WaterTemp+'&#176';
			document.getElementById("M250Supply1WaterTempTextDIV").style.color = "red";
			
		} else {
			document.getElementById("M250Supply1WaterTempTextDIV").innerHTML = M250Supply1WaterTemp+'&#176';
			document.getElementById("M250Supply1WaterTempTextDIV").style.color = "green";	
		};
		
		/* M250 Return 1 Temp Text Update */
		document.getElementById("M250Return1WaterTempTextDIV").innerHTML = M250Return1WaterTemp+'&#176';
		
		/* M250 Supply 2 Temp Text Update */
		if (M250Supply2WaterTemp < 180) {
			document.getElementById("M250Supply2WaterTempTextDIV").innerHTML = M250Supply2WaterTemp+'&#176';
			document.getElementById("M250Supply2WaterTempTextDIV").style.color = "blue";
			
		} else if (M250Supply2WaterTemp > 190) {
			document.getElementById("M250Supply2WaterTempTextDIV").innerHTML = M250Supply2WaterTemp+'&#176';
			document.getElementById("M250Supply2WaterTempTextDIV").style.color = "red";
			
		} else {
			document.getElementById("M250Supply2WaterTempTextDIV").innerHTML = M250Supply2WaterTemp+'&#176';
			document.getElementById("M250Supply2WaterTempTextDIV").style.color = "green";	
		};
		
		
		
		/* M250 Stack Temp update */
		document.getElementById("M250StackTempDIV").innerHTML = 'Stack Temp '+M250StackTemp+'&#176';
		
		/* M250 Hopper Level update */
		document.getElementById("M250HopperLevelDIV").innerHTML = 'Hopper <br> Level '+M250HopperLevel+'%';
		
		/* M250 Supply 1 Water Level Text Update */
		if (M250WaterLevel > 0) {
			
			document.getElementById("M250WaterLevelDIV").innerHTML = 'Water Level OK!';
			document.getElementById("M250WaterLevelDIV").style.color = "black";
			
		} else {
			document.getElementById("M250WaterLevelDIV").innerHTML = 'Water Level LOW!';
			document.getElementById("M250WaterLevelDIV").style.color = "red";
		};
		
		var HouseBTUs = HouseReturnFlowRate * (HouseSupplyWaterTemp - HouseReturnWaterTemp) * 500;
		var HouseBTUsFixed = HouseBTUs.toFixed(0);
		var AirHandlingUnitBTUs = AirHandlingUnitReturnFlowRate * (AirHandlingUnitSupplyWaterTemp - AirHandlingUnitReturnWaterTemp) * 500;
		var AirHandlingUnitBTUsFixed = AirHandlingUnitBTUs.toFixed(0);
		var DomesticHotWaterFlatPlateBTUs = DomesticHotWaterSupplyFlowRate * (DomesticHotWaterSupplyWaterTemp - DomesticHotWaterFlatPlateReturnWaterTemp) * 500;
		var DomesticHotWaterFlatPlateBTUsFixed = DomesticHotWaterFlatPlateBTUs.toFixed(0);
		var DomesticHotWaterShellBTUs = DomesticHotWaterSupplyFlowRate * (DomesticHotWaterFlatPlateReturnWaterTemp - DomesticHotWaterShellReturnWaterTemp) * 500;
		var DomesticHotWaterShellBTUsFixed = DomesticHotWaterShellBTUs.toFixed(0);
		var DomesticHotWaterTotalBTUs = DomesticHotWaterFlatPlateBTUs + DomesticHotWaterShellBTUs;
		var DomesticHotWaterTotalBTUsFixed = DomesticHotWaterTotalBTUs.toFixed(0);
		var GarageBTUs = GarageReturnFlowRate * (GarageSupplyWaterTemp - GarageReturnWaterTemp) * 500;
		var GarageBTUsFixed = GarageBTUs.toFixed(0);
		
		
		/* House Supply Water Temp update */
		document.getElementById("HouseWaterSupplyTempTextDIV").innerHTML = HouseSupplyWaterTemp+'&#176';
		
		/*House Return Water Temp and BTU update */
		document.getElementById("HouseWaterReturnTempTextDIV").innerHTML = HouseReturnWaterTemp+'&#176 @ '+HouseReturnFlowRate+' GPM <br>'+HouseBTUsFixed+' BTU';
		
		/* Air Handling Unit Supply Water Temp update */
		document.getElementById("AirHandlingUnitWaterSupplyTempTextDIV").innerHTML = AirHandlingUnitSupplyWaterTemp+'&#176';
		
		/* Air Handling Unit Return Water Temp update */
		document.getElementById("AirHandlingUnitWaterReturnTempTextDIV").innerHTML = AirHandlingUnitReturnWaterTemp+'&#176 @ '+AirHandlingUnitReturnFlowRate+' GPM';
		
		/* Air Handling Unit BTUs Consumed update */
		document.getElementById("AirHandlingUnitWaterReturnBTUTextDIV").innerHTML = AirHandlingUnitBTUsFixed+' BTUs';
		
		/* Air Handling Unit Supply Air Temp update */
		document.getElementById("AirHandlingUnitAirSupplyTempTextDIV").innerHTML = 'Supply Air Temp '+AirHandlingUnitSupplyAirTemp+'&#176 / '+AirHandlingUnitSupplyAirRH+'% RH @ '+AirHandlingUnitSupplyAirCFM+' CFM';
		
		/* Air Handling Unit Return Air Temp update */
		document.getElementById("AirHandlingUnitAirReturnTempTextDIV").innerHTML = 'Return Air Temp '+AirHandlingUnitReturnAirTemp+'&#176 / '+AirHandlingUnitReturnAirRH+'% RH';
		
		/* Domestic Hot Water Supply Water Temp update */
		document.getElementById("DomesticHotWaterSupplyTempTextDIV").innerHTML = DomesticHotWaterSupplyWaterTemp+'&#176';
		
		/* Domestic Hot Water Flat Plate Return Water Temp update */
		document.getElementById("DomesticHotWaterFlatPlateReturnTempTextDIV").innerHTML = DomesticHotWaterFlatPlateReturnWaterTemp+'&#176 @ '+DomesticHotWaterSupplyFlowRate+' GPM<br/>'+DomesticHotWaterFlatPlateBTUsFixed+' BTUs Consumed by Flat Plate Exchanger';
		
		/* Domestic Hot Water Shell Return Water Temp update */
		document.getElementById("DomesticHotWaterShellReturnTempTextDIV").innerHTML = DomesticHotWaterShellReturnWaterTemp+'&#176 @ '+DomesticHotWaterSupplyFlowRate+' GPM<br/>'+DomesticHotWaterShellBTUsFixed+' BTUs Consumed by Shell Exchanger<br/>'+DomesticHotWaterTotalBTUsFixed+' BTUs Consumed for Domestic Hot Water';
		
		/* Domestic Hot Water Potable Supply Temp update */
		document.getElementById("DomesticHotWaterPotableSupplyTempTextDIV").innerHTML = 'Potable Water Supply<br/>' + DomesticHotWaterPotableSupplyTemp + '&#176 @ '+DomesticHotWaterPotableSupplyFlowRate+' GPM';
		
		/* Domestic Hot Water Potable Flat Plate Supply Temp update */
		document.getElementById("DomesticHotWaterPotableFlatPlateSupplyTempTextDIV").innerHTML = DomesticHotWaterPotableFlatPlateSupplyTemp + '&#176';
		
		/* Domestic Hot Water Potable Hot Supply Temp update */
		document.getElementById("DomesticHotWaterPotableHotSupplyTempTextDIV").innerHTML = DomesticHotWaterPotableHotSupplyTemp + '&#176';
		
		/* Domestic Hot Water Potable Tempered Supply Temp update */
		document.getElementById("DomesticHotWaterPotableTemperedSupplyTempTextDIV").innerHTML = DomesticHotWaterPotableTemperedSupplyTemp + '&#176<br/> To Domestic Distrobution';
		
		/* Domestic Hot Water Potable Shell Supply Temp update */
		document.getElementById("DomesticHotWaterPotableShellSupplyTempTextDIV").innerHTML = DomesticHotWaterPotableShellSupplyTemp + '&#176';
		
		/* Domestic Hot Water Potable Shell Return Temp update */
		document.getElementById("DomesticHotWaterPotableShellReturnTempTextDIV").innerHTML = DomesticHotWaterPotableShellReturnTemp + '&#176';
		
		/* Garage Supply Water Temp update */
		document.getElementById("GarageSupplyTempTextDIV").innerHTML = GarageSupplyWaterTemp+'&#176';
		
		/* Garage Return Water Temp update */
		document.getElementById("GarageReturnTempTextDIV").innerHTML = GarageReturnWaterTemp+'&#176 @ '+GarageReturnFlowRate+' GPM<br/>'+GarageBTUsFixed+' BTUs Consumed by Garage<br/>';
		
		/* Set the rmp variable of M250Supply1CirculatorRPM to animateTransform duration attribute */
		document.getElementById("M250Supply1Circulator").setAttribute("dur",M250Supply1CirculatorRPM);
	
		/* Set the rmp variable of M250Supply2CirculatorRPM to animateTransform duration attribute */
		document.getElementById("M250Supply2Circulator").setAttribute("dur",M250Supply2CirculatorRPM);
	
		/* Set the rmp variable of AirHandlingUnitCirculator to the animateTransform duration attribute */
		document.getElementById("AirHandlingUnitCirculatorTriangle").setAttribute("dur",AirHandlingUnitCirculatorRPM);
		
		/* Set the rmp variable of DomesticHotWaterCirculator to the animateTransform duration attribute */
		document.getElementById("DomesticHotWaterCirculatorTriangle").setAttribute("dur",DomesticHotWaterCirculatorRPM);
		
		
		/* Air Handling Unit Electric Strips Text Update */
		if (AirHandlingUnitElectricStripPower < 1) {
			document.getElementById("AirHandlingUnitBackupElectricStripsTextDIV").innerHTML = 'Backup Electric Strips Off';
			document.getElementById("AirHandlingUnitBackupElectricStripsTextDIV").style.color = "black";
			document.getElementById("AirHandlingUnitBackupElectricStrips").style.stroke = "black"
			
		} else {
			document.getElementById("AirHandlingUnitBackupElectricStripsTextDIV").innerHTML = 'Backup Electric Strips On!';
			document.getElementById("AirHandlingUnitBackupElectricStripsTextDIV").style.color = "red";	
			document.getElementById("AirHandlingUnitBackupElectricStrips").style.stroke = "red"

		};
		
		
		
	
    };
	
	/* Call update function so there is no delay for the first call */
	updatetext();
	
	/* Set query update frequency */
	updatetextInterval = setInterval(updatetext,1000);
	
	</script>
	</div>
</body>
</html>





