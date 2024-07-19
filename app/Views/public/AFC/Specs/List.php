<?php echo view("public/AFC/Specs/Filter")?>
<?php if (!empty($list)): ?>
    <div class="container-lg">
        <h3 class="my-5">
            Специальности по уровню образования:
        </h3>
        <div class="accordion specs-list" id="accordionPanelsStayOpenExample">
            <?php foreach ($list as $level): if (count($level->list) == 0) continue; ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-heading<?=$level->level->id?>">
                        <button
                                class="accordion-button"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapse<?=$level->level->id?>"
                                aria-expanded="true"
                                aria-controls="panelsStayOpen-collapse<?=$level->level->id?>"
                        >
                            <?= $level->level->name?>
                        </button>
                    </h2>

                    <div
                            id="panelsStayOpen-collapse<?=$level->level->id?>"
                            class="accordion-collapse collapse show"
                            aria-labelledby="panelsStayOpen-heading<?=$level->level->id?>"
                    >
                        <div class="accordion-body">
                            <div class="head-container">
                                <div class="grid-spec-list">
                                    <div class="text-center">
                                        ОКСО
                                    </div>
                                    <div class="text-center">
                                        Название (Профиль)
                                    </div>
                                    <div class="text-center">
                                        Форма
                                    </div>
                                    <div class="text-center">
                                        Заявок
                                    </div>
                                    <div class="text-center">
                                        Мест
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($level->list as $sKey=>$spec): ?>
                                <?php if($spec->places == 0) continue;?>

                                <?php if(count($spec->list)<2):?>
                                    <?php
                                    echo view("public/AFC/Specs/RowSingle",[
                                        "spec"      => $spec,
                                        "profile"   => reset($spec->list),
                                    ]);
                                    ?>
                                <?php else:?>
                                    <?php
                                    echo view("public/AFC/Specs/RowSpec",[
                                        "spec"=>$spec
                                    ]);
                                    ?>
                                    <?php foreach ($spec->list as $pKey=>$profile): ?>
                                        <?php if($profile->places == 0) continue;?>
                                        <?php
                                        echo view("public/AFC/Specs/RowProfile",[
                                            "specName"      =>  $spec->name,
                                            "profile"       =>  $profile
                                        ]);
                                        ?>
                                    <?php endforeach; ?>
                                <?php endif;?>
                            <?php endforeach; ?>

                            <div class="foot-container">
                                <div class="grid-spec-list">
                                    <div class="text-center">
                                        ОКСО
                                    </div>
                                    <div class="text-center">
                                        Название (Профиль)
                                    </div>
                                    <div class="text-center">
                                        Форма
                                    </div>
                                    <div class="text-center">
                                        Заявок
                                    </div>
                                    <div class="text-center">
                                        Мест
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>


