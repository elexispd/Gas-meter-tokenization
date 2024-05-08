$(function(){
    'use strict';

    $('.connectedSortable').sortable({
        placeholder: 'sort-highlight',
        connectWith: '.connectedSortable',
        handle: '.card-header, .nav-tabs',
        forcePlaceholderSize: true,
        zIndex: 999999
    });

    $('.connectedSortable .card-header').css('cursor', 'move');

    $('.todo-list').sortable({
        placeholder: 'sort-highlight',
        handle: '.handle',
        forcePlaceholderSize: true,
        zIndex: 999999
    });

    $('.textarea').summernote();

    $('.daterange').daterangepicker({
        ranges: {
            Today: [moment(), moment()],
            Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    }, function(start, end) {
        alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });

    $('.knob').knob();

    var visitorsData = {
        US: 398, SA: 400, CA: 1000, DE: 500, FR: 760, CN: 300, AU: 700, BR: 600, IN: 800, GB: 320, RU: 3000
    };

    $('#world-map').vectorMap({
        map: 'usa_en',
        backgroundColor: 'transparent',
        regionStyle: {
            initial: {
                fill: 'rgba(255, 255, 255, 0.7)',
                'fill-opacity': 1,
                stroke: 'rgba(0,0,0,.2)',
                'stroke-width': 1,
                'stroke-opacity': 1
            }
        },
        series: {
            regions: [{
                values: visitorsData,
                scale: ['#ffffff', '#0154ad'],
                normalizeFunction: 'polynomial'
            }]
        },
        onRegionLabelShow: function(e, el, code) {
            if (typeof visitorsData[code] !== 'undefined') {
                el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
            }
        }
    });

    var sparkline1 = new Sparkline($('#sparkline-1')[0], { width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9' });
    var sparkline2 = new Sparkline($('#sparkline-2')[0], { width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9' });
    var sparkline3 = new Sparkline($('#sparkline-3')[0], { width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9' });

    sparkline1.draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021]);
    sparkline2.draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921]);
    sparkline3.draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21]);

    $('#calendar').datetimepicker({
        format: 'L',
        inline: true
    });

    $('#chat-box').overlayScrollbars({
        height: '250px'
    });

    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
    $.ajax({
        url: '/getChartData', // Assuming this route fetches the required data
        method: 'GET',
        success: function(response) {
            // console.log('Response:', response); // Debug: Check the response from the server

            // Process the data from the server
            var weeklyData = {};

            // Iterate through the data and sum quantities for each week of the current month
            response.forEach(function(item) {
                // Extract week number of the month from the date
                var date = new Date(item.created_at);
                var currentMonth = new Date().getMonth();
                if (date.getMonth() === currentMonth) {
                    var weekNumber = getWeekNumberInMonth(date);
                    // Initialize sum for the week if not present
                    if (!weeklyData[weekNumber]) {
                        weeklyData[weekNumber] = 0;
                    }
                    // Sum the quantity for the week
                    weeklyData[weekNumber] += item.quantity;
                }
            });

            // console.log('Weekly Data:', weeklyData); // Debug: Check the processed weekly data

            // Convert weeklyData object to arrays for labels and quantities
            var labels = [];
            var quantities = [];
            for (var i = 1; i <= getWeeksInMonth(new Date()); i++) {
                labels.push('Week ' + i);
                quantities.push(weeklyData[i] || 0);
            }

            // console.log('Labels:', labels); // Debug: Check the labels array
            // console.log('Quantities:', quantities); // Debug: Check the quantities array

            // Replace the static data with the fetched data
            var salesChartData = {
                labels: labels,
                datasets: [{
                    label: 'Quantity',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: quantities // Use the quantities fetched from the server
                }]
            };

            // console.log('Sales Chart Data:', salesChartData); // Debug: Check the salesChartData

            // Create the sales chart with the updated data
            var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
            var salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: salesChartData, // Use the updated salesChartData
                options: salesChartOptions
            });

            // console.log('Sales Chart:', salesChart); // Debug: Check the salesChart object
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
    var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false
                }
            }]
        }
    };

    var salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: salesChartData,
        options: salesChartOptions
    });

    var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d');

    var pieData = {
        labels: ['Instore Sales', 'Download Sales', 'Mail-Order Sales'],
        datasets: [{
            data: [30, 12, 20],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12']
        }]
    };

    var pieOptions = {
        legend: {
            display: false
        },
        maintainAspectRatio: false,
        responsive: true
    };

    var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
    });

    var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');

    var salesGraphChartData = {
        labels: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4', '2013 Q1', '2013 Q2'],
        datasets: [{
            label: 'Digital Goods',
            fill: false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#efefef',
            pointRadius: 3,
            pointHoverRadius: 7,
            pointColor: '#efefef',
            pointBackgroundColor: '#efefef',
            data: [2666, 2778, 4912, 3767, 6810, 5670, 4820, 15073, 10687, 8432]
        }]
    };

    var salesGraphChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                ticks: {
                    fontColor: '#efefef'
                },
                gridLines: {
                    display: false,
                    color: '#efefef',
                    drawBorder: false
                }
            }],
            yAxes: [{
                ticks: {
                    stepSize: 5000,
                    fontColor: '#efefef'
                },
                gridLines: {
                    display: true,
                    color: '#efefef',
                    drawBorder: false
                }
            }]
        }
    };

    var salesGraphChart = new Chart(salesGraphChartCanvas, {
        type: 'line',
        data: salesGraphChartData,
        options: salesGraphChartOptions
    });
});


// Function to get the week number of the month
function getWeekNumberInMonth(date) {
    var firstDayOfMonth = new Date(date.getFullYear(), date.getMonth(), 1);
    var dayOfWeek = firstDayOfMonth.getDay();
    var dayOfMonth = date.getDate();
    return Math.ceil((dayOfMonth + dayOfWeek) / 7);
}

// Function to get the number of weeks in a month
function getWeeksInMonth(date) {
    var firstDayOfMonth = new Date(date.getFullYear(), date.getMonth(), 1);
    var lastDayOfMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var daysInMonth = lastDayOfMonth.getDate();
    var firstWeekDay = firstDayOfMonth.getDay();
    var lastWeekDay = lastDayOfMonth.getDay();
    var daysToAddAtStart = (firstWeekDay === 0 ? 6 : firstWeekDay - 1);
    var daysToAddAtEnd = (lastWeekDay === 0 ? 0 : 7 - lastWeekDay);
    var totalDays = daysInMonth + daysToAddAtStart + daysToAddAtEnd;
    return Math.ceil(totalDays / 7);
}
