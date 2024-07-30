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
<div class="test2 d-flex ">
    <div>
        <button>123</button>
    </div>
    <div>
        <button>123</button>
    </div>
    <div>
        <button>123</button>
    </div>
    <div>
        <button>123</button>
    </div>
    <div class="ms-auto">
        <button>123</button>
    </div>
</div>
<style>
    .test2{
        width: 100%;
        background-color: #0a53be30;
    }
    .test2 > div{
        padding: 3px;
    }
    .test2 > div:hover button{
        background-color:       red;
        color:                  white;
        transform:              scale(1.3);
        box-shadow:             0 0 5px 2px green;
    }

</style>