<?php if(!empty($list)):?>
    <?php echo view("public/Rating/FacultyTabsPanel",["list"=>$list]);?>
    <div class="rating-faculties-content rounded-bottom-4 mb-4">
        <?php foreach ($list as $fid=>$faculty):?>
            <div
                    data-fid="<?=$fid?>"
                    class="
                        rating-faculty
                        <?=(!empty($facultyID) && $fid==$facultyID)?"active":""?>
                    "
            >
                <div class="rating-faculty-levels ps-2">
                    <?php foreach ($faculty->levels as $lid=>$level):?>
                        <?php echo view("public/Rating/LevelPanel",[
                                "level" => $level,
                        ]);?>
                        <div class="rating-level">
                            <h2 class="rating-level-title">
                                <?=$level->name?>
                            </h2>
                            <div class="rating-level-specs ps-2">
                                <div class="rating-faculty-specs">
                                    <?php foreach ($level->specs as $code=>$spec):?>
                                        <div class="rating-spec">
                                            <h3 class="rating-spec-title">
                                                <?=$code?>
                                                <?=$spec->name?>
                                            </h3>
                                            <div class="rating-spec-profiles ps-2">
                                                <?php foreach ($spec->profiles as $specID=>$profile):?>
                                                    <div class="rating-spec">
                                                        <h5 class="rating-spec-title">
                                                            <?php if(!empty($profile->profile) and $profile->profile!=$profile->name):?>
                                                                <?=$profile->profile?>:
                                                            <?php endif;?>
                                                            <?=$profile->Form?>
                                                        </h5>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>
