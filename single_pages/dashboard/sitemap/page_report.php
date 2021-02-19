<?php

defined('C5_EXECUTE') or die('Access Denied.');

// Charts
/** @var string $pagesUpdatedChart */
/** @var string $pagesCreatedChart */
/** @var string $pagesByAuthorChart */

// Other statistics
/** @var string $generalStatistics */
/** @var string $unapprovedPages */
/** @var string $pageTemplates */
/** @var string $pageTypes */
?>

<div class="ccm-dashboard-content-inner">
    <?php
    echo $generalStatistics;
    ?>

    <div class="charts-container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?php echo $pagesCreatedChart; ?>

                <header>
                    <?php
                    echo t('Pages created over time');
                    ?>
                </header>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?php echo $pagesUpdatedChart; ?>

                <header>
                    <?php
                    echo t('Pages updated over time');
                    ?>
                </header>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?php echo $pagesByAuthorChart; ?>

                <header>
                    <?php
                    echo t('Number of pages by author');
                    ?>
                </header>
            </div>
        </div>
    </div>

    <div class="row table-container">
        <div class="col-sm-12 col-lg-6">
            <?php echo $pageTemplates; ?>
        </div>
        <div class="col-sm-12 col-lg-6">
            <?php echo $pageTypes; ?>
        </div>
    </div>

    <div class="row table-container">
        <div class="col-sm-12 col-lg-6">
            <?php echo $unapprovedPages; ?>
        </div>
        <div class="col-sm-12 col-lg-6">

        </div>
    </div>
</div>
