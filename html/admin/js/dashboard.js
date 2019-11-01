$(document).ready(function(){

	'use strict';

	


	// Tooltip for flot chart
	function showTooltip(x, y, contents) {
		$('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
			position: 'absolute',
			display: 'none',
			top: y + 5,
			left: x + 5
		}).appendTo('body').fadeIn(200);
	}

	var newCust = [
		[0, 50], [0.5, 65], [1,55], [1.5, 62], [2, 55],
		[2.5, 58], [3, 65], [3.5, 58], [4, 63], [4.5, 65],
		[5, 83], [5.5, 78], [6, 80]
	];

	var retCust = [[0, 20], [0.5, 35], [1,20], [1.5, 25], [2, 17], [2.5, 10], [3,15], [3.5,28],
		[4,15], [4.5,20], [5,35], [5.5,30], [6,32]];

	var plot = $.plot($('#basicflot'),[{
		data: newCust,
		label: 'New Visitors',
		color: '#cfd3da'
	},
	{
		data: retCust,
		label: 'Returning Visitors',
		color: '#06b5cf',
	}],
	{
		series: {
			lines: {
				show: false,
			},

			splines: {
				show: true,
				tension: 0.3,
				lineWidth: 2,
				fill: .50
			},

			shadowSize: 0
		},

		points: { show: true },

		legend: {
			container: '#basicFlotLegend',
			noColumns: 0
		},

		grid: {
			hoverable: true,
			clickable: true,
			borderColor: '#f3f5f7',
			borderWidth: 0,
			labelMargin: 5
		},

		yaxis: {
			min: 0,
			max: 100,
			color: '#f3f5f7'
		},

		xaxis: { color: '#f3f5f7' }

	});

	var previousPoint = null;

	$('#basicflot').bind('plothover', function (event, pos, item) {
		$('#x').text(pos.x.toFixed(2));
		$('#y').text(pos.y.toFixed(2));

		if(item) {
			if (previousPoint != item.dataIndex) {
				previousPoint = item.dataIndex;

				$('#tooltip').remove();
				var x = item.datapoint[0].toFixed(2),
				y = item.datapoint[1].toFixed(2);

				showTooltip(item.pageX, item.pageY, item.series.label + ' of ' + x + ' = ' + y);
			}

		} else {
			$('#tooltip').remove();
			previousPoint = null;
		}
	});

	$('#basicflot').bind('plotclick', function (event, pos, item) {
		if (item) {
			plot.highlight(item.series, item.datapoint);
		}
	});

	// Knob
	$('.dial-success').knob({
		readOnly: true,
		width: '70px',
		bgColor: '#E7E9EE',
		fgColor: '#259CAB',
		inputColor: '#262B36'
	});

	$('.dial-danger').knob({
		readOnly: true,
		width: '70px',
		bgColor: '#E7E9EE',
		fgColor: '#D9534F',
		inputColor: '#262B36'
	});

	$('.dial-info').knob({
		readOnly: true,
		width: '70px',
		bgColor: '#66BAC4',
		fgColor: '#fff',
		inputColor: '#fff'
	});

	$('.dial-warning').knob({
		readOnly: true,
		width: '70px',
		bgColor: '#E48684',
		fgColor: '#fff',
		inputColor: '#fff'
	});


});
