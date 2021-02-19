<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var int $totalPages */
/** @var int $totalApproved */
/** @var int $totalUnapproved */
/** @var int $totalInTrash */
/** @var int $totalInDraft */
/** @var int $totalPageTypes */
/** @var int $totalPageTemplates */
?>

<div class="row table-container">
    <div class="col-sm-12 col-lg-6">
        <table class="table table-striped table-bordered">
            <tbody>
                <tr><td style="width: 180px;"><?php echo t('Pages') ?>:</td><td><?php  echo $totalPages ?></td></tr>
                <tr><td><?php echo t('Pages Approved') ?>:</td><td><?php  echo $totalApproved ?></td></tr>
                <tr><td><?php echo t('Pages Unapproved') ?>:</td><td><?php  echo $totalUnapproved ?></td></tr>
                <tr><td><?php echo t('Pages in Draft') ?>:</td><td><?php  echo $totalInDraft ?></td></tr>
                <tr><td><?php echo t('Pages in Trash') ?>:</td><td><?php  echo $totalInTrash ?></td></tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12 col-lg-6">
        <table class="table table-striped table-bordered">
            <tbody>
                <tr><td style="width: 180px;"><?php  echo t('Page Types') ?>:</td><td><?php echo $totalPageTypes ?></td></tr>
                <tr><td><?php echo t('Page Templates') ?>:</td><td><?php echo $totalPageTemplates ?></td></tr>
            </tbody>
        </table>
    </div>
</div>
