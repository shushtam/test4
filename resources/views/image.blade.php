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
    .div1, .div2, .div3, .div4, .div5, .div6, .div7, .div8{
        background-color:red;
        width:50px;
        height:50px;
        z-index:100;
    }
</style>

<div id="fullpage">
    <!--div class="section sec1"></div>
    <div class="section sec2">Section 2
    <!--div class="slide">Section 2 Slide 1</div>
    <div class="slide">Section 2 Slide 2</div>
    <div class="slide">Section 2 Slide 3</div-->

    <!--div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
    <div class="content"></div>
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
</div-->
    <div class="section sec0">Section</div>
    <div class="div1"></div>
    <div class="div2"></div>
    <div class="div3"></div>
    <div class="div4"></div>
    <div class="div5"></div>
    <div class="div6"></div>
    <div class="div7"></div>
    <div class="div8"></div>

</div>

@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function () {

        var items_data = [{
                item: $('.div1'),
                endPosition: '100px',
                color: 'red',
                func: function () {
                    console.log("div1 completed");
                }
            }, {
                item: $('.div2'),
                endPosition: '150px',
                color: 'yellow',
                func: function () {
                    console.log("div2 completed");
                }
            }, {
                item: $('.div3'),
                endPosition: '300px',
                color: 'blue',
                func: function () {
                    console.log("div3 completed");
                }
            }, {
                item: $('.div4'),
                endPosition: '400px',
                color: 'green',
                func: function () {
                    console.log("div4 completed");
                }
            }, {
                item: $('.div5'),
                endPosition: '500px',
                color: 'blue',
                func: function () {
                    console.log("div5 completed");
                }
            }, {
                item: $('.div6'),
                endPosition: '600px',
                color: 'maroon',
                func: function () {
                    console.log("div6 completed");
                }
            }, {
                item: $('.div7'),
                endPosition: '700px',
                color: 'white',
                func: function () {
                    console.log("div7 completed");
                }
            }, {
                item: $('.div8'),
                endPosition: '750px',
                func: function () {
                    console.log("div8 completed");
                }
            }];

        stepInput = 5;
        for (secStep = 1; secStep < stepInput; secStep++) {
            $("#fullpage").append("<div class='section sec" + secStep + "'></div>");
            /*for (it = 0; it < 4; it++) {
             $(".sec" + secStep).append("<div class='item'></div>");
             }*/
        }
        numb = 1;
        freq = 1;
        itemId = 0;
        for (x = 0; x < items_data.length; x++) {
            $value = items_data[x]["item"];
            valueColor = items_data[x]["color"];
            $(".sec" + numb).append($value);
            $(".sec" + numb).children().last().addClass("item id" + itemId);
            itemId++;
            if (items_data[x].hasOwnProperty("color")) {
                $(".sec" + numb).children().last().css('background-color', valueColor);
            } else {
                colorR = parseInt(Math.random() * 256);
                colorG = parseInt(Math.random() * 256);
                colorB = parseInt(Math.random() * 256);
                $(".sec" + numb).children().last().css('background-color', 'rgb(' + colorR + ',' + colorG + ',' + colorB + ')');
            }
            if (freq % 2 == 0) {
                numb++;
            }
            freq++;
        }


        //////////////////////////////////////animations/////////////////////////////////////////////
        var easing = ["linear", "swing", "jswing", "easeOutCubic", "easeInOutCirc", "easeInOutExpo"];
        var easingLength = easing.length;
        var down = true;
        function itemObject(itemId, itemTop, itemDuration, itemEasing) {
            this.itemId = itemId;
            this.itemTop = itemTop;
            this.itemDuration = itemDuration;
            this.itemEasing = itemEasing;
        }

        var secAnchors = [];
        var secColors = [];

        for (secId = 0; secId < stepInput; secId++) {
            secAnchors.push("section" + secId);
        }
        for (secId = 0; secId < stepInput; secId++) {
            colorRed = parseInt(Math.random() * 256);
            colorGreen = parseInt(Math.random() * 256);
            colorBlue = parseInt(Math.random() * 256);
            secColors.push('rgb(' + colorRed + ',' + colorGreen + ',' + colorBlue + ')');
        }
        var render = false;
        $('#fullpage').fullpage({

            sectionsColor: secColors,
            anchors: secAnchors,
            scrollBar: true,
            afterLoad: function (anchorLink, index) {
                var sec = anchorLink.substring(7);
                if (render == true) {
                    for (s = 1; s < +sec; s++) {
                        animateItems('sec' + s, s)
                    }
                    render = false;
                }
                if (render == false) {
                    if (down == true) {
                        animateItems('sec' + sec, sec)
                    }
                }
            },
            afterRender: function () {
                render = true;
            },
            onLeave: function (index, nextIndex, direction) {
                if (index < nextIndex) {
                    down = true;
                }
                if (index > nextIndex) {
                    down = false;
                    if (down == false) {
                        ind = index - 1;
                        animateBack('sec' + ind, ind);
                    }
                }
            }
        });
        var itemArr = [];
        function animateItems(itemClass, droppedNumber) {

            $("." + itemClass + " .item").each(function () {
                var idStr = ($(this).attr("class")).indexOf("id");
                var id = ($(this).attr("class")).substring(idStr + 2);
                var itemClassNumber = itemClass.substring(3);
                var sec = "sec" + itemClassNumber;
                var randomOpacity = Math.random();
                var randomTime = parseInt((Math.random() * 1000) + 500);
                var randomEasing = parseInt(Math.random() * easingLength);
                if (itemArr.length < items_data.length) {
                    itemArr.push(new itemObject(id, $(this).css("top"), randomTime, easing[randomEasing]));
                }
                $(this).addClass("fixed_item");
                $(this).animate({
                    opacity: 1, //randomOpacity,
                    left: items_data[id]['endPosition']
                            //top: items_data[id]['endPosition']
                }, {
                    easing: easing[randomEasing],
                    duration: randomTime,
                    complete: function () {
                        dropped[droppedNumber] = true;
                        items_data[id]['func']();

                    }});
                //  valueFunc();

            });
            // return itemArr;
        }
        var offsetTop = 180;

        moveLeft = ($(" .fp-tableCell").outerWidth()) / 2;
        moveTop = ($(" .fp-tableCell").outerHeight()) / 2;
        function animateBack(itemClass, droppedNumber) {
            $("." + itemClass + " .item").each(function () {
                var idStr = ($(this).attr("class")).indexOf("id");
                var idS = ($(this).attr("class")).substring(idStr + 2);
                var id = parseInt(idS)
                var itemClassNumber = itemClass.substring(3);
                var sec = "sec" + itemClassNumber;
                var eas = (itemArr[id].itemEasing).toString();
                $(this).animate({
                    opacity: 1,
                    left: 0,
                    top: itemArr[id].itemTop
                }, {
                    easing: eas,
                    duration: itemArr[id].itemDuration,
                    complete: function () {
                        dropped[droppedNumber] = false;
                        $(this).removeClass("fixed_item");
                    }});
            });
            offsetTop = offsetTop - 100;
        }
        $('#fullpage').fullpage.setAllowScrolling(true);
        var dropped = [false, false, false, false];
        var lenghtOfItems = $(".item").length;
        for (i = 0; i < lenghtOfItems - 1; i++) {
            $(".item").each(function (  ) {
                topCoordinate = parseInt(Math.random() * 700) + 50;
                colorR = parseInt(Math.random() * 256);
                colorG = parseInt(Math.random() * 256);
                colorB = parseInt(Math.random() * 256);
                $(this).css("top", topCoordinate);
                //$(this).css("background-color", 'rgb(' + colorR + ',' + colorG + ',' + colorB + ')');
            });
        }
    });
</script>
@endsection

