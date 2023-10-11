/**
 * Dashboard Analytics
 */

"use strict";

(function () {
  const elementData = document.getElementById("barang_terlaris");
  const { barangTerlaris, bulan } = elementData.dataset;

  const data = [...JSON.parse(barangTerlaris).map((b) => b.jumlah)];
  const colors = [
    "#33b2df",
    "#546E7A",
    "#d4526e",
    "#13d8aa",
    "#A5978B",
    "#2b908f",
    "#f9a3a4",
    "#90ee7e",
    "#f48024",
    "#69d2e7",
  ];
  // --------------------------------------------------------------------
  const categories = [...JSON.parse(barangTerlaris).map((b) => b.nama)];
  // Total Revenue Report Chart - Bar Chart
  // --------------------------------------------------------------------
  const totalRevenueChartEl = document.querySelector("#totalRevenueChart"),
    totalRevenueChartOptions = {
      series: [{ data }],
      chart: {
        type: "bar",
        height: 400,
      },
      plotOptions: {
        bar: {
          barHeight: "100%",
          distributed: true,
          horizontal: true,
          dataLabels: {
            position: "bottom",
          },
        },
      },
      colors,
      dataLabels: {
        enabled: true,
        textAnchor: "start",
        style: {
          colors: ["#fff"],
        },
        formatter: function (val, opt) {
          return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val;
        },
        offsetX: 0,
        dropShadow: {
          enabled: true,
        },
      },
      stroke: {
        width: 1,
        colors: ["#fff"],
      },
      xaxis: {
        categories,
      },
      yaxis: {
        labels: {
          show: false,
        },
      },
      title: {
        text: "Barang Terlaris",
        align: "center",
        floating: true,
      },
      subtitle: {
        text: `Bulan ${bulan} 2023`,
        align: "center",
      },
      tooltip: {
        theme: "dark",
        x: {
          show: false,
        },
        y: {
          title: {
            formatter: function () {
              return "";
            },
          },
        },
      },
    };
  if (
    typeof totalRevenueChartEl !== undefined &&
    totalRevenueChartEl !== null
  ) {
    const totalRevenueChart = new ApexCharts(
      totalRevenueChartEl,
      totalRevenueChartOptions
    );
    totalRevenueChart.render();
  }
})();
