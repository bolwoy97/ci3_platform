$(function(e) {	
	
	/* chartjs Float Chart*/
	var plot1 = $.plot('#flotChart', [{
		data: flotSampleData4,
		color: '#006fff',
	}], {
		series: {
			shadowSize: 0,
			lines: {
				show: true,
				lineWidth: 2,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0
					}, {
						opacity: 0
					}]
				}
			}
		},
		
		grid: {
			borderWidth: 0,
			borderColor: '#e5e5e5',
			hoverable: true
		},
		yaxis: {
			tickColor: 'rgba(142, 156, 173,0.1)',
			font: {
				color: '#5f6d7a',
				size: 10
			},
			ticks: [[0, '$1.00'], [0.05, '$1.05'], [0.10, '$1.10'], [0.15, '$1.15'], [0.20, '$1.20'], [0.25, '$1.25'], [.30, '$1.30'], [0.35, '$1.35']],
		},
		xaxis: {
			tickColor: 'rgba(142, 156, 173,0.1)',
			font: {
				color: '#5f6d7a',
				size: 10
			},
			ticks: [
				[0, '10.09'],
				[10, '11.09'],
				[20, '12.09'],
				[30, '13.09'],
				[40, '14.09'],
				[50, '15.09'],
				[60, '16.09'],
				[70, '17.09'],
				[80, '18.09'],
				[90, '19.09'],
				[100, '20.09'],
				[110, '21.09'],
                [120, '21.09'],
                [130, '21.09'],
			],
		}
	});
	/* chartjs Float Closed*/
	
	/* chartjs Float Chart*/
	var plot2 = $.plot('#flotChart2', [{
		data: flotSampleData2,
		color: 'rgb(0, 111, 255)',
	}], {
		series: {
			shadowSize: 0,
			lines: {
				show: true,
				lineWidth: 2,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0
					}, {
						opacity: 0.5
					}]
				}
			}
		},
		grid: {
			borderWidth: 0,
			labelMargin: 3
		},
		yaxis: {
			show: false,
			min: 0,
			max: 100
		},
		xaxis: {
			show: false
		}
	});
	/* chartjs Float Closed*/
	
	/* chartjs Float Chart*/
	var plot3 = $.plot('#flotChart3', [{
		data: flotSampleData4,
		color: 'rgba(59, 208, 152, 0.5)',
	}], {
		series: {
			shadowSize: 0,
			lines: {
				show: true,
				lineWidth: 2,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0
					}, {
						opacity: 0.5
					}]
				}
			}
		},
		grid: {
			borderWidth: 0,
			labelMargin: 0
		},
		yaxis: {
			show: false,
			min: 0,
			max: 100
		},
		xaxis: {
			show: false
		}
	});
	/* chartjs Float Closed*/
	
	/* chartjs Float Chart*/
	var plot4 = $.plot('#flotChart4', [{
		data: flotSampleData5,
		color: 'rgba(253, 73, 103, 0.5)',
	}], {
		series: {
			shadowSize: 0,
			lines: {
				show: true,
				lineWidth: 2,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0
					}, {
						opacity: 0.5
					}]
				}
			}
		},
		grid: {
			borderWidth: 0,
			labelMargin: 0
		},
		yaxis: {
			show: false,
			min: 0,
			max: 100
		},
		xaxis: {
			show: false
		}
	});
	/* chartjs Float Closed*/
	
	/* Chartjs (#revenue) */
	var myCanvas = document.getElementById("revenue");
	myCanvas.height="300";
	var myCanvasContext = myCanvas.getContext("2d");
	var myChart = new Chart(myCanvas, {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
			datasets: [{
				label: 'Total Tasks',
				data: [15, 18, 12, 18, 10, 15, 17, 20],
				backgroundColor:'rgb(0, 111, 255)',
				hoverBackgroundColor: 'rgb(0, 111, 255)',
				hoverBorderWidth: 2,
				hoverBorderColor: 'rgb(0, 111, 255)'
			}, {

			    label: 'Completed Tasks',
				data: [10, 14, 10, 15, 9, 14, 15, 14],
				backgroundColor: 'rgb(48, 187, 103)',
				hoverBackgroundColor:'rgb(48, 187, 103)',
				hoverBorderWidth: 2,
				hoverBorderColor: 'rgb(48, 187, 103)'

			}
		  ]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			tooltips: {
				mode: 'index',
				titleFontSize: 12,
				titleFontColor: '#000',
				bodyFontColor: '#000',
				backgroundColor: '#fff',
				cornerRadius: 3,
				intersect: false,
			},
			legend: {
				display: false,
				labels: {
					usePointStyle: true,
					fontFamily: 'Montserrat',
				},
			},
			scales: {
				xAxes: [{
					barPercentage: 0.2,
					ticks: {
						fontColor: "#77778e",

					 },
					display: true,
					gridLines: {
						display: true,
						color: 'rgba(119, 119, 142, 0.2)',
						drawBorder: false
					},
					scaleLabel: {
						display: false,
						labelString: 'Month',
						fontColor: 'rgba(0,0,0,0.8)'
					}
				}],
				yAxes: [{
					ticks: {
						fontColor: "#77778e",
					 },
					display: true,
					gridLines: {
						display: true,
						color: 'rgba(119, 119, 142, 0.2)',
						drawBorder: false
					},
					scaleLabel: {
						display: false,
						labelString: 'sales',
						fontColor: 'rgba(0,0,0,0.81)'
					}
				}]
			},
			title: {
				display: false,
				text: 'Normal Legend'
			}
		}
	});
	/* Chartjs (#revenue) closed */
		
	// Datepicker
	$('.fc-datepicker').datepicker({
		showOtherMonths: true,
		selectOtherMonths: true
	});
	
	$(".scroll-2").mCustomScrollbar({
		theme:"minimal",
		autoHideScrollbar: true,
		scrollbarPosition: "outside"
	});

 });