$(function () {
    "use strict";

    // chart 1
    var options = {
        series: [{
            name: "Data",
            data: [90, 50, 80, 75]
        }],
        chart: {
            foreColor: '#9a9797',
            type: "bar",
            height: 460,
            toolbar: { show: false },
            zoom: { enabled: false },
            dropShadow: {
                enabled: false
            },
            sparkline: { enabled: false }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "25%",
                distributed: true,
                endingShape: "flat"
            }
        },
        legend: {
            show: false,
            position: 'top',
            horizontalAlign: 'left',
            offsetX: -20
        },
        dataLabels: {
            enabled: !1
        },
        grid: {
            show: true,
            borderColor: '#eee',
            strokeDashArray: 4,
        },
        stroke: {
            colors: ["transparent"],
            show: !0,
            width: 5,
            curve: "smooth"
        },
        colors: ["#5C3E94", "#3461ff", "#12bf24", "#9E1C60"],
        xaxis: {
            categories: ["Leadership", "Staff", "Intelligence", "Cooperation"],
            labels: {
                style: {
                    colors: '#666',
                    fontSize: '13px'
                }
            }
        },

        tooltip: {
            theme: 'dark',
            y: {
                formatter: function (val) {
                    return "" + val + ""
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();


    $('.donut').peity('donut')






    // chart 2
    var optionsLine = {
        chart: {
            foreColor: '#9ba7b2',
            height: 360,
            type: 'line',
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: true,
                top: 3,
                left: 2,
                blur: 4,
                opacity: 0.1,
            }
        },
        stroke: {
            curve: 'smooth',
            width: 5
        },
        colors: ["#e72e2e", '#0c971a'],
        series: [{
            name: "CP-50001",
            // data:[1,21,30,35,70]
            data: [1, 15, 56, 20, 33,]
        }, {
            name: "CP-50002",
            // data:[1,31,40,45,80]
            data: [30, 33, 21, 82, 30,]
        }],
        title: {
            text: 'Term Wise Comparison',
            align: 'left',
            offsetY: 25,
            offsetX: 20
        },
        subtitle: {
            text: 'Statistics',
            offsetY: 55,
            offsetX: 20
        },
        markers: {
            size: 4,
            strokeWidth: 0,
            hover: {
                size: 7
            }
        },
        grid: {
            show: true,
            padding: {
                bottom: 0
            }
        },
        labels: ['Term-1', 'Term-2', 'Term-3', 'Term-4'],

        // labels: ['01/15/2002', '01/16/2002', '01/17/2002', '01/18/2002', '01/19/2002', '01/20/2002'],
        xaxis: {
            //type: 'datetime',
            // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            offsetY: -20
        }
    }
    var chartLine = new ApexCharts(document.querySelector('#chart2'), optionsLine);
    chartLine.render();






    // chart 2
    var optionsLine = {
        chart: {
            foreColor: '#9ba7b2',
            height: 360,
            type: 'line',
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: true,
                top: 4,
                left: 2,
                blur: 4,
                opacity: 0.1,
            }
        },
        stroke: {
            curve: 'smooth',
            width: 5
        },
        colors: ['#0c971a'],
        series: [
            {
                name: "CP-50002",
                data: [74.32, 65.31, 60.33, 63.67]
                // data: [30, 33, 21, 82, 30,]
            }],
        title: {
            text: 'Term Wise Comparison',
            align: 'left',
            offsetY: 10,
            offsetX: 20
        },
        subtitle: {
            text: 'Statistics',
            offsetY: 35,
            offsetX: 40
        },
        markers: {
            size: 4,
            strokeWidth: 0,
            hover: {
                size: 7
            }
        },
        grid: {
            show: true,
            padding: {
                bottom: 0
            }
        },
        labels: ['Term-1', 'Term-2', 'Term-3', 'Term-4'],
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            offsetY: -20
        }
    }
    var chartLine = new ApexCharts(document.querySelector('#chart4'), optionsLine);
    chartLine.render();

});




// chart 3
new Chart(document.getElementById("chart3"), {
    type: 'pie',
    data: {
        labels: ["CP-50001", "Cp-50002", "Cp-50003", "Cp-50004",],
        datasets: [{
            label: "Population (millions)",
            backgroundColor: ["#0d6efd", "#212529", "#17a00e", "#f41127",],
            data: [50, 40, 30, 85,]
        }]
    },
    options: {
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Student Assessment'
        }
    }
});


//chart 11
Highcharts.chart('chart11', {
    chart: {
        type: 'area',
        styledMode: true
    },
    credits: {
        enabled: false
    },
    accessibility: {
        description: 'Image description: An area chart compares the nuclear stockpiles of the USA and the USSR/Russia between 1945 and 2017. The number of nuclear weapons is plotted on the Y-axis and the years on the X-axis. The chart is interactive, and the year-on-year stockpile levels can be traced for each country. The US has a stockpile of 6 nuclear weapons at the dawn of the nuclear age in 1945. This number has gradually increased to 369 by 1950 when the USSR enters the arms race with 6 weapons. At this point, the US starts to rapidly build its stockpile culminating in 32,040 warheads by 1966 compared to the USSRâ€™s 7,089. From this peak in 1966, the US stockpile gradually decreases as the USSRâ€™s stockpile expands. By 1978 the USSR has closed the nuclear gap at 25,393. The USSR stockpile continues to grow until it reaches a peak of 45,000 in 1986 compared to the US arsenal of 24,401. From 1986, the nuclear stockpiles of both countries start to fall. By 2000, the numbers have fallen to 10,577 and 21,000 for the US and Russia, respectively. The decreases continue until 2017 at which point the US holds 4,018 weapons compared to Russiaâ€™s 4,500.'
    },
    title: {
        text: 'US and USSR nuclear stockpiles'
    },
    subtitle: {
        text: 'Sources: <a href="https://thebulletin.org/2006/july/global-nuclear-stockpiles-1945-2006">' + 'thebulletin.org</a> &amp; <a href="https://www.armscontrol.org/factsheets/Nuclearweaponswhohaswhat">' + 'armscontrol.org</a>'
    },
    xAxis: {
        allowDecimals: false,
        labels: {
            formatter: function () {
                return this.value; // clean, unformatted number for year
            }
        },
        accessibility: {
            rangeDescription: 'Range: 1940 to 2017.'
        }
    },
    yAxis: {
        title: {
            text: 'Nuclear weapon states'
        },
        labels: {
            formatter: function () {
                return this.value / 1000 + 'k';
            }
        }
    },
    tooltip: {
        pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br />warheads in {point.x}'
    },
    plotOptions: {
        area: {
            pointStart: 1940,
            marker: {
                enabled: false,
                symbol: 'circle',
                radius: 2,
                states: {
                    hover: {
                        enabled: true
                    }
                }
            }
        }
    },
    series: [{
        name: 'USA',
        data: [
            null, null, null, null, null, 6, 11, 32, 110, 235,
            369, 640, 1005, 1436, 2063, 3057, 4618, 6444, 9822, 15468,
            20434, 24126, 27387, 29459, 31056, 31982, 32040, 31233, 29224, 27342,
            26662, 26956, 27912, 28999, 28965, 27826, 25579, 25722, 24826, 24605,
            24304, 23464, 23708, 24099, 24357, 24237, 24401, 24344, 23586, 22380,
            21004, 17287, 14747, 13076, 12555, 12144, 11009, 10950, 10871, 10824,
            10577, 10527, 10475, 10421, 10358, 10295, 10104, 9914, 9620, 9326,
            5113, 5113, 4954, 4804, 4761, 4717, 4368, 4018
        ]
    }, {
        name: 'USSR/Russia',
        data: [null, null, null, null, null, null, null, null, null, null,
            5, 25, 50, 120, 150, 200, 426, 660, 869, 1060,
            1605, 2471, 3322, 4238, 5221, 6129, 7089, 8339, 9399, 10538,
            11643, 13092, 14478, 15915, 17385, 19055, 21205, 23044, 25393, 27935,
            30062, 32049, 33952, 35804, 37431, 39197, 45000, 43000, 41000, 39000,
            37000, 35000, 33000, 31000, 29000, 27000, 25000, 24000, 23000, 22000,
            21000, 20000, 19000, 18000, 18000, 17000, 16000, 15537, 14162, 12787,
            12600, 11400, 5500, 4512, 4502, 4502, 4500, 4500
        ]
    }]
});



