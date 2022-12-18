$(function() {
    new PerfectScrollbar(document.getElementById('reviews'));
    new PerfectScrollbar(document.getElementById('tab-table-1'));
    new PerfectScrollbar(document.getElementById('tab-table-2'));
});
$(document).ready(function() {
    setTimeout(function() {
        // Bar Chart
        $(function() {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("statistics-chart-1", am4charts.XYChart);

            // Add data
            chart.data = [{
                period: '2010',
                iphone: 0,
                itouch: 60
            }, {
                period: '2011',
                iphone: 50,
                itouch: 5
            }, {
                period: '2012',
                iphone: 20,
                itouch: 100
            }, {
                period: '2013',
                iphone: 60,
                itouch: 60
            }, {
                period: '2014',
                iphone: 20,
                itouch: 170
            }, {
                period: '2015',
                iphone: 60,
                itouch: 25
            }, {
                period: '2016',
                iphone: 10,
                itouch: 60
            }];

            // Create axes
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "period";

            // First value axis
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // First series
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "iphone";
            series.dataFields.categoryX = "period";
            series.name = "iphone";
            series.tooltipText = "{name}: [bold]{valueY}[/]";
            series.strokeWidth = 4;
            series.strokeDasharray = 10;
            series.tensionY = 1;
            series.tensionX = 0.8;
            series.fill = am4core.color("#C4C2C3");
            series.stroke = am4core.color("#C4C2C3");

            // Second series
            var series2 = chart.series.push(new am4charts.LineSeries());
            series2.dataFields.valueY = "itouch";
            series2.dataFields.categoryX = "period";
            series2.name = "itouch";
            series2.tooltipText = "{name}: [bold]{valueY}[/]";
            series2.strokeWidth = 4;
            series2.tensionY = 1;
            series2.tensionX = 0.8;
            series2.fill = am4core.color("#077dd5");
            series2.stroke = am4core.color("#077dd5");
            var dropShadow = new am4core.DropShadowFilter();
            dropShadow.dy = 15;
            dropShadow.dx = 1;
            dropShadow.blur = 8;
            dropShadow.opacity = 0.5;
            dropShadow.color = '#077dd5';
            series2.filters.push(dropShadow);

            // Add cursor
            chart.cursor = new am4charts.XYCursor();
            categoryAxis.renderer.grid.template.strokeOpacity = 0;

        });

    }, 400)
    buildchart()
    $(window).on('resize', function() {
        buildchart();
    });
    $('#mobile-collapse').on('click', function() {
        setTimeout(function() {
            buildchart();
        }, 700);
    });
});

function buildchart() {
    $(function() {
        //Flot Base Build Option for bottom join
        var options_bt = {
            legend: {
                show: false
            },
            series: {
                label: "",
                shadowSize: 0,
                curvedLines: {
                    active: true,
                    nrSplinePoints: 20
                },
            },
            tooltip: {
                show: true,
                content: "x : %x | y : %y"
            },
            grid: {
                hoverable: true,
                borderWidth: 0,
                labelMargin: 0,
                axisMargin: 0,
                minBorderMargin: 0,
                margin: {
                    top: 5,
                    left: 0,
                    bottom: 0,
                    right: 0,
                }
            },
            yaxis: {
                min: 0,
                max: 30,
                color: 'transparent',
                font: {
                    size: 0,
                }
            },
            xaxis: {
                color: 'transparent',
                font: {
                    size: 0,
                }
            }
        };

        //Flot Base Build Option for Center card
        var options_ct = {
            legend: {
                show: false
            },
            series: {
                label: "",
                shadowSize: 0,
                curvedLines: {
                    active: true,
                    nrSplinePoints: 20
                },
            },
            tooltip: {
                show: true,
                content: "x : %x | y : %y"
            },
            grid: {
                hoverable: true,
                borderWidth: 0,
                labelMargin: 0,
                axisMargin: 0,
                minBorderMargin: 5,
                margin: {
                    top: 8,
                    left: 8,
                    bottom: 8,
                    right: 8,
                }
            },
            yaxis: {
                min: 0,
                max: 30,
                color: 'transparent',
                font: {
                    size: 0,
                }
            },
            xaxis: {
                color: 'transparent',
                font: {
                    size: 0,
                }
            }
        };
        //Flot Order Chart Start
        $.plot($("#order-chart-1"), [{
            data: [
                [0, 30],
                [1, 5],
                [2, 26],
                [3, 10],
                [4, 22],
                [5, 30],
                [6, 5],
                [7, 26],
                [8, 10],
            ],
            color: "#fff",
            lines: {
                show: true,
                fill: false,
                lineWidth: 3
            },
            points: {
                show: true,
                radius: 4,
                fillColor: "#fff",
                fill: true,
            },
            curvedLines: {
                apply: false,
            }
        }], options_ct);
        $.plot($("#ecom-chart-3"), [{
            data: [
                [0, 30],
                [1, 5],
                [2, 26],
                [3, 10],
                [4, 22],
                [5, 30],
                [6, 5],
                [7, 26],
                [8, 10],
            ],
            color: "#077dd5",
            lines: {
                show: true,
                fill: false,
                lineWidth: 3
            },
            points: {
                show: true,
                radius: 4,
                fillColor: "#fff",
                fill: true,
            },
            curvedLines: {
                apply: false,
            }
        }], options_ct);


    });
}