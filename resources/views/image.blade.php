@extends('layouts.app')

@section('content')
<style>
    .section{
        font-size: 6em;
        text-align: center;
    }
    .item {
        position: absolute;
        width: 50px;
        height: 50px;
        background-color: black;
        left:0
    }
    .content {
        width: 400px;
        height: 400px;
        background-color: green;
        margin: auto;
    }
    .left {
        left:0px;
    }
    .right {
        right:0px;
    }
    .fixed_item {
        position: fixed;
        z-index:9;
    }
</style>

<div id="fullpage">
    <div class="section sec1">Section 1</div>
    <div class="section sec2">Section 2
        <!--div class="slide">Section 2 Slide 1</div>
        <div class="slide">Section 2 Slide 2</div>
        <div class="slide">Section 2 Slide 3</div-->

        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>

        <table class="content">
            <tr><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td></td><td></td><td></td></tr>
        </table>
    </div>
    <div class="section sec3">Section 3
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="content"></div>
    </div>
    <div class="section sec4">Section 4
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="content"></div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        var easing = ["linear", "swing", "jswing", "easeOutCubic", "easeInOutCirc", "easeInOutExpo"];
        var easingLength = easing.length;
        var down = true;


        function itemObject(itemTop, itemDuration, itemEasing) {
            this.itemTop = itemTop;
            this.itemDuration = itemDuration;
            this.itemEasing = itemEasing;
        }
        $('#fullpage').fullpage({

            sectionsColor: ['#f2f2f2', '#4BBFC3', '#7BAABE', 'maroon', 'whitesmoke'],
            anchors: ['section1', 'section2', 'section3', 'section4'],
            scrollBar: true,
            afterLoad: function (anchorLink, index) {
                var sec = anchorLink.substring(7);
                switch (sec) {
                    case "2":
                        if (down == true)
                            animateItems('sec2', 0);
                        break;
                    case "3":
                        if (down == true)
                            animateItems('sec3', 1);
                        break;
                    case "4":
                        if (down == true)
                            animateItems('sec4', 2);
                        break;
                }

            },
            onLeave: function (index, nextIndex, direction) {
                if (index < nextIndex) {
                    down = true;
                }
                if (index > nextIndex) {
                    down = false;
                    switch (index) {
                        case 2:
                            if (down == false)
                                animateBack('sec2', 0);
                            break;
                        case 3:
                            if (down == false)
                                animateBack('sec3', 1);
                            break;
                        case 4:
                            if (down == false)
                                animateBack('sec4', 2);
                            break;
                    }

                }
            }
        });
        offsetTop = 0;
        function animateItems(itemClass, droppedNumber) {
            itemArr = [];
            offsetLeft = 0;
            obj = $("." + itemClass + " .item").each(function () {
                var itemClassNumber = itemClass.substring(3);
                var sec = "sec" + itemClassNumber;
                var randomLeft = parseInt((Math.random() * 200) + 600);
                var randomTop = parseInt((Math.random() * 200) + 400);
                var randomOpacity = Math.random();
                var randomTime = parseInt((Math.random() * 2000) + 500);
                var randomEasing = parseInt(Math.random() * easingLength);
                itemArr.push(new itemObject($(this).css("top"), randomTime, easing[randomEasing]));
                //console.log($("." + itemClass + " table tr:nth-child(1) td").css("left"));
                $(this).animate({
                    opacity: randomOpacity,
                    left: 550 + offsetLeft,
                    top: 380 + offsetTop
                }, {
                    easing: easing[randomEasing],
                    duration: randomTime,
                    complete: function () {
                        dropped[droppedNumber] = true;
                        $(this).addClass("fixed_item");

                    }});
                offsetLeft = offsetLeft + 100;

            });
            offsetTop = offsetTop + 100;
            return itemArr;
        }
        function animateBack(itemClass, droppedNumber) {

            j = 0;
            $("." + itemClass + " .item").each(function () {
                var itemClassNumber = itemClass.substring(3);
                var sec = "sec" + itemClassNumber;
                var eas = (itemArr[j].itemEasing).toString();
                $(this).animate({
                    opacity: 1,
                    left: 0,
                    top: itemArr[j].itemTop
                }, {
                    easing: eas,
                    duration: itemArr[j].itemDuration,
                    complete: function () {
                        dropped[droppedNumber] = false;
                        $(this).removeClass("fixed_item");
                    }});
                j++;
            });
            offsetTop = offsetTop - 100;

        }
        $('#fullpage').fullpage.setAllowScrolling(true);
        var dropped = [false, false, false];
        var lenghtOfItems = $(".item").length;
        var left = 0;
        for (i = 0; i < lenghtOfItems - 1; i++) {
            $(".item").each(function (  ) {
                topCoordinate = parseInt(Math.random() * 800);
                //left = parseInt(Math.random() * 2);
                colorR = parseInt(Math.random() * 256);
                colorG = parseInt(Math.random() * 256);
                colorB = parseInt(Math.random() * 256);
                $(this).css("top", topCoordinate);
                $(this).css("background-color", 'rgb(' + colorR + ',' + colorG + ',' + colorB + ')');
            });
        }
    });
</script>
@endsection

