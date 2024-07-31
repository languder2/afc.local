<?php if(isset($specs)):?>
    <div class="faculty-specs position-relative">
        <?php foreach ($specs as $code=>$spec):?>
            <div class="spec mt-2 mb-4">
                <h5  class="spec-title">
                    <?=$code?>
                    <?=$spec->name?>
                    <pre>
                        <?php print_r($spec->details)?>
                    </pre>
                </h5>
                <div class="spec-profiles ps-2">
                    <?php foreach ($spec->profiles as $specID=>$profile):?>
                        <div class="spec">
                            <h5 class="spec-title ms-3">
                                <?php if(!empty($profile->profile) and $profile->profile!=$profile->name):?>
                                    <?=$profile->profile?>:
                                <?php endif;?>
                                <?=$profile->Form?>
                                <?php //print_r($profile)?>
                            </h5>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>