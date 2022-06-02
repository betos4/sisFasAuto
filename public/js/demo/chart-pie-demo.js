// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var myPieChart = '';

function myPieChartDraw(data, paletaColores) {
  //mis variables
  var marca = [];
  var numContratos = [];

  //ingreso la data de dias
  for (var i in data) {
    marca.push(data[i].marca);
    numContratos.push(data[i].numcontrato);
  }

  var ctx = document.getElementById("myPieChart");
  myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: marca,
      datasets: [{
        data: numContratos,
        backgroundColor: paletaColores,
        hoverBackgroundColor: paletaColores,
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
}

