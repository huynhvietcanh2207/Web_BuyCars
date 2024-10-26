var barChart = document.getElementById("barChart").getContext("2d"),
  pieChart = document.getElementById("pieChart").getContext("2d"),
  multipleBarChart = document.getElementById("multipleBarChart").getContext("2d");

var myPieChart = new Chart(pieChart, {
  type: "pie",
  data: {
    datasets: [
      {
        data: [50, 50],
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

var myBarChart = new Chart(barChart, {
  type: "bar",
  data: {
    labels: [
      "Tháng 1",
      "Tháng 2",
      "Tháng 3",
      "Tháng 4",
      "Tháng 5",
      "Tháng 6",
      "Tháng 7",
      "Tháng 8",
      "Tháng 9",
      "Tháng 10",
      "Tháng 11",
      "Tháng 12",
    ],
    datasets: [
      {
        label: "Tổng số người dùng",
        backgroundColor: "rgb(23, 125, 255)",
        borderColor: "rgb(23, 125, 255)",
        data: [5,2],
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: true,
          },
        },
      ],
    },
  },
});

var myMultipleBarChart = new Chart(multipleBarChart, {
  type: "bar",
  data: {
    labels: [
      "Tháng 1",
      "Tháng 2",
      "Tháng 3",
      "Tháng 4",
      "Tháng 5",
      "Tháng 6",
      "Tháng 7",
      "Tháng 8",
      "Tháng 9",
      "Tháng 10",
      "Tháng 11",
      "Tháng 12",
    ],
    datasets: [
      {
        label: "Mercedes",
        backgroundColor: "#59d05d",
        borderColor: "#59d05d",
        data: [95, 100, 112, 101, 144, 159, 178, 156, 188, 190, 210, 245],
      },
      {
        label: "Poscher",
        backgroundColor: "#fdaf4b",
        borderColor: "#fdaf4b",
        data: [
          145, 256, 244, 233, 210, 279, 287, 253, 287, 299, 312, 356,
        ],
      },
      {
        label: "Lamboghini",
        backgroundColor: "#177dff",
        borderColor: "#177dff",
        data: [
          185, 279, 273, 287, 234, 312, 322, 286, 301, 320, 346, 399,
        ],
      },
    ],
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
    responsive: true,
    scales: {
      xAxes: [
        {
          stacked: true,
        },
      ],
      yAxes: [
        {
          stacked: true,
        },
      ],
    },
  },
});