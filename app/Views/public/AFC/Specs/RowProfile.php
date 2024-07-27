<?php if(!empty($profile)):?>
    <div class="grid-spec-list">
        <div>
        </div>
        <div class="ps-5">
            <a href="<?=base_url("profile/$profile->op")?>">
                <?php
                    if (!empty($profile->profile))
                        echo $profile->profile;
                    else
                        echo $specName??"";
                ?>
            </a>
        </div>

        <div class="text-center">
            <a href="<?=base_url("profile/$profile->op")?>">
                <?=$profile->edForm->name?>
            </a>
        </div>
        <div class="text-end">
            <a href="<?=base_url("profile/$profile->op")?>">
                <span class="active pr pr-1">
                    <?=$profile->pr1 ?>
                </span>
                <span class="pr pr-2">
                    <?=$profile->pr2 ?>
                </span>
                <span class="pr pr-3">
                    <?=$profile->pr3 ?>
                </span>
                <span class="pr pr-4">
                    <?=$profile->pr4 ?>
                </span>
                <span class="pr pr-5">
                    <?=$profile->pr5 ?>
                </span>
                <span class="pr pr-other">
                    <?=$profile->other ?>
                </span>
                <span class="pr pr-all">
                    <?=$profile->total ?>
                </span>
            </a>
        </div>
        <div class="text-end">
            <a href="<?=base_url("profile/$profile->op")?>">
                <?= $profile->places ?>
            </a>
        </div>
    </div>
<?php endif;?>

