<template>
    <div class="col-xl-8 col-lg-7" style="">
        <loader-helper v-if="loading"></loader-helper>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    Ganhos Mensais
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="graficoGanhosMensais"></canvas>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "GraficoGanhos",
    data() {
        return {
            loading: false,
            ganhos: [],
        }
    },
    methods: {
        async renderChart() {
            let chart = document.getElementById('graficoGanhosMensais').getContext('2d');
            let ganhos = this.ganhos;
            let labels = [];
            let data = [];
            ganhos.forEach((item) => {
                labels.push(item.mes);
                data.push(item.total);
            });
            new Chart(chart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Ganhos',
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: data,

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true,
                    },
                    scales: {
                        //Adiciona R$ no eixo Y do gráfico
                        xAxes: [{
                            //Adiciona o nome do mês no eixo X do gráfico
                            ticks: {
                                callback: function (value, index, values) {
                                    return value;
                                }
                            },
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Mês'
                            },

                        }],
                        yAxes: [{
                            ticks: {
                                callback: function (value, index, values) {
                                    return 'R$ ' + value;
                                }
                            },
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Valor'
                            },
                        }]
                    }
                }
            });


        },
        getGanhosMensais() {
            this.loading = true; // Ativa o loader
            let self = this;
            axios.get('/dashboard/ganhos-mensais')
                .then(response => {
                    self.ganhos = response.data;
                    self.renderChart();
                })
                .catch(error => {
                    console.log(error);
                }).finally(() => {
                self.loading = false;
            });
        }
    },
    mounted() {
        this.getGanhosMensais();
    },
}
</script>

<style scoped>

</style>
