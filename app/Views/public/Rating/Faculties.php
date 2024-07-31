<?php
    if(isset($specListType) and $specListType != "rating")
        echo view("public/AFC/Specs/Filter")
?>
<?php if(!empty($list)):?>
    <div class="faculties">
        <?php echo view("public/Rating/FacultyTabsPanel",["list"=>$list]);?>
        <div class="faculties-content rounded-bottom-4 mb-4">
            <?php foreach ($list as $fid=>$faculty):?>
                <div
                        data-fid="<?=$fid?>"
                        class="
                        faculty
                        <?=(!empty($facultyID) && $fid==$facultyID)?"show":""?>
                    "
                >
                    <?php echo view("public/Rating/LevelTab",[
                        "levels"    => $faculty->levels,
                        "fid"       => $fid,
                    ]);?>
                </div>
            <?php endforeach;?>
        </div>
    </div>
<?php endif;?>


<div class="container">
    <div class="grid-test row row-cols-lg-2 g-3">
        <div>
            <div class="text-white bg-primary">
                123
            </div>
        </div>
        <div>
            <div class="text-white bg-primary">
                123
            </div>
        </div>
        <div>
            <div class="text-white bg-primary">
                123
            </div>
        </div>
    </div>
</div>
<style>
    .grid-test > div{
        padding: 3px;

    }
    .grid-test > div:hover div{
        background-color:       red !important;
        margin-top:             -3px;
        margin-bottom:          3px;
        box-shadow:             0 0 5px 2px green;
    }
</style>

