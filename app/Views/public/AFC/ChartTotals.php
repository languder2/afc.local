<div class="container-fluid">
    <h4>
        <?= $chartTitle ?? "" ?>
    </h4>
    <div class="row">
        <div class="col-4">
            <div class="grid-DayCnt">
                <?php if (isset($labels)) foreach ($labels as $key => $label): ?>
                    <?php $code = empty($kl) ? $key : $label; ?>
                    <div class="mb-2">
                        <?= $label ?>
                    </div>
                    <div class="mb-2 text-end">
                        <?= $values->{$code} ?? 0 ?>
                    </div>
                <?php endforeach; ?>
                <div class="mb-2" style="column-span: 2">
                    <a href="/byDays/<?= $chartID ?? "" ?>">
                        подробнее
                    </a>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div style="position: relative; height: <?= $height ?? "100vh" ?>; width: <?= $width ?? "100vw" ?>">
                <canvas id="<?= $chartID ?? "" ?>"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    // Получение контекста для рисования
    // Функции
    const createLineChart<?=$chartID ?? ""?> = (labels, values) => {
        let canv = window.document.getElementById('<?=$chartID ?? ""?>');
        let cntxt = canv.getContext('2d');

        let data = {
            labels: labels,
            datasets: [{
                label: 'Всего',
                data: values,
                pointStyle: true,
                fill: true,
                backgroundColor: '#4AA9E610',
                borderWidth: 1,
                borderColor: 'rgba(74, 169, 230, 1)',
                tension: 0.2
            }]
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
//                max: 100,
            ticks: {
                color: 'rgba(74, 169, 230, 0.9)',
                beginAtZero: true,
//                stepSize: 1
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
                    legend: {
                        display: false
                    },
                },
            }
        }
        chart = new Chart(cntxt, config);
    }

    createLineChart<?=$chartID ?? ""?>([<?=$dLabels ?? ""?>], [<?=$dValues ?? ""?>]);
</script>
