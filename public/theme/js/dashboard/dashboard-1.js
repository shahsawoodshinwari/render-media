(function ($) {
  "use strict"

  let ctx = document.getElementById("members_freelancers_chart");
  ctx.height = 280;
  const chartData = JSON.parse(ctx.dataset.chartData);

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: chartData.labels,
      type: 'line',
      defaultFontFamily: 'Montserrat',
      datasets: [{
        data: chartData.members,
        label: "Members",
        backgroundColor: '#847DFA',
        borderColor: '#847DFA',
        borderWidth: 0.5,
        pointStyle: 'circle',
        pointRadius: 5,
        pointBorderColor: 'transparent',
        pointBackgroundColor: '#847DFA',
      }, {
        label: "Freelancers",
        data: chartData.freelancers,
        backgroundColor: '#F196B0',
        borderColor: '#F196B0',
        borderWidth: 0.5,
        pointStyle: 'circle',
        pointRadius: 5,
        pointBorderColor: 'transparent',
        pointBackgroundColor: '#F196B0',
      }]
    },
    options: {
      responsive: !0,
      maintainAspectRatio: false,
      tooltips: {
        mode: 'index',
        titleFontSize: 12,
        titleFontColor: '#000',
        bodyFontColor: '#000',
        backgroundColor: '#fff',
        titleFontFamily: 'Montserrat',
        bodyFontFamily: 'Montserrat',
        cornerRadius: 3,
        intersect: false,
      },
      legend: {
        display: false,
        position: 'top',
        labels: {
          usePointStyle: true,
          fontFamily: 'Montserrat',
        },


      },
      scales: {
        xAxes: [{
          display: false,
          gridLines: {
            display: false,
            drawBorder: false
          },
          scaleLabel: {
            display: false,
            labelString: 'Month'
          }
        }],
        yAxes: [{
          display: false,
          gridLines: {
            display: false,
            drawBorder: false
          },
          scaleLabel: {
            display: true,
            labelString: 'Value'
          }
        }]
      },
      title: {
        display: false,
      }
    }
  });
})(jQuery);
