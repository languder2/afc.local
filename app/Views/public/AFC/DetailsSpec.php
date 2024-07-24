<?php if(!empty($charts)):?>

<div class="row row-cols-1 row-cols-lg-<?=(count($charts??[])>1)?2:1?>">
    <?php foreach ($charts as $chart):?>
        <div class="mb-5">
            <?=$chart?>
        </div>
    <?php endforeach;?>
</div>
<?php endif;?>