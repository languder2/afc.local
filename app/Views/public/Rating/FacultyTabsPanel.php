<?php if(!empty($list)):?>
    <div class="rating-faculties-panel"
    <?php foreach ($list as $fid=>$faculty):?>
        <div class="rating-faculty-btn">
            <a href="#" data-fid="<?=$fid?>">
                <?=$faculty->name?>
            </a>
        </div>
    <?php endforeach;?>
    </div>
<?php endif;?>
