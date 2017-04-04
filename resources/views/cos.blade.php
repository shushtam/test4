@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <figure  style="text-align:center;"> 
                <canvas id="cos_canvas" width="800" height="400" style="border-top:1px solid black;border-bottom:1px solid black;">

                </canvas>
                <figcaption style="margin-left:30px;">Cos function</figcaption>
            </figure>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection

@section('cos_js')

<script>
    var cosCanvas = document.getElementById("cos_canvas");
    var cos = cosCanvas.getContext("2d");
    var minX = 0;
    var minY = 0;
    var maxX = 800;
    var maxY = 400;
    //x-axis
    cos.moveTo(maxX / 2, minY);
    cos.lineTo(maxX / 2, maxY);
    //y-axis
    cos.moveTo(minX, maxY / 2);
    cos.lineTo(maxX, maxY / 2);
    //
    cos.strokeStyle = '#000000';
    cos.stroke();
    cos.beginPath();
    var angle = 0;
    for (x = -31; x < maxX; x += 3) {
        y = 50 * Math.cos(angle * 3.141 / 180);
        y = maxY / 2 - y;
        cos.lineTo(x, y);
        cos.moveTo(x, y);
        angle += 5;
    }
    cos.strokeStyle = '#ff0000';
    cos.stroke();
</script>
@endsection