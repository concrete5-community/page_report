<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var array $labels */
/** @var array $data */
?>

<div class="chart-container">
    <canvas id="pagesCreatedChart"></canvas>
</div>

<script>
    $(document).ready(function() {
        var json = <?php echo json_encode($data); ?>;

        var ctx = $('#pagesCreatedChart').get(0).getContext('2d');

        var data = json.map(function(e) {
            return {
                x: new Date(e.year, e.month),
                y: e.pages
            }
        });

        new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    fill: false,
                    borderColor: 'rgba(75, 255, 75, .7)',
                    borderWidth: 2,
                    data: data
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        type: 'time',
                        parser: 'MM YYYY'
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: '<?php echo t('Pages created') ?>'
                        }
                    }]
                }
            }
        });
    });
</script>
