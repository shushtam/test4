@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <figure  style="text-align:center;"> 
                <canvas id="sin_canvas" width="800" height="400" style="border-top:1px solid black;border-bottom:1px solid black;">

                </canvas>
                <figcaption style="margin-left:30px;">Sin function</figcaption>
            </figure>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection

@section('sin_js')

<script>
    var sinCanvas = document.getElementById("sin_canvas");
    var sin = sinCanvas.getContext("2d");
    var minX = 0;
    var minY = 0;
    var maxX = 800;
    var maxY = 400;
    //x-axis
    sin.moveTo(maxX / 2, minY);
    sin.lineTo(maxX / 2, maxY);
    //y-axis
    sin.moveTo(minX, maxY / 2);
    sin.lineTo(maxX, maxY / 2);
    //
    sin.strokeStyle = '#000000';
    sin.stroke();
    sin.beginPath();
    var angle = 0;
//    x = 0 - maxX / 2;
    var y = 200;
    var x = 0;
    for (x = 0; x < maxX; x += 3) {
        y = 200 * Math.sin(angle / 180)+200;
//        y = maxY / 2 - y;
        sin.lineTo(x, y);
        sin.moveTo(x, y);
        angle += 5;
    }
    sin.strokeStyle = '#ff0000';
    sin.stroke();
</script>
@endsection