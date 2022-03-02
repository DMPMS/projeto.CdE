<?php 
session_start();
?>
"use strict";
$(document).ready(function () {
    var chart = AmCharts.makeChart("grafico_novos_usuarios", {
        "type": "serial",
        "theme": "light",
        "precision": 0,
        "valueAxes": [{
                "gridAlpha": 0,
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
            "valueLineBalloonEnabled": false,
            "cursorAlpha": 0.2,
            "valueLineAlpha": 0.2,
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": false,
            "dashLength": 0,
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
            "date": "<?php echo date('m/Y', strtotime('-11 months'));?>",
            "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][11];?>,
            "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][11];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-10 months'));?>",
                "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][10];?>,
                "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][10];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-9 months'));?>",
                "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][9];?>,
                "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][9];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-8 months'));?>",
                "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][8];?>,
                "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][8];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-7 months'));?>",
                "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][7];?>,
                "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][7];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-6 months'));?>",
                "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][6];?>,
                "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][6];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-5 months'));?>",
                "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][5];?>,
                "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][5];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-4 months'));?>",
                "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][4];?>,
                "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][4];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-3 months'));?>",
                "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][3];?>,
                "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][3];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-2 months'));?>",
                "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][2];?>,
                "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][2];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-1 months'));?>",
                "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][1];?>,
                "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][1];?>
            }, {
                "date": "<?php echo date('m/Y');?>",
                "Clientes": <?php echo $_SESSION['grafico_novos_usuarios_Clientes'][0];?>,
                "Administradores": <?php echo $_SESSION['grafico_novos_usuarios_Administradores'][0];?>
            }]
    });
    
    var chart = AmCharts.makeChart("grafico_novos_produtos", {
        "type": "serial",
        "theme": "light",
        "precision": 0,
        "valueAxes": [{
                "gridAlpha": 0,
            }],
        "graphs": [{
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 8,
                "hideBulletsCount": 50,
                "lineThickness": 3,
                "lineColor": "#2dce89",
                "title": "Produtos",
                "useLineColorForBulletBorder": true,
                "valueField": "Produtos",
                "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
            }, {
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 8,
                "hideBulletsCount": 50,
                "lineThickness": 3,
                "lineColor": "#42d16a",
                "title": "Tipos",
                "useLineColorForBulletBorder": true,
                "valueField": "Tipos",
                "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
            }],
        "chartCursor": {
            "pan": true,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": false,
            "cursorAlpha": 0.2,
            "valueLineAlpha": 0.2,
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": false,
            "dashLength": 0,
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
            "date": "<?php echo date('m/Y', strtotime('-11 months'));?>",
            "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][11];?>,
            "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][11];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-10 months'));?>",
                "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][10];?>,
                "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][10];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-9 months'));?>",
                "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][9];?>,
                "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][9];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-8 months'));?>",
                "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][8];?>,
                "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][8];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-7 months'));?>",
                "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][7];?>,
                "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][7];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-6 months'));?>",
                "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][6];?>,
                "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][6];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-5 months'));?>",
                "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][5];?>,
                "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][5];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-4 months'));?>",
                "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][4];?>,
                "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][4];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-3 months'));?>",
                "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][3];?>,
                "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][3];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-2 months'));?>",
                "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][2];?>,
                "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][2];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-1 months'));?>",
                "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][1];?>,
                "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][1];?>
            }, {
                "date": "<?php echo date('m/Y');?>",
                "Produtos": <?php echo $_SESSION['grafico_novos_produtos_Produtos'][0];?>,
                "Tipos": <?php echo $_SESSION['grafico_novos_produtos_Tipos'][0];?>
            }]
    });

    var chart = AmCharts.makeChart("grafico_novas_vendas", {
        "type": "serial",
        "theme": "light",
        "precision": 0,
        "valueAxes": [{
                "gridAlpha": 0,
            }],
        "graphs": [{
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 8,
                "hideBulletsCount": 50,
                "lineThickness": 3,
                "lineColor": "#fb6340",
                "title": "Vendas",
                "useLineColorForBulletBorder": true,
                "valueField": "Vendas",
                "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
            }, {
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 8,
                "hideBulletsCount": 50,
                "lineThickness": 3,
                "lineColor": "#ff8000",
                "title": "VendasCanceladas",
                "useLineColorForBulletBorder": true,
                "valueField": "VendasCanceladas",
                "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
            }],
        "chartCursor": {
            "pan": true,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": false,
            "cursorAlpha": 0.2,
            "valueLineAlpha": 0.2,
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": false,
            "dashLength": 0,
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
            "date": "<?php echo date('m/Y', strtotime('-11 months'));?>",
            "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][11];?>,
            "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][11];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-10 months'));?>",
                "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][10];?>,
                "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][10];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-9 months'));?>",
                "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][9];?>,
                "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][9];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-8 months'));?>",
                "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][8];?>,
                "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][8];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-7 months'));?>",
                "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][7];?>,
                "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][7];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-6 months'));?>",
                "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][6];?>,
                "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][6];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-5 months'));?>",
                "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][5];?>,
                "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][5];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-4 months'));?>",
                "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][4];?>,
                "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][4];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-3 months'));?>",
                "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][3];?>,
                "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][3];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-2 months'));?>",
                "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][2];?>,
                "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][2];?>
            }, {
                "date": "<?php echo date('m/Y', strtotime('-1 months'));?>",
                "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][1];?>,
                "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][1];?>
            }, {
                "date": "<?php echo date('m/Y');?>",
                "Vendas": <?php echo $_SESSION['grafico_novas_vendas_Vendas'][0];?>,
                "VendasCanceladas": <?php echo $_SESSION['grafico_novas_vendas_VendasCanceladas'][0];?>
            }]
    });
});