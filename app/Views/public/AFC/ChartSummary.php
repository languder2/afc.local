
<section>
    <?php if(!empty($chartTitle)):?>
        <h3 class="mb-3">
            <a href="<?=$link??"#"?>" class="head-link">
                <?=$chartTitle?>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.854 8.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707z"/>
                </svg>
            </a>
        </h3>
    <?php endif;?>
    <div style="position: relative; height: <?= $height ?? "100vh" ?>; width: <?= $width ?? "100vw" ?>">
        <canvas id="<?=$chartID??""?>"></canvas>
    </div>
    <script>
        // Получение контекста для рисования
        // Функции
        const createLineChart<?=$chartID ?? ""?> = (labels, datasets,legend,max) => {
            let canv = window.document.getElementById('<?=$chartID ?? ""?>');
            let cntxt = canv.getContext('2d');

            let data = {
                labels: labels,
                datasets: datasets
            }
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
            let yScaleConfig = {
                max: Math.ceil(max*1.2),
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
            let config = {
                type: 'bar',
                data: data,
                options: {
                    aspectRatio: 2,
                    maintainAspectRatio: false,
                    scales: {
                        x: xScaleConfig,
                        y: yScaleConfig
                    },
                    plugins: {
                        legend: legend,
                    },
                }
            }
            chart = new Chart(cntxt, config);
        }


        <?php if(!empty($legend)):?>
        let legend<?=$chartID??""?>= {
            position: "bottom"
        }
        <?php else:?>
        let legend<?=$chartID??""?>= {
            display: false
        }
        <?php endif;?>

        let datasets<?=$chartID??""?>= [
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
        createLineChart<?=$chartID ?? ""?>(
            <?=$labels ?? ""?>,
            datasets<?=$chartID??""?>,
            legend<?=$chartID??""?>,
            <?=$max??0?>
        );
    </script>
</section>


