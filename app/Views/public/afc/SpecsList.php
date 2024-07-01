<?php if(!empty($list)):?>
    <div class="container-lg">
        <h3>
            Специальности:
        </h3>
        <?php foreach ($list as $level): if(count($level->list)==0) continue;?>
            <h5 class="pt-4 pb-2">
                <?=$level->title?>
            </h5>
            <div class="gridSpecList">
                <?php foreach ($level->list as $spec):?>
                    <div>
                        <a href="<?=base_url("/afc/spec/$spec->specID/")?>">
                            <?=$spec->specName?>
                            <?=$spec->specProfile?": $spec->specProfile":""?>
                        </a>
                    </div>
                    <div>
                        <?=$spec->cnt?>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>
