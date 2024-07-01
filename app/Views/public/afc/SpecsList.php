<?php if(!empty($list)):?>
    <div class="container-lg">
        <h4>
            Специальности:
        </h4>
        <div class="gridSpecList">
            <?php foreach ($list as $item):?>
                <div>
                    <a href="<?=base_url("/afc/spec/$item->specID/")?>">
                        <?=$item->specName?>
                        <?=$item->specProfile?": $item->specProfile":""?>
                    </a>
                </div>
                <div>
                    <?=$item->cnt?>
                </div>
            <?php endforeach;?>
        </div>
    </div>
<?php endif;?>
