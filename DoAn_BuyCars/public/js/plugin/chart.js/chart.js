var barChart = document.getElementById("barChart").getContext("2d"),
  pieChart = document.getElementById("pieChart").getContext("2d"),
  multipleBarChart = document.getElementById("multipleBarChart").getContext("2d");


//Biểu đồ tròn cho Thu - Chi
var chartDataElement = document.getElementById('chart-data');
var income = chartDataElement.getAttribute('data-income');
var expenses = chartDataElement.getAttribute('data-expenses');

income = parseFloat(income);
expenses = parseFloat(expenses);
var myPieChart = new Chart(pieChart, {
  type: "pie",
  data: {
    datasets: [
      {
        data: [expenses, income],
        backgroundColor: ["#f3545d", "#fdaf4b"],
        borderWidth: 0,
      },
    ],
    labels: ["Lượng Chi", "Lượng Thu"],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      position: "bottom",
      labels: {
        fontColor: "rgb(154, 154, 154)",
        fontSize: 11,
        usePointStyle: true,
        padding: 20,
      },
    },
    pieceLabel: {
      render: "percentage",
      fontColor: "white",
      fontSize: 14,
    },
    tooltips: false,
    layout: {
      padding: {
        left: 20,
        right: 20,
        top: 20,
        bottom: 20,
      },
    },
  },
});

//Biểu đồ cột: Thể hiện Số lượng dùng theo tháng
document.addEventListener('DOMContentLoaded', function () {
  var chartDataElement = document.getElementById('user-chart-data');
  const months = JSON.parse(chartDataElement.getAttribute('data-user'));
  const counts = JSON.parse(chartDataElement.getAttribute('data-counts'));

  // Tạo biểu đồ với Chart.js
  var barChart = new Chart(document.getElementById('barChart'), {
    type: "bar",
    data: {
      labels: months,
      datasets: [{
        label: "Tổng số người dùng",
        backgroundColor: "rgb(23, 125, 255)",
        borderColor: "rgb(23, 125, 255)",
        borderWidth: 1,
        data: counts,
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
        },
      },
      plugins: {
        legend: {
          display: true,
          position: 'top',
        },
      },
    },
  });
});

document.addEventListener('DOMContentLoaded', function () {
  // Biểu đồ Thương hiệu
  var brandChartData = document.getElementById('brand-chart-data');
  var labels = JSON.parse(brandChartData.getAttribute('data-labels'));
  var data = JSON.parse(brandChartData.getAttribute('data-brand'));

  console.log('Labels:', labels);
  console.log('Data:', data);

  // Mảng màu sắc cố định cho từng thương hiệu
  var fixedColors = [
    '#FF0000',
    '#FFFF33',
    '#33FF33',
    '#FFCC33',
    '#0099FF',
    '#9933FF',
    '#002200',
    '#FF9966',
    '#333333',
    '#990066',
    '#000055',
    '#009900'
  ];

  // Tạo datasets với màu sắc cố định
  var datasets = labels.map((label, index) => {
    return {
      label: label,
      backgroundColor: fixedColors[index % fixedColors.length],
      borderColor: fixedColors[index % fixedColors.length],
      data: data[index],
    };
  });

  var multipleBarChart = document.getElementById('multipleBarChart');
  // Kiểm tra xem multipleBarChart có tồn tại không
  if (multipleBarChart) {
    // Tạo biểu đồ
    var myMultipleBarChart = new Chart(multipleBarChart, {
      type: "bar",
      data: {
        labels: [
          "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4",
          "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8",
          "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12",
        ],
        datasets: datasets,
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "bottom",
        },
        title: {
          display: true,
          text: "Biểu đồ thương hiệu",
        },
        tooltips: {
          mode: "index",
          intersect: false,
        },
        scales: {
          xAxes: [{
            stacked: true,
          }],
          yAxes: [{
            stacked: true,
            ticks: {
              beginAtZero: true,
            },
          }],
        },
      },
    });
  } else {
    console.error('Canvas element not found!');
  }
});


