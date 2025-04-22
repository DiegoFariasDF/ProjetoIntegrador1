<?php
$totalEmprestimos = $dados['totalEmprestimos'] ?? 0;
$totalAtrasos = $dados['totalAtrasos'] ?? 0;
$totalEmprestimosRegular = $dados['totalEmprestimosRegular'] ?? 0;
$emprestimosVencidos = $dados['emprestimosVencidos'] ?? 0;

$categorias = ['Regulares', 'Atrasados'];
$valores = [$totalEmprestimosRegular, $totalAtrasos];
?>

<canvas id="graficoBarras"></canvas>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('graficoBarras').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($categorias) ?>,
        datasets: [{
            label: 'Empréstimos',
            data: <?= json_encode($valores) ?>,
            backgroundColor: [
                'rgba(75, 192, 192, 0.7)',   //Regulares
                'rgba(255, 99, 132, 0.7)'    //Atrasados
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Empréstimos Ativos - <?= date("m/Y") ?>'
            },
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Quantidade'
                }
            }
        }
    }
});
</script>
