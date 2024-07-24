<section class="chart-box">
    <h3 class="mb-3 ps-4 ms-2">
        <?=$spec->code??""?>
        <?=$edForm??""?>
    </h3>
    <div class="chart-shell" style="height: <?= $height ?? "100vh" ?>; width: <?= $width ?? "100vw" ?>">
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
                max: Math.ceil(max*1.1),
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
<h5 class="mb-3 ps-4 ms-2 detailTitle">
    <?=$spec->name??""?>
    <?php if($spec->profile != $spec->name && $spec->profile!=''):?>
        <br>
        <?=$spec->profile??""?>
    <?php endif;?>
</h5>
<div class="mx-auto">
    <section class="details list-head">
        <div>
            дата
        </div>
        <div>
            пр. 1
        </div>
        <div>
            пр. 2
        </div>
        <div>
            пр. 3
        </div>
        <div>
            пр. 4
        </div>
        <div>
            пр. 5
        </div>
        <div>
            пр. >5
        </div>
        <div>
            суммарно
        </div>
    </section>
    <section class="details list-body">
        <?php foreach ($spec->data->list as $day):?>
            <div class="fw-bold">
                <?=($day->day=="all")?"всего":$day->day?>
            </div>
            <div class="fw-bold">
                <?=$day->pr1?>
            </div>
            <div>
                <?=$day->pr2?>
            </div>
            <div>
                <?=$day->pr3?>
            </div>
            <div>
                <?=$day->pr4?>
            </div>
            <div>
                <?=$day->pr5?>
            </div>
            <div>
                <?=$day->other?>
            </div>
            <div class="fw-bolder listByDay-total">
                <?=$day->total?>
            </div>
        <?php endforeach;?>
    </section>
</div>
