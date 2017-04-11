@extends('layouts/app')

@section('content')

<div class="container">
    <div class="row" >
        <div class="col-md-2" style="background-color: rgb(217, 217, 217);border-radius: 5px;padding: 30px;">
            <ul class="nav nav-pills nav-stacked">
                <?= Form::open(array('method' => 'get', 'url' => 'user/chart', 'class' => 'form-horizontal', 'role' => 'form')) ?>
                <?= csrf_field() ?>
                <li class="page-header"><h2>Search</h2></li>
                <div class="form-group<?= $errors->has('year') ? ' has-error' : '' ?>">
                    <li>
                        <?= Form::label('year', 'Year:') ?>
                        <?= Form::input('number', 'year', old('year'), ['class' => 'form-control']) ?>
                    </li>
                    <?php if ($errors->has('year')): ?>
                        <span class="help-block">
                            <strong><?= $errors->first('year') ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <li>
                        <?= Form::label('start_month', 'From:') ?>
                        <?= Form::select('start_month', ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], old('start_month'), ['class' => 'form-control', 'style' => 'margin-bottom:80px']) ?>
                    </li>
                </div>
                <div class="form-group">
                    <li>
                        <?= Form::label('end_month', 'To:') ?>
                        <?= Form::select('end_month', ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], old('end_month'), ['class' => 'form-control', 'style' => 'margin-bottom:80px']) ?>
                    </li>
                </div>
                <div class="form-group">
                    <li>
                        <?= Form::label('user', 'User:') ?>
                        <?= Form::select('user', $user, old('user'), ['class' => 'form-control', 'style' => 'margin-bottom:80px']) ?>
                    </li>
                </div>
                <div class="form-group">
                    <li class="text-center">
                        <?= Form::input('submit', 'search', 'search', ['class' => 'btn btn-warning', 'style' => 'width: 100px']) ?>
                    </li>
                </div>
                <?= Form::close() ?>
            </ul>
        </div>
        <div class="col-md-5 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Chart</h2>
                </div>
                <div class="panel-body">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection


@section('js')
<script>
    var arr = <?= $userArr ?>;
    var start =<?= $start ?>;
    var end =<?= $end ?>;
    var monthData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    for (i in arr) {
        for (var j = 1; j < 13; j++) {
            if (arr[i]["month"] == j) {
                index = j - 1;
                monthData[index] = arr[i]["total_values"];
            }
        }
    }
    var months = monthData.slice(start - 1, end);
    var labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var labelMonth = labels.slice(start - 1, end);
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelMonth,
            datasets: [{
                    label: '# Value',
                    data: months,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 64, 1)'

                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    });


</script>
@endsection