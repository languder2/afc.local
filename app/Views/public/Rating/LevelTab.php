<?php if(isset($levels) and count($levels)):?>
    <div class="faculty-levels" data-fid="<?=$fid??0?>">
        <?php foreach ($levels as $level):?>
            <div
                    class="faculty-level"
                    data-lid="<?=$level->id?>"
                    data-fid="<?=$fid??0?>"
            >
                <h4 class="levelTitle m-0">
                    <?=$level->name?>
                </h4>
                <?php
                    if(isset($specListType) && $specListType == "rating")
                        echo view("public/Rating/SpecList",[
                            "specs"=>$level->specs
                        ]);
                    else
                        echo view("public/Rating/SpecListPlaces",[
                            "specs"=>$level->specs
                        ]);
                ?>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>
