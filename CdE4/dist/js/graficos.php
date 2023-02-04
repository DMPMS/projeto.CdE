<?php 
session_start();

require_once("../../database.php");
$pdo = Database::connect();

$sql = "SELECT * FROM cadastros_de_usuarios_ultimos_meses";
?>
var chart = AmCharts.makeChart("graficoUsuariosCadastradosPorMes", {
        "type": "serial",
        "theme": "light",
        "dataDateFormat": "YYYY-MM-DD",
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
        "dataProvider": [
        <?php foreach ($pdo->query($sql) as $row) { ?>
        {
            "date": "<?php echo $row['onzeMesesAtras']; ?>-01",
            "Clientes": <?php echo $row['onzeMesesAtrasCliente']; ?>,
            "Administradores": <?php echo $row['onzeMesesAtrasAdministrador']; ?>,
        },
        {
            "date": "<?php echo $row['dezMesesAtras']; ?>-01",
            "Clientes": <?php echo $row['dezMesesAtrasCliente']; ?>,
            "Administradores": <?php echo $row['dezMesesAtrasAdministrador']; ?>,
        },
        {
            "date": "<?php echo $row['noveMesesAtras']; ?>-01",
            "Clientes": <?php echo $row['noveMesesAtrasCliente']; ?>,
            "Administradores": <?php echo $row['noveMesesAtrasAdministrador']; ?>,
        },
        {
            "date": "<?php echo $row['oitoMesesAtras']; ?>-01",
            "Clientes": <?php echo $row['oitoMesesAtrasCliente']; ?>,
            "Administradores": <?php echo $row['oitoMesesAtrasAdministrador']; ?>,
        },
        {
            "date": "<?php echo $row['seteMesesAtras']; ?>-01",
            "Clientes": <?php echo $row['seteMesesAtrasCliente']; ?>,
            "Administradores": <?php echo $row['seteMesesAtrasAdministrador']; ?>,
        },
        {
            "date": "<?php echo $row['seisMesesAtras']; ?>-01",
            "Clientes": <?php echo $row['seisMesesAtrasCliente']; ?>,
            "Administradores": <?php echo $row['seisMesesAtrasAdministrador']; ?>,
        },
        {
            "date": "<?php echo $row['cincoMesesAtras']; ?>-01",
            "Clientes": <?php echo $row['cincoMesesAtrasCliente']; ?>,
            "Administradores": <?php echo $row['cincoMesesAtrasAdministrador']; ?>,
        },
        {
            "date": "<?php echo $row['quatroMesesAtras']; ?>-01",
            "Clientes": <?php echo $row['quatroMesesAtrasCliente']; ?>,
            "Administradores": <?php echo $row['quatroMesesAtrasAdministrador']; ?>,
        },
        {
            "date": "<?php echo $row['tresMesesAtras']; ?>-01",
            "Clientes": <?php echo $row['tresMesesAtrasCliente']; ?>,
            "Administradores": <?php echo $row['tresMesesAtrasAdministrador']; ?>,
        },
        {
            "date": "<?php echo $row['doisMesesAtras']; ?>-01",
            "Clientes": <?php echo $row['doisMesesAtrasCliente']; ?>,
            "Administradores": <?php echo $row['doisMesesAtrasAdministrador']; ?>,
        },
        {
            "date": "<?php echo $row['umMesAtras']; ?>-01",
            "Clientes": <?php echo $row['umMesAtrasCliente']; ?>,
            "Administradores": <?php echo $row['umMesAtrasAdministrador']; ?>,
        },
        {
            "date": "<?php echo $row['mesAtual']; ?>-01",
            "Clientes": <?php echo $row['mesAtualCliente']; ?>,
            "Administradores": <?php echo $row['mesAtualAdministrador']; ?>,
        },
        <?php } ?>
        ]
    });