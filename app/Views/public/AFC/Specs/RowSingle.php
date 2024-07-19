<?php if(isset($spec,$profile)):?>
    <div class="grid-spec-list">
        <div class="text-center">
            <a href="<?=base_url("profile/$profile->op")?>">
                <?= $spec->code??"" ?>
            </a>
        </div>
        <div>
            <a href="<?=base_url("profile/$profile->op")?>">
                <?= $spec->name??"" ?>
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
                    <?=$spec->pr1??"" ?>
                </span>
                <span class="pr pr-2">
                    <?=$spec->pr2??"" ?>
                </span>
                <span class="pr pr-3">
                    <?=$spec->pr3??"" ?>
                </span>
                <span class="pr pr-4">
                    <?=$spec->pr4??"" ?>
                </span>
                <span class="pr pr-5">
                    <?=$spec->pr5??"" ?>
                </span>
                <span class="pr pr-other">
                    <?=$spec->other??"" ?>
                </span>
                <span class="pr pr-all">
                    <?=$spec->cnt??"" ?>
                </span>
            </a>
        </div>
        <div class="text-end">
            <a href="<?=base_url("profile/$profile->op")?>">
                <?= $spec->places??"" ?>
            </a>
        </div>
    </div>
<?php endif;?>