<h4>
    Всего заявлений: <?=$totalApp??"-"?>
</h4>
<hr>

<h4>
    По способу подачи:
</h4>
<table>
    <?php if(!empty($methodSubmitting)) foreach ($methodSubmitting->total as $rec):?>
        <tr>
            <td width="200px">
                <?=$rec->methodSubmitting?>
            </td>
            <td>
                <a href="<?=base_url("/detail/methodSubmitting/")?>">
                    <a href="<?=base_url("/detail/methodSubmitting/")?>">
                        <?=$rec->cnt?>
                    </a>

                </a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<hr>
<h4>
    По форме обучения:
</h4>
<table>
    <?php if(!empty($edForms)) foreach ($edForms->total as $rec):?>
        <tr>
            <td width="200px">
                <?=$rec->specShape?>
            </td>
            <td>
                <a href="<?=base_url("/detail/specShape/")?>">
                    <?=$rec->cnt?>
                </a>

            </td>
        </tr>
    <?php endforeach;?>
</table>
<hr>
<h4>
    Статус заявки:
</h4>
<table>
    <?php if(!empty($appStatus)) foreach ($appStatus as $rec):?>
        <tr>
            <td width="200px">
                <?=$rec->appStatus?>
            </td>
            <td>
                <a href="<?=base_url("/detail/appStatus/")?>">
                    <?=$rec->cnt?>
                </a>

            </td>
        </tr>
    <?php endforeach;?>
</table>
<hr>
<h4>
    Статус абитуриента:
</h4>
<table>
    <?php if(!empty($uStatus)) foreach ($uStatus as $rec):?>
        <tr>
            <td width="200px">
                <?=$rec->uStatus?>
            </td>
            <td>
                <a href="<?=base_url("/detail/uStatus/")?>">
                    <?=$rec->cnt?>
                </a>

            </td>
        </tr>
    <?php endforeach;?>
</table>
<hr>
<h4>
    По уровню:
</h4>
<table>
    <?php if(!empty($levels)) foreach ($levels as $rec):?>
        <tr>
            <td width="200px">
                <?=$rec->specLevel?>
            </td>
            <td>
                <a href="<?=base_url("/detail/specLevel/")?>">
                    <?=$rec->cnt?>
                </a>

            </td>
        </tr>
    <?php endforeach;?>
</table>
<hr>
<h4>
    По основанию:
</h4>
<table>
    <?php if(!empty($basis)) foreach ($basis as $rec):?>
        <tr>
            <td width="200px">
                <?=$rec->appBasis?>
            </td>
            <td>
                <a href="<?=base_url("/detail/appBasis/")?>">
                    <?=$rec->cnt?>
                </a>

            </td>
        </tr>
    <?php endforeach;?>
</table>
<hr>
<h4>
    По Гражданству:
</h4>
<table>
    <?php if(!empty($citizenship)) foreach ($citizenship as $rec):?>
        <tr>
            <td width="200px">
                <?=$rec->citizenship?>
            </td>
            <td>
                <a href="<?=base_url("/detail/citizenship/")?>">
                    <?=$rec->cnt?>
                </a>

            </td>
        </tr>
    <?php endforeach;?>
</table>
<hr>
<h4>По специальности:</h4>
<table width="100%">
    <?php if(!empty($specs)) foreach ($specs as $rec):?>
        <tr>
            <td >
                <?=$rec->specID?>
            </td>
            <td >
                <?=$rec->specCode?>
            </td>
            <td >
                <?=$rec->specLevel?>
            </td>
            <td >
                <?=$rec->specName?>
            </td>
            <td >
                <?=$rec->specProfile?>
            </td>
            <td>
                <a href="<?=base_url("/detail/specCode/")?>">
                    <?=$rec->cnt?>
                </a>

            </td>
        </tr>
    <?php endforeach;?>
</table>