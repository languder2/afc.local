<?php if(isset($spec)):?>
    <div class="grid-spec-list">
        <div class="text-center">
            <a href="<?=base_url("spec/$spec->code")?>">
                <?= $spec->code??"" ?>
            </a>
        </div>
        <div class="span-2">
            <a href="<?=base_url("spec/$spec->code")?>">
                <?= $spec->name??"" ?>
            </a>
        </div>
        <div class="text-end">
            <a href="<?=base_url("spec/$spec->code")?>">
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
            <a href="<?=base_url("spec/$spec->code")?>">
                <?= $spec->places??"" ?>
            </a>
        </div>
    </div>
<?php endif;?>