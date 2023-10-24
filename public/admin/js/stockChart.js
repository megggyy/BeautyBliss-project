Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Stock Chart
var ctx = document.getElementById("stockChart");
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: _productdata,
        datasets: [{
            data: _stockdata,
            backgroundColor: ['#8ac6d1', '#e996a1', '#ffe291', '#a6d3a0', '#d0a3bf', '#94d1cb', '#f0c987', '#c4c8a1', '#e5b9b5', '#b4c3d9', '#d16387','#63d194', '#e8ec92', '#ec9e92', '#da92ec','#c6d3f8','#dec6f8'],
        }],
    }, 
    options: {
        responsive: true,
        maintainAspectRatio: false,
    },
});
