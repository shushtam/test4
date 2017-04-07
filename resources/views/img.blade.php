@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <?= Form::open(array('url' => '/img', 'class' => 'form-horizontal', 'role' => 'form')) ?>
            <?= csrf_field() ?>
            <?= Form::label('step', 'Step', ['class' => 'col-md-4 control-label']) ?>
            <?= Form::input('step', 'step', 4, ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) ?>
            <?= Form::input('submit', 'start', 'Start', ['class' => 'btn btn-primary']) ?>
            <?= Form::close() ?>
        </div>
        <div class="dv"></div>
    </div>
</div>
@endsection


@section('js')
<script>
    $(document).ready(function () {
 

        $.ajax({
            type: 'GET',
            url: "/img",
            data: {ex: "2"},
            dataType: "text",
            success: function (response) {
                alert("xx");
               
            }
        });

    });
</script>

@endsection
