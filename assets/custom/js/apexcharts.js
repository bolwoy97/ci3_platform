function build_apex_hart(el_id, chart_data) {
  //prep_chart_data(chart_data);
  var parent_el = document.getElementById(el_id);
  //console.log(chart_data)

  var options = {

    chart: {
      type: 'line',
      height: '300px',

    },
    series: [{
      name: '1YRD = $',
      data: chart_data['values']//[30,40,35,50,49,60,70,91,125]
    }],
    /* xaxis: {
       categories: chart_data['dates']//[1991,1992,1993,1994,1995,1996,1997, 1997,1999]
     },*/

    /////////////


    xaxis: {
      type: 'category',
      categories: chart_data['dates'],
      labels: {
        show: true,
        rotate: -45,
        rotateAlways: false,
        hideOverlappingLabels: true,
        showDuplicates: false,
        trim: false,
        minHeight: undefined,
        maxHeight: 120,
        style: {
          colors: ['#F44336'],
          fontSize: '12px',
          fontFamily: 'Helvetica, Arial, sans-serif',
          fontWeight: 400,
          cssClass: 'apexcharts-xaxis-label',
        },
        offsetX: 0,
        offsetY: 0,
        format: undefined,
        formatter: undefined,
        datetimeUTC: true,
        datetimeFormatter: {
          year: 'yyyy',
          month: "MMM 'yy",
          day: 'dd MMM',
          hour: 'HH:mm',
        },
      },
      axisBorder: {
        show: true,
        color: '#78909C',
        height: 1,
        width: '100%',
        offsetX: 0,
        offsetY: 0
      },
      axisTicks: {
        show: true,
        borderType: 'solid',
        color: '#78909C',
        height: 6,
        offsetX: 0,
        offsetY: 0
      },
      tickAmount: undefined,
      //tickPlacement: 'between',
      min: undefined,
      max: undefined,
      range: undefined,
      floating: false,
      position: 'bottom',
      title: {
        text: undefined,
        offsetX: 0,
        offsetY: 0,
        style: {
          color: undefined,
          fontSize: '12px',
          fontFamily: 'Helvetica, Arial, sans-serif',
          fontWeight: 600,
          cssClass: 'apexcharts-xaxis-title',
        },
      },
      /*crosshairs: {
          show: true,
          width: 1,
          position: 'back',
          opacity: 0.5,        
          stroke: {
              color: '#F44336',
              width: 1,
              dashArray: 0,
          },
          fill: {
              type: 'solid',
              color: '#F44336',
              gradient: {
                  colorFrom: '#D8E3F0',
                  colorTo: '#BED1E6',
                  stops: [0, 100],
                  opacityFrom: 0.4,
                  opacityTo: 0.5,
              },
          },
          dropShadow: {
              enabled: false,
              top: 0,
              left: 0,
              blur: 1,
              opacity: 0.4,
          },
      },
      tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            
            fontSize: 0,
            fontFamily: 0,
          },
      },*/
    },



    ////////////

    yaxis: {
      show: true,
      showAlways: true,
      showForNullSeries: true,
      seriesName: undefined,
      opposite: false,
      reversed: false,
      logarithmic: false,
      /* tickAmount: 6,
       min: 4,
       max: 15,*/
      forceNiceScale: false,
      floating: false,
      decimalsInFloat: undefined,
      labels: {
        show: true,
        align: 'right',
        minWidth: 0,
        maxWidth: 160,
        style: {
          colors: [],
          fontSize: '12px',
          fontFamily: 'Helvetica, Arial, sans-serif',
          fontWeight: 400,
          cssClass: 'apexcharts-yaxis-label',
        },
        offsetX: 0,
        offsetY: 0,
        rotate: 0,
        //formatter: (value) => { return val },
      },
      axisBorder: {
        show: false,
        color: '#78909C',
        offsetX: 0,
        offsetY: 0
      },
      axisTicks: {
        show: false,
        borderType: 'solid',
        color: '#F44336',
        width: 6,
        offsetX: 0,
        offsetY: 0
      },
      title: {
        text: undefined,
        rotate: -90,
        offsetX: 0,
        offsetY: 0,
        style: {
          color: undefined,
          fontSize: '12px',
          fontFamily: 'Helvetica, Arial, sans-serif',
          fontWeight: 600,
          cssClass: 'apexcharts-yaxis-title',
        },
      },
      crosshairs: {
        show: false,
        position: 'back',
        stroke: {
          color: '#F44336',
          width: 1,
          dashArray: 0,
        },
      },
      tooltip: {
        enabled: true,
        offsetX: 0,
      },

    },

    grid: {
      show: true,
      borderColor: '#3f435f',
      strokeDashArray: 0,
      position: 'back',
      xaxis: {
        lines: {
          show: false
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      },
      row: {
        colors: undefined,
        opacity: 0.5
      },
      column: {
        colors: undefined,
        opacity: 0.5
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 0,
        left: 0
      },
    },








  }



  var chart = new ApexCharts(parent_el, options);
  chart.render();
  //chart.zoomX(new Date('2020-09-14').getTime(), new Date('2020-09-21').getTime())




}