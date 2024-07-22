<section class="mb-5">
    <h3 class="mb-3 ps-4 ms-2">
        <?=$chartTitle??""?>
    </h3>
    <div style="position: relative; height: <?= $height ?? "100vh" ?>; width: <?= $width ?? "100vw" ?>">
        <canvas id="chartDetail_<?=$cid??""?>"></canvas>
    </div>
    <script>
        // Получение контекста для рисования
        // Функции
        const createLineChart<?=$cid??""?> = (labels, datasets,max) => {
            let canv = window.document.getElementById("chartDetail_<?=$cid??""?>");
            let cntxt = canv.getContext('2d');

            let data = {
                labels: labels,
                datasets: datasets
            }

            let xScaleConfig = {
                max: 30,
                ticks: {
                    autoSkip: true,
                    maxRotation: 0,
                    // minRotation: 90,
                    //color: 'rgba(74, 169, 230, 1)'
                    color: 'rgba(33, 33, 33, 1)'
                },
                border: {
                    color: 'rgba(74, 169, 230, 1)'
                },
                grid: {
                    color: 'rgba(74, 169, 230, 0.3)'
                }
            }

            let yScaleConfig = {
                max: Math.ceil(max*1.1),
                ticks: {
                    //color: 'rgba(74, 169, 230, 0.9)',
                    color: 'rgba(33, 33, 33, 0.9)',
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
            chart = new Chart(cntxt, config);
        }



        let datasets<?=$cid??""?>= [
            <?php foreach ($datasets??[] as $data):?>
            {
                label: '<?=$data->label?>',
                data: <?=$data->list?>,
                pointStyle: true,
                fill: true,
                backgroundColor: '#4AA9E610',
                borderWidth: 1,
                borderColor: '<?=$data->color?>',
                tension: 0.2
            },
            <?php endforeach;;?>
        ];
        createLineChart<?=$cid??""?>(
            <?=$labels ?? ""?>,
            datasets<?=$cid??""?>,
            <?=$max??0?>
        );
    </script>
</section>
