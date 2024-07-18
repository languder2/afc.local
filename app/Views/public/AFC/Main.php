<div class="container-lg">
    <?php if (empty($showSpec)): ?>
        <h3 class="ps-4 my-3">Контрольные цифры приема</h3>
        <hr>
        <div class="row mb-3">
            <div class="col-12 col-lg-6">
                <?php echo $appTotals ?? ""; ?>
            </div>
            <div class="col-12 col-lg-6">
                <?php echo $abitTotals ?? ""; ?>
            </div>
        </div>
        <hr>
        <h3 class="ps-4">По способу подачи</h3>
        <div class="row mb-3">
            <?php if (isset($methodSubmitting)) foreach ($methodSubmitting as $ms): ?>
                <div class="col-12 col-lg-4">
                    <?= $ms ?? "" ?>
                </div>
            <?php endforeach; ?>
        </div>
        <hr>
        <h3 class="ps-4">По форме обучения</h3>
        <div class="row mb-3">
            <?php if (isset($forms)) foreach ($forms as $form): ?>
                <div class="col-12 col-lg-4">
                    <?= $form ?? "" ?>
                </div>
            <?php endforeach; ?>
        </div>
        <hr>
        <?= $appBasis ?? "" ?>
        <hr>
    <?php endif; ?>
    <div class="mt-4">
        <?php echo $specProfiles ?? ""; ?>
    </div>
</div>

