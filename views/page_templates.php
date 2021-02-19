<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\PageReport\Result\PageTemplateResult[] $templates */
?>

<table class="table table-striped table-bordered" id="tbl-page-templates">
    <thead>
        <tr>
            <th><?php echo t('Page Template') ?></th>
            <th style="width: 180px"><?php  echo t('Pages') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($templates as $template) {
            ?>
            <tr>
                <td>
                    <?php
                    echo '<a target="_blank" href="'.$template->getLink().'">'.e($template->getName()).'</a>';
                    ?>
                    <small class="text-muted">(<?php echo e($template->getHandle()); ?>)</small>
                </td>
                <td><?php echo $template->getNumberOfPages() ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#tbl-page-templates').DataTable({
        searching: false,
        lengthChange: false,
        info: false,
        order: [],
        <?php echo count($templates) > 10 ? '' : 'paging: false,'; ?>
        dom: 'rtp'
    });
})
</script>
