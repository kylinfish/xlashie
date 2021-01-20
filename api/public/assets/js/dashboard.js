(function () {
    var Charts = (function () {
        // Variable

        var $toggle = $('[data-toggle="chart"]');
        var mode = 'light'; //(themeMode) ? themeMode : 'light';
        var fonts = {
            base: 'Open Sans'
        }

        // Colors
        var colors = {
            gray: {
                100: '#f6f9fc',
                200: '#e9ecef',
                300: '#dee2e6',
                400: '#ced4da',
                500: '#adb5bd',
                600: '#8898aa',
                700: '#525f7f',
                800: '#32325d',
                900: '#212529'
            },
            theme: {
                'default': '#172b4d',
                'primary': '#5e72e4',
                'secondary': '#f4f5f7',
                'info': '#11cdef',
                'success': '#2dce89',
                'danger': '#f5365c',
                'warning': '#fb6340'
            },
            black: '#12263F',
            white: '#FFFFFF',
            transparent: 'transparent',
        };

        // Methods

        // Chart.js global options
        function chartOptions() {

            // Options
            var options = {
                defaults: {
                    global: {
                        responsive: true,
                        maintainAspectRatio: false,
                        defaultColor: (mode == 'dark') ? colors.gray[700] : colors.gray[600],
                        defaultFontColor: (mode == 'dark') ? colors.gray[700] : colors.gray[600],
                        defaultFontFamily: fonts.base,
                        defaultFontSize: 13,
                        layout: {
                            padding: 0
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 16
                            }
                        },
                        elements: {
                            point: {
                                radius: 0,
                                backgroundColor: colors.theme['primary']
                            },
                            line: {
                                tension: .4,
                                borderWidth: 4,
                                borderColor: colors.theme['primary'],
                                //backgroundColor: colors.transparent,
                                borderCapStyle: 'rounded'
                            },
                            rectangle: {
                                backgroundColor: colors.theme['warning']
                            },
                            arc: {
                                backgroundColor: colors.theme['primary'],
                                borderColor: (mode == 'dark') ? colors.gray[800] : colors.white,
                                borderWidth: 4
                            }
                        },
                        tooltips: {
                            enabled: true,
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    doughnut: {
                        cutoutPercentage: 83,
                        legendCallback: function (chart) {
                            var data = chart.data;
                            var content = '';

                            data.labels.forEach(function (label, index) {
                                var bgColor = data.datasets[0].backgroundColor[index];

                                content += '<span class="chart-legend-item">';
                                content += '<i class="chart-legend-indicator" style="background-color: ' + bgColor + '"></i>';
                                content += label;
                                content += '</span>';
                            });

                            return content;
                        }
                    }
                }
            }
            // yAxes
            Chart.scaleService.updateScaleDefaults('linear', {
                ticks: {
                    beginAtZero: true,
                    padding: 10,

                }
            });

            // xAxes
            Chart.scaleService.updateScaleDefaults('category', {

                ticks: {
                    padding: 20
                },
                maxBarThickness: 10
            });

            return options;
        }

        // Parse global options
        function parseOptions(parent, options) {
            for (var item in options) {
                if (typeof options[item] !== 'object') {
                    parent[item] = options[item];
                } else {
                    parseOptions(parent[item], options[item]);
                }
            }
        }

        // Push options
        function pushOptions(parent, options) {
            for (var item in options) {
                if (Array.isArray(options[item])) {
                    options[item].forEach(function (data) {
                        parent[item].push(data);
                    });
                } else {
                    pushOptions(parent[item], options[item]);
                }
            }
        }

        // Pop options
        function popOptions(parent, options) {
            for (var item in options) {
                if (Array.isArray(options[item])) {
                    options[item].forEach(function (data) {
                        parent[item].pop();
                    });
                } else {
                    popOptions(parent[item], options[item]);
                }
            }
        }

        // Toggle options
        function toggleOptions(elem) {
            var options = elem.data('add');
            var $target = $(elem.data('target'));
            var $chart = $target.data('chart');

            if (elem.is(':checked')) {

                // Add options
                pushOptions($chart, options);

                // Update chart
                $chart.update();
            } else {

                // Remove options
                popOptions($chart, options);

                // Update chart
                $chart.update();
            }
        }

        // Update options
        function updateOptions(elem) {
            var options = elem.data('update');
            var $target = $(elem.data('target'));
            var $chart = $target.data('chart');

            // Parse options
            parseOptions($chart, options);

            // Toggle ticks
            toggleTicks(elem, $chart);

            // Update chart
            $chart.update();
        }

        // Toggle ticks
        function toggleTicks(elem, $chart) {

            if (elem.data('prefix') !== undefined || elem.data('prefix') !== undefined) {
                var prefix = elem.data('prefix') ? elem.data('prefix') : '';
                var suffix = elem.data('suffix') ? elem.data('suffix') : '';

                // Update ticks
                $chart.options.scales.yAxes[0].ticks.callback = function (value) {
                    if (!(value % 10)) {
                        return prefix + value + suffix;
                    }
                }

                // Update tooltips
                $chart.options.tooltips.callbacks.label = function (item, data) {
                    var label = data.datasets[item.datasetIndex].label || '';
                    var yLabel = item.yLabel;
                    var content = '';

                    if (data.datasets.length > 1) {
                        content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                    }

                    content += '<span class="popover-body-value">' + prefix + yLabel + suffix + '</span>';
                    return content;
                }

            }
        }

        // Events

        // Parse global options

        // Parse global options
        if (window.Chart) {
            parseOptions(Chart, chartOptions());
        }
        // Toggle options
        $toggle.on({
            'change': function () {
                var $this = $(this);

                if ($this.is('[data-add]')) {
                    toggleOptions($this);
                }
            },
            'click': function () {
                var $this = $(this);

                if ($this.is('[data-update]')) {
                    updateOptions($this);
                }
            }
        });


        // Return

        return {
            colors: colors,
            fonts: fonts,
            mode: mode
        };

    })();

    // Payment
    var PieChart = (function (data) {
        var $chart = $('#chart-pie');
        var pieChart = new Chart($chart, {
            type: 'pie',
            data: {
                labels: Object.keys(data.orders.payments),

                datasets: [{
                    data: Object.values(data.orders.payments),
                    backgroundColor: [
                        Charts.colors.theme['danger'],
                        Charts.colors.theme['warning'],
                        Charts.colors.theme['success'],
                        Charts.colors.theme['primary'],
                        Charts.colors.theme['info'],
                    ],
                    label: '付款方式'
                }],
            },
            options: {
                responsive: true,
            }
        });
    });

    var BarsChart = (function (data) {
        var $chart = $('#chart-bars');

        function initChart($chart) {
            var ordersChart = new Chart($chart, {
                type: 'line',
                data: {
                    labels: data.map(item => Object.values(item)[0]),
                    datasets: [{
                        data: data.map(item => Object.values(item)[1]),
                        label: '訂單數量',
                        borderColor: Charts.colors.theme['primary'],
                    }]
                },
            });
            // Save to jQuery object
            $chart.data('chart', ordersChart);
        }

        // Init chart
        if ($chart.length) {
            initChart($chart);
        }
    });


    var HorizontalBarsChart = (function (domId, data) {
        var $chart = $(domId);
        function initChart($chart) {
            var ordersChart = new Chart($chart, {
                type: 'horizontalBar',
                data: {
                    labels: Object.keys(data.items.product_quantity),
                    datasets: [{
                            label: '銷售次數 (次)',
                            backgroundColor: Charts.colors.theme['info'],
                            data: Object.values(data.items.product_list),
                        }, {
                            label: '銷售數量 (組/個)',
                            backgroundColor: Charts.colors.theme['success'],
                            data: Object.values(data.items.product_quantity),
                        },
                    ],
                },
                options: {
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            // Save to jQuery object
            $chart.data('chart', ordersChart);
        }
        // Init chart
        if ($chart.length) {
            initChart($chart);
        }
    });

    var fetchData = function (data) {
        fetch(`/api/reports/`)
            .then(function (response) {
                return response.json();
            })
            .then(function (myJson) {
                data = myJson.data

                $('#totalOrders').text(data.orders.uniq_customer_count + " / " + data.orders.total_count);
                $('#totalExpense').text(new Intl.NumberFormat().format(data.orders.total_expense));
                $('#topSaleProduct').text(Object.keys(data.items.product_quantity)[0]);

                PieChart(data)
                BarsChart(data.group_by_date)
                HorizontalBarsChart('#chart-horizontal-bar', data)
            });
    };
    fetchData();
})();
