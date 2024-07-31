<?php if(!empty($header)):?>
    <h3 class="header-sticky">
        <?=$header?>
    </h3>
<?php endif;?>

<?php if(!empty($charts)):?>
    <?php foreach ($charts as $chart):?>
        <?php if(!empty($chart->title)):?>
            <h3 class="mb-4 mx-auto header-limited <?=(count($charts)==1)?"mw-814":""?>"">
                <?=$chart->title?>
            </h3>
        <?php endif;?>
        <div class="row row-cols-1 <?=(count($charts)>1)?"row-cols-lg-2":""?>">
            <div>
                <?=$chart->chart?>
            </div>
            <div>
                <div class="mx-auto box-byDays mb-5">
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
                        <?php foreach ($chart->list as $day):?>
                            <div class="fw-bold">
                                <?=$day->day?>
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
                            <div class="fw-bold">
                                <?=$day->total?>
                            </div>
                        <?php endforeach;?>
                    </section>

                    <section class="details list-foot">
                        <div>
                            всего
                        </div>
                        <div>
                            <?=$chart->total->pr1?>
                        </div>
                        <div>
                            <?=$chart->total->pr2?>
                        </div>
                        <div>
                            <?=$chart->total->pr3?>
                        </div>
                        <div>
                            <?=$chart->total->pr4?>
                        </div>
                        <div>
                            <?=$chart->total->pr5?>
                        </div>
                        <div>
                            <?=$chart->total->other?>
                        </div>
                        <div>
                            <?=$chart->total->total?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    <?php endforeach;?>
<?php elseif(!empty($chart)):?>
    <div class="row row-cols-1">
        <div>
            <?=$chart?>
        </div>
    </div>
<?php endif;?>

