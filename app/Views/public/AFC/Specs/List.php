<?php if (!empty($list)): ?>
    <div class="container-lg">
        <h3>
            Специальности:
        </h3>
        <?php foreach ($list as $level): if (count($level->list) == 0) continue; ?>
            <h5 class="pt-4 pb-2">
                <?= $level->level->name?>
            </h5>
            <div class="gridSpecList2">
                <div class="fw-bold text-center">
                    ОКСО
                </div>
                <div class="fw-bold text-center">
                    Название (Профиль)
                </div>
                <div class="fw-bold text-center">
                    Форма
                </div>
                <div class="fw-bold text-center">
                    Заявок
                </div>
                <div class="fw-bold text-center">
                    Мест
                </div>
                <?php foreach ($level->list as $spec): ?>
                    <?php if($spec->places == 0) continue;?>
                    <div class="text-center">
                        <?= $spec->code ?>
                    </div>
                    <div>
                        <?= $spec->name ?>
                    </div>
                    <div></div>
                    <div class="text-end">
                        <?= $spec->pr1 ?>
                    </div>
                    <div class="text-end">
                        <?= $spec->places ?>
                    </div>
                    <?php foreach ($spec->list as $key=>$profile): ?>
                        <?php if($profile->places == 0) continue;?>
                        <div>
                        </div>
                        <div class="ps-5">
                            <?= $profile->profile ?>
                            <?php if ($profile->profile == " "): ?>
                                <?php print_r($profile->profile) ?>
                            <?php endif; ?>
                        </div>

                        <div class="text-center">
                            <?=$profile->edFrom->name?>
                        </div>
                        <div class="text-end">

                                <span class="active pr-1">
                                    <?=$profile->pr1 ?>
                                </span>
                                 <span class="d-none pr-2">
                                    <?=$profile->pr2 ?>
                                </span>
                                <span class="d-none pr-3">
                                    <?=$profile->pr3 ?>
                                </span>
                                <span class="d-none pr-4">
                                    <?=$profile->pr4 ?>
                                </span>
                                <span class="d-none pr-5">
                                    <?=$profile->pr5 ?>
                                </span>
                                <span class="d-none pr-other">
                                    <?=$profile->other ?>
                                </span>
                                <span class="d-none pr-all">
                                    <?=$profile->other ?>
                                </span>
                        </div>
                        <div class="text-end">
                            <?= $profile->places ?>
                        </div>
                    <?php endforeach; ?>

                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<?php echo view("public/AFC/Specs/Filter")?>