<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\PageReport\Result\PageTypeResult[] $pageTypes */
?>

<table class="table table-striped table-bordered" id="tbl-page-types">
    <thead>
        <tr>
            <th><?php echo t('Page Type') ?></th>
            <th style="width: 180px"><?php  echo t('Pages') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($pageTypes as $pageType) {
            ?>
            <tr>
                <td>
                    <?php
                    echo '<a target="_blank" href="'.$pageType->getLink().'">'.e($pageType->getName()).'</a>';
                    ?>
                    <small class="text-muted">(<?php echo e($pageType->getHandle()); ?>)</small>
                </td>
                <td>
                    <?php echo $pageType->getNumberOfPages() ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#tbl-page-types').DataTable({
        searching: false,
        lengthChange: false,
        info: false,
        order: [],
        <?php echo count($pageTypes) > 10 ? '' : 'paging: false,'; ?>
        dom: 'rtp'
    });
})
</script>
