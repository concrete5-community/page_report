<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var array $labels */
/** @var array $data */
?>

<div class="chart-container">
    <canvas id="pagesByAuthorChart"></canvas>
</div>

<script>
    $(document).ready(function() {
        var ctx = $('#pagesByAuthorChart').get(0).getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        'rgb(100, 0, 100)',
                        'rgb(140, 0, 100)',
                        'rgb(180, 0, 100)',
                        'rgb(220, 0, 100)',
                        'rgb(255, 0, 100)',
                        'rgb(255, 30, 100)',
                        'rgb(255, 60, 100)',
                        'rgb(255, 90, 100)',
                        'rgb(100, 110, 100)',
                        'rgb(100, 140, 100)',
                        'rgb(100, 170, 100)',
                        'rgb(100, 200, 100)'
                    ]
                }]
            },
            options: {
                pieceLabel: {
                    render: 'label',
                    fontColor: '#fff'
                },
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.datasets[0].data[tooltipItem.index] || '';

                            return '<?php echo t('Pages owned by') ?> ' + data.labels[tooltipItem.index] + ': ' + label;
                        }
                    }
                }
            }
        });
    });
</script>
