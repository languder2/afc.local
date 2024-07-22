<?php if(!empty($charts)):?>
<div class="row row-cols-1 row-cols-lg-<?=count($charts??[])?>">
    <?php foreach ($charts as $chart):?>
        <div>
            <?=$chart?>
        </div>
    <?php endforeach;?>
</div>
<?php endif;?>