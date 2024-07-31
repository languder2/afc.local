<?php if(isset($specs)):?>
    <div class="faculty-specs position-relative">
        <?php foreach ($specs as $code=>$spec):?>
            <div class="spec mt-2 mb-4">
                <div class="places-grid box-spec">
                    <div>
                        <a href="https://afc.local/spec/<?=$code?>">
                            <?=$code?>
                        </a>
                    </div>
                    <div>
                        <a href="https://afc.local/spec/<?=$code?>">
                            <?=$spec->name?>
                        </a>
                    </div>
                    <div class="text-end">
                        <a href="https://afc.local/spec/<?=$code?>">
                            <span class="active pr pr-1">
                                <?=$spec->details->pr1?>
                            </span>
                            <span class="pr pr-2">
                                <?=$spec->details->pr2?>
                            </span>
                            <span class="pr pr-3">
                                <?=$spec->details->pr3?>
                            </span>
                            <span class="pr pr-4">
                                <?=$spec->details->pr4?>
                            </span>
                            <span class="pr pr-5">
                                <?=$spec->details->pr5?>
                            </span>
                            <span class="pr pr-other">
                                <?=$spec->details->other?>
                            </span>
                            <span class="pr pr-all">
                                <?=$spec->details->total?>
                            </span>
                        </a>
                    </div>
                    <div class="text-end">
                        <a href="https://afc.local/spec/<?=$code?>">
                            <?=$spec->details->places??"-"?>
                        </a>
                    </div>
                </div>
                <div class="spec-profiles">
                    <?php foreach ($spec->profiles as $specID=>$profile):?>
                        <div class="places-grid box-profile">
                            <div>
                            </div>
                            <div>
                                <a href="https://afc.local/spec/<?=$profile->specID?>">
                                    <?php if(!empty($profile->profile) and $profile->profile!=$profile->name):?>
                                        <?=$profile->profile?>:
                                    <?php endif;?>
                                    <?=$profile->Form?>
                                </a>
                            </div>
                            <div class="text-end">
                                <a href="https://afc.local/spec/<?=$profile->specID?>">
                                    <span class="active pr pr-1">
                                        <?=$profile->pr1?>
                                    </span>
                                    <span class="pr pr-2">
                                        <?=$profile->pr2?>
                                    </span>
                                    <span class="pr pr-3">
                                        <?=$profile->pr3?>
                                    </span>
                                    <span class="pr pr-4">
                                        <?=$profile->pr4?>
                                    </span>
                                    <span class="pr pr-5">
                                        <?=$profile->pr5?>
                                    </span>
                                    <span class="pr pr-other">
                                        <?=$profile->other?>
                                    </span>
                                    <span class="pr pr-all">
                                        <?=$profile->total?>
                                    </span>
                                </a>
                            </div>
                            <div class="text-end">
                                <a href="https://afc.local/spec/<?=$profile->specID?>">
                                    <?=$profile->places??"-"?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>