
<figure class="highcharts-figure">
    <div id="seguimientos"></div>

</figure>
<script type="text/javascript">
// Create the chart
Highcharts.chart('seguimientos', {

    title: {
        text: 'Seguimientos'
    },

    subtitle: {
        text: ''
    },

    yAxis: {
        title: {
            text: 'Number of Employees'
        }
    },

    xAxis: {
            categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio']

    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },


    series: [{
        name: 'Prospectos',
        data: [<?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>]
    }, {
        name: 'Oportunidades',
        data: [<?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>]
    }, {
        name: 'Ventas',
        data: [<?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>]
    }, {
        name: 'Resignacion de Cartera',
        data: [<?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>]
    }, {
        name: 'Other',
        data: [<?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>, <?php echo rand(1,100) ?>]
    }],


});
</script>
<style type="text/css" media="screen">
#seguimientos {
    height: 100%; 
}
.highcharts-figure, .highcharts-data-table table {
    min-width: 360px; 
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