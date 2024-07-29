<?php if(!empty($list)):?>
    <div class="
        rating-faculties-panel
        d-flex flex-wrap flex-lg-nowrap
        mt-3
    ">
    <?php foreach ($list as $fid=>$faculty):?>
            <a
                    href="#"
                    data-fid="<?=$fid?>"
                    class="
                        rating-faculty-btn
                        d-inline-flex
                        py-2 px-4 mx-1
                        align-items-center text-center
                        <?=($fid==35)?"active":""?>
                    "
            >
                <span>
                    <?=$faculty->name?>
                </span>
        </a>
    <?php endforeach;?>
    </div>
<?php endif;?>
