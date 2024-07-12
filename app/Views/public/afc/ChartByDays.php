<div class="container-lg">
    <h3>
        <?=$chartTitle??""?>
    </h3>
    <div class="chart-container" style="position: relative; height:35vh; width:100%">
        <canvas id="chart"></canvas>
    </div>
    <div class="chart-container" style="position: relative; height:200px; width:100%">
        <canvas id="chart2"></canvas>
    </div>
    <script>
        const createLineChart = (chart, context, data, max, from= false) => {
            let xScaleConfig = {
                ticks: {
                    autoSkip: true,
                    maxRotation: 0,
                    // minRotation: 90,
                    color: 'rgba(74, 169, 230, 1)'
                },
                border: {
                    color: 'rgba(74, 169, 230, 1)'
                },
                grid: {
                    color: 'rgba(74, 169, 230, 0.3)'
                }
            }

            if(from)
                xScaleConfig.min= from;

            let yScaleConfig = {
                max: max,
                ticks: {
                    color: 'rgba(74, 169, 230, 0.9)',
                    beginAtZero: true,
                },
                border: {
                    color: 'rgba(74, 169, 230, 1)'
                },
                grid: {
                    color: 'rgba(74, 169, 230, 0.3)'
                }
            }
            let zoomOptions = {
                pan: {
                    enabled: true,
                    mode: 'x',
                },
                /*  zoom: { mode: 'x',  pinch: { enabled: true }, wheel: { enabled: true } } */
            }
            let config = {
                type: 'line',
                data: data,
                options: {
                    aspectRatio: 2,
                    maintainAspectRatio: false,
                    scales: {
                        x: xScaleConfig,
                        y: yScaleConfig
                    },
                    plugins: {
                        legend: {
                            position: "bottom"
                        },
                        zoom: zoomOptions
                    },
                }
            }
            chart = new Chart(context, config);
        }


        let data = {
            labels: ['<?=implode("','",$dates??[])?>'],
            datasets: [
                <?php $j= 0; ?>
                <?php if(!empty($datasets)) foreach ($datasets as $code=>$dataset):?>
                    <?php $j++; ?>
                    {
                        label: '<?=$code?>',
                        data: [<?=$dataset??""?>],
                        pointStyle: true,
                        fill: true,
                        backgroundColor: '#4AA9E610',
                        borderWidth: 1,
                        borderColor: '<?=$colors[$j]??"#4AA9E6"?>',
                        tension: 0.2
                    },
                <?php endforeach;?>
            ]
        }
        let max= <?=$max??1?>;

        let canvas = window.document.getElementById('chart');
        let context = canvas.getContext('2d');
        let chart = null;

        createLineChart(chart,context,data,max,data.labels.length-14);

        let canvas2 = window.document.getElementById('chart2');
        let context2 = canvas2.getContext('2d');
        let chart2 = null;

        createLineChart(chart2,context2,data,max);
    </script>
</div>

