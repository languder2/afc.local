<div class="container-lg">
    <h3>
        <?=$spec->specName??""?>
        <?=!empty($spec->specProfile)?"<br>$spec->specProfile":""?>
    </h3>
    <div class="chart-container" style="position: relative; height:50vh; width:100%">
        <canvas id="chart"></canvas>
    </div>
    <script>
        // Получение контекста для рисования
        let canvas = window.document.getElementById('chart');
        let context = canvas.getContext('2d');
        // Переменные
        let chart = null;
        // Функции
        const createLineChart = (dates, totals, forms, levels,formColors,levelColors,formTitles,levelTitles) => {
            let gradient = context.createLinearGradient(0, 0, 0, window.screen.width/2);
            gradient.addColorStop(0, 'rgba(74, 169, 230, 0.1)');
            gradient.addColorStop(1, 'rgba(74, 169, 230, 0.001)');
            let data = {
                labels: dates,
                datasets: [{
                    label: 'Всего',
                    data: totals,
                    pointStyle: true,
                    fill: true,
                    backgroundColor: gradient,
                    borderWidth: 1,
                    borderColor: 'rgba(74, 169, 230, 1)',
                    tension: 0.2
                }]
            }
            if(forms.length>1){
                forms.forEach((form,i)=>data.datasets.push({
                    label: formTitles[i],
                    data: form,
                    pointStyle: true,
                    fill: true,
                    backgroundColor: gradient,
                    borderWidth: 1,
                    borderColor: formColors[i],
                    tension: 0.2
                }));
            }
            if(levels.length>1){
                levels.forEach((level,i)=>data.datasets.push({
                    label: levelTitles[i],
                    data: level,
                    pointStyle: true,
                    fill: true,
                    backgroundColor: gradient,
                    borderWidth: 1,
                    borderColor: levelColors[i],
                    tension: 0.2
                }));
            }



            let xScaleConfig = {
//            min:2,
//            max: 4,
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
                /*
                            zoom: {
                                mode: 'x',
                                pinch: {
                                    enabled: true
                                },
                                wheel: {
                                    enabled: true
                                },
                            }

                 */
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
                            position: "top"
                        },
                        zoom: zoomOptions
                    },
                }
            }
            chart = new Chart(context, config);
        }

        // Получение данных с сервера
        let dates = [<?=$dates??""?>];
        let totals = [<?=implode(",",$totals??[])?>];
        let forms= [
            <?php if(isset($forms)) foreach($forms as $form):?>
                [<?=implode(",",$form)?>],
            <?php endforeach;?>
        ];
        let levels= [
            <?php if(isset($levels)) foreach($levels as $level):?>
                [<?=implode(",",$level)?>],
            <?php endforeach;?>
        ];
        let formColors= [
            <?php if(isset($formColors)) foreach($formColors as $color) echo "'$color',";?>
        ];
        let levelColors= [
            <?php if(isset($levelColors)) foreach($levelColors as $color) echo "'$color',";?>
        ];
        let formTitles= [
            <?php if(isset($formTitles)) foreach($formTitles as $title) echo "'$title->specShape',";?>
        ];
        let levelTitles= [
            <?php if(isset($levelTitles)) foreach($levelTitles as $title) echo "'$title->specLevel',";?>
        ];
        createLineChart(dates, totals,forms,levels,formColors,levelColors,formTitles,levelTitles);

        // ОБРАБОТЧИКИ СОБЫТИЙ
    </script>
</div>

<div class="container-lg">
    <div class="gridSpecDetailList">
        <?php if(isset($totals)) foreach ($totals as $day=>$cnt):?>
            <?php if(empty($cnt)) continue;?>
            <div><?=$day?></div>
            <div><?=$cnt?></div>
            <div class="grid2">
                <?php if(isset($formRows[$day])) foreach ($formRows[$day] as $form=>$cnt):?>
                    <div><?=$form?></div>
                    <div><?=$cnt?></div>
                <?php endforeach;?>
            </div>
            <div class="grid2">
                <?php if(isset($levelRows[$day])) foreach ($levelRows[$day] as $level=>$cnt):?>
                    <div><?=$level?></div>
                    <div><?=$cnt?></div>
                <?php endforeach;?>
            </div>

        <?php endforeach;?>
    </div>
</div>
