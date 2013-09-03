function loadGraph(){
    $('#graph').highcharts({
            chart: {
                type: 'spline',
                backgroundColor:'transparent',
                height: 60,
                spacingBottom: 0,
                spacingLeft: 0,
                spacingRight: 0,
                spacingTop: 52,
            },
            title: {
                text: null
            },
            subtitle: {
                text: null
            },
            xAxis: {
                categories: null,
                gridLineWidth: 0,
                lineWidth: 0,
                minorGridLineWidth: 0,
                tickLength: 0,
                labels: {
                    enabled: false
                }
            },
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    enabled: false
                },
                min: 0,
                max: 0,
                gridLineWidth: 0,
                lineWidth: 0,
            },
            tooltip: {
                formatter: function() {
                    return this.point.name;
                },
                positioner: function () {
                return { x: 10, y: 10 };
                }
            },
            plotOptions: {
                series: {
                marker: {
                    lineWidth: 2,
                    radius: 6,
                    lineColor: 'ed1b2e',
                    fillColor: '#ffffff',
                    states: {
                        hover: {
                            lineColor: 'ed1b2e',
                            fillColor: '#ed1b2e',
                            lineWidth: 0,
                            radius: 10
                        }
                    }
                }
            }
            },
            series: [{
                name: 'Data',
                marker: {
                    
                },
                type: 'scatter',
                data: []
            }],
            credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            legend: {
                enabled: false
            }
        });

    //now set the time
    $('#graph').highcharts().xAxis[0].setExtremes(0, document.getElementById(playerID).getDuration());
}