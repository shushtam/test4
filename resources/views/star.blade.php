@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <figure  style="text-align:center;"> 
                <canvas id="star_canvas" width="800" height="400" style="border-top:1px solid black;border-bottom:1px solid black;">

                </canvas>
                <figcaption style="margin-left:30px;">Star</figcaption>
            </figure>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection

@section('star_js')

<script>
    var starCanvas = document.getElementById("star_canvas");
    var star = starCanvas.getContext("2d");
    function drawStar(star, cx, cy, spikes, r0, r1) {
        var rot = Math.PI / 2 * 3, x = cx, y = cy, step = Math.PI / spikes

        star.strokeSyle = "#000";
        star.beginPath();
        star.moveTo(cx, cy - r0)
        for (i = 0; i < spikes; i++) {
            x = cx + Math.cos(rot) * r0;
            y = cy + Math.sin(rot) * r0;
            sin.lineTo(x, y)
            rot += step

            x = cx + Math.cos(rot) * r1;
            y = cy + Math.sin(rot) * r1;
            star.lineTo(x, y)
            rot += step
        }
        star.lineTo(cx, cy - r0)
        star.stroke();
        star.closePath();
    }
</script>
@endsection