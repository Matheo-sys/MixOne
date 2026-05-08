/**
 * Logique du tableau de bord Studio
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('studioLineChart');
        if (!ctx) return;

        // Récupération des données du graphique via l'attribut data-chart du canvas
        const chartDataRaw = JSON.parse(ctx.getAttribute('data-chart') || '{}');
        const labels = Object.keys(chartDataRaw);
        const data = Object.values(chartDataRaw);

        // Valeurs par défaut si aucune donnée n'est disponible
        const finalLabels = labels.length ? labels : ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'];
        const finalData = data.length ? data : [0, 0, 0, 0, 0, 0];

        // Initialisation du graphique Chart.js
        if (typeof Chart !== 'undefined') {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: finalLabels,
                    datasets: [{
                        label: 'Gains (€)',
                        data: finalData,
                        borderColor: '#1E2ED6',
                        backgroundColor: 'rgba(30, 46, 214, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#e5e5e5', borderDash: [5, 5] }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }
    });
})();
