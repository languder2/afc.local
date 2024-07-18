<div class="container-lg">
    <h3>
        <?= $spec->specName ?? "" ?>
        <?= !empty($spec->specProfile) ? "<br>$spec->specProfile" : "" ?>
    </h3>
    <div class="chart-container" style="position: relative; height:35vh; width:100%">
        <canvas id="chart"></canvas>
    </div>
    <script>
        // Получение контекста для рисования
        let canvas = window.document.getElementById('chart');
        let context = canvas.getContext('2d');
        // Переменные
        let chart = null;
        // Функции
        const createLineChart = (dates, totals, forms, levels, formColors, levelColors, formTitles, levelTitles, yMax) => {
            let data = {
                labels: dates,
                datasets: [{
                    label: 'Всего',
                    data: totals,
                    pointStyle: true,
                    fill: true,
                    backgroundColor: '#4AA9E610',
                    borderWidth: 1,
                    borderColor: 'rgba(74, 169, 230, 1)',
                    tension: 0.2
                }]
            }
            if (forms.length > 1) {
                forms.forEach((form, i) => data.datasets.push({
                    label: formTitles[i],
                    data: form,
                    pointStyle: true,
                    fill: true,
                    backgroundColor: '#4AA9E610',
                    borderWidth: 1,
                    borderColor: formColors[i],
                    tension: 0.2
                }));
            }
            if (levels.length > 1) {
                levels.forEach((level, i) => data.datasets.push({
                    label: levelTitles[i],
                    data: level,
                    pointStyle: true,
                    fill: true,
//                    backgroundColor: gradient,
                    backgroundColor: '#4AA9E610',
                    borderWidth: 1,
                    borderColor: levelColors[i],
                    tension: 0.2
                }));
            }

            let xScaleConfig = {
                min: totals.length - 14,
                max: totals.length,
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
                max: yMax,
                ticks: {
                    color: 'rgba(74, 169, 230, 0.9)',
                    beginAtZero: true,
                    stepSize: 1
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

        // Получение данных с сервера
        let dates = [<?=$dates ?? ""?>];
        let totals = [<?=implode(",", $totals ?? [])?>];

        let forms = [
            <?php if(isset($forms)) foreach($forms as $form):?>
            [<?=implode(",", $form)?>],
            <?php endforeach;?>
        ];
        let levels = [
            <?php if(isset($levels)) foreach($levels as $level):?>
            [<?=implode(",", $level)?>],
            <?php endforeach;?>
        ];
        let formColors = [
            <?php if (isset($formColors)) foreach ($formColors as $color) echo "'$color',";?>
        ];
        let levelColors = [
            <?php if (isset($levelColors)) foreach ($levelColors as $color) echo "'$color',";?>
        ];
        let formTitles = [
            <?php if (isset($formTitles)) foreach ($formTitles as $title) echo "'$title->specShape',";?>
        ];
        let levelTitles = [
            <?php if (isset($levelTitles)) foreach ($levelTitles as $title) echo "'$title->specLevel',";?>
        ];
        let yMax = <?=max($totals) + 1?>;
        createLineChart(dates, totals, forms, levels, formColors, levelColors, formTitles, levelTitles, yMax);
    </script>
</div>
<div class="container-lg">
    <div class="chart-container" style="position: relative; height:200px; width:100%">
        <canvas id="chart2"></canvas>
    </div>
    <script>
        // Получение контекста для рисования
        let canvas2 = window.document.getElementById('chart2');
        let context2 = canvas2.getContext('2d');
        // Переменные
        let chart2 = null;
        // Функции
        const createLineChart2 = (dates, totals, forms, levels, formColors, levelColors, formTitles, levelTitles, yMax) => {
            let data = {
                labels: dates,
                datasets: [{
                    label: 'Всего',
                    data: totals,
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
                max: yMax,
                ticks: {
                    color: 'rgba(74, 169, 230, 0.9)',
                    beginAtZero: true,
                    stepSize: 1
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
                            display: false
                        },
                    },
                }
            }
            chart2 = new Chart(context2, config);
            return false;
        }
        createLineChart2(dates, totals, forms, levels, formColors, levelColors, formTitles, levelTitles, yMax);
    </script>
</div>


<div class="container-lg my-4">
    <div class="row row-cols-3 text-center">
        <div class="col-3">
            <div class="grid-DayCnt">
                <div class="fw-bold">
                    Дата
                </div>
                <div class="fw-bold">
                    Кол-во:
                </div>
                <?php $i = 0;
                if (isset($totals)) foreach ($totals as $day => $cnt): if (!$cnt) continue;
                    $i++; ?>
                    <div class="bg<?= $i % 2 ?>">
                        <?= $day ?>
                    </div>
                    <div class="bg<?= $i % 2 ?>">
                        <?= $cnt ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-5">
            <div class="grid-Day">
                <div class="fw-bold">
                    Дата
                </div>
                <div class="grid-Cnt">
                    <div class="fw-bold text-start">
                        Форма:
                    </div>
                    <div class="fw-bold">
                        Кол-во:
                    </div>
                </div>
                <?php $i = 0;
                if (isset($formRows)) foreach ($formRows as $day => $forms): if (empty($forms)) continue;
                    $i++; ?>
                    <div class="bg<?= $i % 2 ?>">
                        <?= $day ?>
                    </div>
                    <div class="grid-Cnt bg<?= $i % 2 ?>">
                        <?php foreach ($forms as $form => $cnt): ?>
                            <div class="text-start">
                                <?= $form ?>
                            </div>
                            <div>
                                <?= $cnt ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-4">
            <div class="grid-Day">
                <div class="fw-bold">
                    Дата
                </div>
                <div class="grid-Cnt">
                    <div class="fw-bold text-start">
                        Уровень:
                    </div>
                    <div class="fw-bold">
                        Кол-во:
                    </div>
                </div>
                <?php $i = 0;
                if (isset($levelRows)) foreach ($levelRows as $day => $levels): if (empty($levels)) continue;
                    $i++; ?>
                    <div class="bg<?= $i % 2 ?>">
                        <?= $day ?>
                    </div>
                    <div class="grid-Cnt bg<?= $i % 2 ?>">
                        <?php foreach ($levels as $level => $cnt): ?>
                            <div class="text-start">
                                <?= $level ?>
                            </div>
                            <div>
                                <?= $cnt ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
