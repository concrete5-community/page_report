<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\PageReport\Result\UnapprovedPage[] $pages */
?>

<table class="table table-striped table-bordered" id="tbl-unapproved-pages">
    <thead>
        <tr>
            <th><?php echo t('Unapproved Page') ?></th>
            <th style="width: 180px"><?php  echo t('Last Modified') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($pages as $page) {
            ?>
            <tr>
                <td>
                    <?php
                    if ($page->getName()) {
                        echo '<a target="_blank" href="'.$page->getLink().'">'.$page->getName().'</a>';
                    } else {
                        echo t('Unknown');
                    }
                    ?>
                </td>
                <td><?php echo $page->getDateModified() ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#tbl-unapproved-pages').DataTable({
        searching: false,
        lengthChange: false,
        info: false,
        order: [],
        <?php echo count($pages) > 10 ? '' : 'paging: false,'; ?>
        dom: 'rtp'
    });
})
</script>
