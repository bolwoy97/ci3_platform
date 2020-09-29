function build_chart(data) {	
	
	/* chartjs Float Chart*/
	var plot1 = $.plot('#flotChart', [{
		data: data.data,
		//data: flotSampleData1,
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
            ticks:data.yaxis,

           /* ticks: [[0, '$1.00'], [0.05, '$1.05'],
             [0.10, '$1.10'], [0.15, '$1.15'], 
             [0.20, '$1.20'], [0.25, '$1.25'],
              [.30, '$1.30'], [0.35, '$1.35']],*/
		},
		xaxis: {
			tickColor: 'rgba(142, 156, 173,0.1)',
			font: {
				color: '#5f6d7a',
				size: 10
			},
			ticks:data.xaxis,
			/*ticks: [
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
			],*/
		}
	});

	
		
	

 };



/* $(function(e) {	
		var data = {
			yaxis: [[0, '$1.00'], [0.05, '$1.05'],
             [0.10, '$1.10'], [0.15, '$1.15'], 
             [0.20, '$1.20'], [0.25, '$1.25'],
			  [.30, '$1.30'], [0.35, '$1.35']],
			  
			  xaxis: [
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
        build_chart(data)
    });*/