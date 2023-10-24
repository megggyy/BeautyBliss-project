Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart
var ctx = document.getElementById("productChart");
var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: _ordxdata,
        datasets: [{
            label: "Order",
            backgroundColor: ['#8ac6d1', '#e996a1', '#ffe291', '#a6d3a0', '#d0a3bf', '#94d1cb', '#f0c987', '#c4c8a1', '#e5b9b5', '#b4c3d9'],
            borderColor: "rgba(2,117,216,1)",
            data: _ordydata,
        }],
    },
    options: {
        scales: {
            xAxes: [{
                time: {
                    unit: 'date'
                },
                gridLines: {
                    display: false
                },
                ticks: {
                    maxTicksLimit: 6
                }
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 30,
                    maxTicksLimit: 5
                },
                gridLines: {
                    display: true
                }
            }],
        },
        legend: {
            display: false
        }
    }
});
