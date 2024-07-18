    <?php if (!empty($list)): ?>
        <div class="container-lg">
            <h3>
                Специальности:
            </h3>
            <?php foreach ($list as $level): if (count($level->list) == 0) continue; ?>
                <h5 class="pt-4 pb-2">
                    <?= $level->title ?>
                </h5>
                <div class="gridSpecList2">
                    <div class="fw-bold">
                        ОКСО
                    </div>
                    <div class="fw-bold">
                        Название (Профиль)
                    </div>
                    <div class="fw-bold">
                        Заявок
                    </div>
                    <div class="fw-bold">
                        Мест
                    </div>
                    <?php foreach ($level->list as $spec): ?>
                        <?php if (count($spec->list) < 2): ?>
                            <?php
                            $profile = current($spec->list);
                            ?>
                            <div>
                                <?= $profile->code ?>
                            </div>
                            <div>
                                <?= $profile->name ?>
                                <?php if ($profile->name != $profile->profile and !empty($profile->profile)): ?>
                                    (<?= $profile->profile ?>)
                                <?php endif; ?>
                            </div>
                            <div>
                                <?= $profile->cnt ?>
                            </div>
                            <div>
                                <?= $profile->places ?>
                            </div>
                        <?php else: ?>

                            <div>
                                <?= $spec->code ?>
                            </div>
                            <div>
                                <?= $spec->name ?>
                            </div>
                            <div>
                                <?= $spec->cnt ?>
                            </div>
                            <div>
                                <?= $spec->places ?>
                            </div>
                            <?php foreach ($spec->list as $profile): ?>
                                <div>
                                </div>
                                <div class="ps-5">
                                    <?= $profile->profile ?>
                                    <?php if ($profile->profile == " "): ?>
                                        <?php print_r($profile->profile) ?>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?= $profile->cnt ?>
                                </div>
                                <div>
                                    <?= $profile->places ?>
                                </div>
                            <?php endforeach; ?>


                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
