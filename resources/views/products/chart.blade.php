@extends('layout')
@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
@endsection

@section('content')
    <!-- Views chart -->
    <canvas id="chart" width="1000" height="600"></canvas>
    <script>
        let views = ({!! json_encode($views, true) !!});
        let times = [];
        let viewCount = [];
        let startDateTs = Date.now() - 3600000;
        let endDateTs = Date.now();

        for (let i = 0; i < views.length; i++) {
            let date = new Date(views[i][0]);
            let ts = date.getTime();

            while (startDateTs < ts) {
                let startDate = new Date(startDateTs);
                times.push(startDate.getHours() + ':' + (startDate.getMinutes() < 10 ? '0' : '') + startDate.getMinutes());
                viewCount.push(0);

                startDateTs += 60000;
            }

            times.push(date.getHours() + ':' + (date.getMinutes() < 10 ? '0' : '') + date.getMinutes());
            viewCount.push(views[i][1]);
            startDateTs += 60000;
        }

        while (startDateTs < endDateTs) {
            let startDate = new Date(startDateTs);
            times.push(startDate.getHours() + ':' + (startDate.getMinutes() < 10 ? '0' : '') + startDate.getMinutes());
            viewCount.push(0);

            startDateTs += 60000;
        }

        let ctx = document.getElementById('chart');
        let myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: times,
                datasets: [{
                    label: 'views',
                    data: viewCount,
                    backgroundColor: ['transparent'],
                    borderColor: [
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 3,
                    pointRadius: 5,
                    pointBorderColor: 'rgba(54, 162, 235, 1)',
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Views of all products in the last hour'
                },
                legend: {
                    display: false
                }
            }
        });
    </script>
@endsection
