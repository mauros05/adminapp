$(function () {

    /*
     * DONUT CHART
     * -----------
     */

    var donutData = [
      {
        label: 'Inversiones',
        data : 40,
        color: '#3c8dbc'
      },
      {
        label: 'Ahorros',
        data : 30,
        color: '#0073b7'
      },
      {
        label: 'costos',
        data : 10,
        color: '#00c0ef'
      },
      {
        label: 'deudas',
        data : 20,
        color: '#00c0ef'
      }
    ]
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.3,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
    /*
     * END DONUT CHART
     */

  })

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return '<div style="font-size:12px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }