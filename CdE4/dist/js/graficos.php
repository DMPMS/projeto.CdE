var chart = AmCharts.makeChart("graficoUsuariosCadastradosPorMes", {
        "type": "serial",
        "theme": "light",
        "precision": 0,
        "valueAxes": [{
            "gridAlpha": 0
        }],
        "graphs": [{
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 8,
            "hideBulletsCount": 50,
            "lineThickness": 3,
            "lineColor": "#007bff",
            "title": "Clientes",
            "useLineColorForBulletBorder": true,
            "valueField": "Clientes",
            "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
        }, {
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 8,
            "hideBulletsCount": 50,
            "lineThickness": 3,
            "lineColor": "#19b4fd",
            "title": "Administradores",
            "useLineColorForBulletBorder": true,
            "valueField": "Administradores",
            "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
        }],
        "chartCursor": {
            "pan": true,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "cursorAlpha": 0.2,
            "valueLineAlpha": 0.2
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true,
            "dashLength": 1,
            "minorGridEnabled": true
        },
        "legend": {
            "useGraphSettings": true,
            "position": "top"
        },
        "balloon": {
            "borderThickness": 1,
            "shadowAlpha": 0
        },
        "dataProvider": [{
            "date": "2013-01-16",
            "Clientes": 71,
            "Administradores": 75
        }, {
            "date": "2013-01-17",
            "Clientes": 80,
            "Administradores": 84
        }, {
            "date": "2013-01-18",
            "Clientes": 78,
            "Administradores": 83
        }, {
            "date": "2013-01-19",
            "Clientes": 85,
            "Administradores": 88
        }, {
            "date": "2013-01-20",
            "Clientes": 87,
            "Administradores": 85
        }, {
            "date": "2013-01-21",
            "Clientes": 97,
            "Administradores": 88
        }, {
            "date": "2013-01-22",
            "Clientes": 93,
            "Administradores": 88
        }, {
            "date": "2013-01-23",
            "Clientes": 85,
            "Administradores": 80
        }, {
            "date": "2013-01-24",
            "Clientes": 90,
            "Administradores": 85
        }]
    });