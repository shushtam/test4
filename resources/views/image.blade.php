@extends('layouts.app')

@section('content')
<style>
    .section{
        font-size: 6em;
        text-align: center;
    }
    .item {
        position: absolute;
        left:0;
        width: 50px;
        height: 50px;
        background-color: black;
        margin-bottom: 10px;
    }
    .content {
        width: 600px;
        height: 600px;
        background-color: green;
        margin: auto;
    }
</style>

<div id="fullpage">
    <div class="section">Section 1</div>
    <div class="section">Section 2
        <!--div class="slide">Section 2 Slide 1</div>
        <div class="slide">Section 2 Slide 2</div>
        <div class="slide">Section 2 Slide 3</div-->

        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>

        <div class="content"></div>
    </div>
    <div class="section">Section 3</div>
    <div class="section">Section 4</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.4/jquery.fullpage.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.4/jquery.fullpage.min.js"></script>
<script>
    $('#fullpage').fullpage({
        sectionsColor: ['#f2f2f2', '#4BBFC3', '#7BAABE', 'maroon', 'whitesmoke'],
        anchors: ['section1', 'section2', 'section3', 'section4'],
        afterLoad: function (anchorLink, index) {
            if (anchorLink == 'section2' && dropped==false) {
                $(".item").each(function (  ) {
                    console.log(this);
            setInterval.apply(this,[c,1000]);
        });
                 
            }
        }
    });
    var dropped=false;
    var lenghtOfItems = $(".item").length;
    for (i = 0; i < lenghtOfItems-1; i++) {
        $(".item").each(function (  ) {
            topCoordinate = parseInt(Math.random() * 400);
            $(this).css("top", topCoordinate);
        });
    }
    function c()
    {
            while($(this).css("left") < '450px' || $(this).css("top") < '350px') {
        $(this).css("left", "+=10");
        $(this).css("top", "+=10");
    }
    }
        /*if ($(".item").css("left") == '450px' || $(".item").css("top") == '350px')
        {
            dropped=true;
            clearInterval(t);

    }*/
    //console.log($(".item").css("width"));




</script>

@endsection

