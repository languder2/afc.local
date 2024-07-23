<section class="rf-map margin-top-20">
    <div class="district"><b></b><span></span></div>
    <div class="close-district">&times;</div>
    <div id="RU-SAR" class="district-text">
        <div class="saratov"></div>
    </div>
    <div id="RU-SA" class="district-text">
        <div class="saha"></div>
    </div>
    <svg
            xmlns:svg="http://www.w3.org/2000/svg"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            version="1.2"
            baseProfile="tiny"
            x="0px"
            y="0px"
            viewBox="0 0 1000 600"
            xml:space="preserve"
            xmlns:xml="http://www.w3.org/XML/1998/namespace"
    >
        <?php if(isset($list)) foreach ($list as  $region):?>
            <path
                    d           = "<?=$region->svg?>"
                    data-title  = "<?=$region->name?>"
                    data-code   = "<?=$region->code?>"
                    data-count  = "<?=$region->cnt?>"
                    class=" region
                        <?php if($region->cnt):?>
                            active
                        <?php endif;?>
                    "

            />
        <?php endforeach;?>
    </svg>
    <h3 class="text-center show-info">
        <span class="base">
            Всего: <?=$sum??0?>
        </span>
        <span class="current d-none"></span>
    </h3>
</section>

<section class="mx-auto regions mb-5">
        <div class="grid list-head">
            <div class="text-start">
                Регионы (охвачено <?=$regCount??0?>)
            </div>
            <div>
                кол-во
            </div>
        </div>

        <div class="grid list-body">
            <?php if(isset($list)) foreach ($list as $region):?>
                <?php if($region->cnt == 0) continue;?>
                <div class="text-start">
                    <?=$region->name?>
                </div>
                <div>
                    <?=$region->cnt?>
                </div>
            <?php endforeach;?>
        </div>
</section>
</>
