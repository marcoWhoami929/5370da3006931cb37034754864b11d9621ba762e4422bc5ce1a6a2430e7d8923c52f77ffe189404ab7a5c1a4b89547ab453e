<figure class="highcharts-figure">
    <div id="oportunidades"></div>

</figure>
<script type="text/javascript">
	var chart = Highcharts.chart('oportunidades', {

    title: {
        text: 'Oprtunidades'
    },

    subtitle: {
       
    },

    xAxis: {
        categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio']
    },

    series: [{
        type: 'column',
        colorByPoint: true,
        data: [<?php echo rand(1,80) ?>, <?php echo rand(1,80) ?>, <?php echo rand(1,80) ?>, <?php echo rand(1,80) ?>, <?php echo rand(1,80) ?>,<?php echo rand(1,80) ?>, <?php echo rand(1,80) ?>],
        showInLegend: false
    }]

});


$('#plain').click(function () {
    chart.update({
        chart: {
            inverted: false,
            polar: false
        },
        subtitle: {
            text: 'Plain'
        }
    });
});


</script>
<style type="text/css" media="screen">
#oportunidades {
    height: 400px; 
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>