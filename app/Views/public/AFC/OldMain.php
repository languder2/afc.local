<h4>
    Всего заявлений: <?= $totalApp ?? "-" ?>
</h4>
<hr>

<h4>
    По способу подачи:
</h4>
<table>
    <?php if (!empty($methodSubmitting)) foreach ($methodSubmitting->total as $rec): ?>
        <tr>
            <td width="200px">
                <?= $rec->methodSubmitting ?>
            </td>
            <td>
                <a href="<?= base_url("/detail/methodSubmitting/") ?>">
                    <a href="<?= base_url("/detail/methodSubmitting/") ?>">
                        <?= $rec->cnt ?>
                    </a>

                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<hr>
<h4>
    По форме обучения:
</h4>
<table>
    <?php if (!empty($edForms)) foreach ($edForms->total as $rec): ?>
        <tr>
            <td width="200px">
                <?= $rec->specShape ?>
            </td>
            <td>
                <a href="<?= base_url("/detail/specShape/") ?>">
                    <?= $rec->cnt ?>
                </a>

            </td>
        </tr>
    <?php endforeach; ?>
</table>
<hr>
<h4>
    Статус заявки:
</h4>
<table>
    <?php if (!empty($appStatus)) foreach ($appStatus as $rec): ?>
        <tr>
            <td width="200px">
                <?= $rec->appStatus ?>
            </td>
            <td>
                <a href="<?= base_url("/detail/appStatus/") ?>">
                    <?= $rec->cnt ?>
                </a>

            </td>
        </tr>
    <?php endforeach; ?>
</table>
<hr>
<h4>
    Статус абитуриента:
</h4>
<table>
    <?php if (!empty($uStatus)) foreach ($uStatus as $rec): ?>
        <tr>
            <td width="200px">
                <?= $rec->uStatus ?>
            </td>
            <td>
                <a href="<?= base_url("/detail/uStatus/") ?>">
                    <?= $rec->cnt ?>
                </a>

            </td>
        </tr>
    <?php endforeach; ?>
</table>
<hr>
<h4>
    По уровню:
</h4>
<table>
    <?php if (!empty($levels)) foreach ($levels as $rec): ?>
        <tr>
            <td width="200px">
                <?= $rec->specLevel ?>
            </td>
            <td>
                <a href="<?= base_url("/detail/specLevel/") ?>">
                    <?= $rec->cnt ?>
                </a>

            </td>
        </tr>
    <?php endforeach; ?>
</table>
<hr>
<h4>
    По основанию:
</h4>
<table>
    <?php if (!empty($basis)) foreach ($basis as $rec): ?>
        <tr>
            <td width="200px">
                <?= $rec->appBasis ?>
            </td>
            <td>
                <a href="<?= base_url("/detail/appBasis/") ?>">
                    <?= $rec->cnt ?>
                </a>

            </td>
        </tr>
    <?php endforeach; ?>
</table>
<hr>
<h4>
    По Гражданству:
</h4>
<?php if (!empty($citizenship)) foreach ($citizenship as $rec): ?>
    <table>
        <tr style="border: solid 1px #e5e5e5;">
            <td width="200px">
                <?= $rec->citizenship ?>
            </td>
            <td>
                <a href="<?= base_url("/detail/citizenship/") ?>">
                    <?= $rec->cnt ?>
                </a>

            </td>
        </tr>
    </table>
<?php endforeach; ?>
<hr>
<h4>По специальности:</h4>
<table width="100%" class="specs">
    <?php if (!empty($specs)) foreach ($specs as $rec): ?>
        <tr>
            <td>
                <?= $rec->specName ?>
                <br>
                <?= $rec->specProfile ?>
            </td>
            <td>
                <div class="grid">
                    <?php if ($rec->codes) foreach ($rec->codes as $code): ?>
                        <div>
                            <?= $code->specCode ?? "" ?>
                        </div>
                        <div>
                            <?= $code->cnt ?? "" ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </td>
            <td>
                <div class="grid">
                    <?php if ($rec->levels) foreach ($rec->levels as $level): ?>
                        <div>
                            <?= $level->specLevel ?? "" ?>
                        </div>
                        <div>
                            <?= $level->cnt ?? "" ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </td>
            <td>
                <a href="<?= base_url("/detail/specCode/") ?>">
                    <?= $rec->cnt ?>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<style>
    .specs tr:nth-child(2n+1) {
        background: #f5f5f5;
    }

    .specs tr:nth-child(2n) {
        background: #fafafa;
    }

    .specs td {
        padding: 2px 7px;
    }

    .specs .grid {
        display: grid;
        grid-template-columns: 1fr 50px;
        gap: 2px;
    }
</style>