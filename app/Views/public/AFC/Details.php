<?php if(!empty($charts)):?>
    <div class="row row-cols-1 row-cols-lg-<?=count($charts??[])?>">
        <?php foreach ($charts as $chart):?>
            <div>
                <?=$chart?>
            </div>
        <?php endforeach;?>
    </div>
<?php elseif(!empty($chart)):?>
    <div class="row row-cols-1">
        <div>
            <?=$chart?>
        </div>
    </div>
<?php endif;?>