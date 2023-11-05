<?php 
include 'api.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Wheel</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<style>
    /*! easyWheel v1.2 | http://22codes.com/ | Released under Codecanyon Standard license : https://codecanyon.net/licenses/standard  */

    .eWheel-wrapper,
    .easyWheel {
        position: relative
    }

    .easyWheel {
        max-width: 100%;
        margin: 4em auto 1em;
        font-size: 25px;
        font-weight: 700
    }

    .easyWheel,
    .easyWheel * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none
    }

    .easyWheel .eWheel-inner {
        display: block;
        overflow: hidden;
        width: 100%;
        height: 100%;
        position: relative
    }

    .easyWheel .eWheel {
        border-radius: 100%;
        overflow: hidden
    }

    .easyWheel .eWheel,
    .easyWheel .eWheel>.eWheel-bg-layer,
    .easyWheel .eWheel>.eWheel-txt-wrap,
    .easyWheel .eWheel>.eWheel-txt-wrap>.eWheel-txt {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%
    }

    .easyWheel .eWheel>.eWheel-bg-layer,
    .easyWheel .eWheel>.eWheel-txt-wrap>.eWheel-txt {
        margin: 0 auto;
        border-radius: 100%;
        padding: 0;
        list-style: none;
        overflow: hidden;
        color: #ecf0f1
    }

    .easyWheel .eWheel>.eWheel-bg-layer,
    .easyWheel .eWheel>.eWheel-txt-wrap {
        transform: rotate(-90deg)
    }

    .easyWheel .eWheel .eWheel-child .eWheel-inside {
        display: table;
        transform: rotate(0) skew(-45deg);
        width: 50%;
        height: 50%;
        transform-origin: 0 0;
        text-align: right;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        overflow: hidden
    }

    .easyWheel .eWheel .eWheel-child .eWheel-inside>div {
        display: table-cell;
        vertical-align: middle;
        width: 100%;
        height: 100%;
        transform: rotate(25deg);
        transform-origin: 115% 25%;
        padding-right: 40px;
        font-size: 18px;
        font-weight: 700
    }

    .easyWheel .eWheel>.eWheel-bg-layer>div {
        overflow: hidden;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        -webkit-transform-origin: 0 0;
        -moz-transform-origin: 0 0;
        -ms-transform-origin: 0 0;
        -o-transform-origin: 0 0;
        transform-origin: 0 0;
        border: 1px solid transparent;
        background-color: #404040
    }

    .easyWheel .eWheel>.eWheel-bg-layer>div:nth-child(odd) {
        background-color: #616161
    }

    .easyWheel .eWheel>.eWheel-txt-wrap>.eWheel-txt>div {
        position: absolute;
        top: 50%;
        left: 50%;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        line-height: 1.2em;
        max-height: 23.4em;
        -webkit-transform-origin: 0 0;
        -moz-transform-origin: 0 0;
        -ms-transform-origin: 0 0;
        -o-transform-origin: 0 0;
        transform-origin: 0 1px;
        width: 50%;
        padding-right: 6%;
        font-weight: 700;
        font-size: 100%;
        cursor: default;
        color: #fff;
        text-align: right
    }

    .easyWheel .eWheel-center {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        text-align: center
    }

    .easyWheel .eWheel-center>.ew-center-empty,
    .easyWheel .eWheel-center>.ew-center-html {
        max-width: 100%;
        position: relative;
        top: 50%;
        left: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
        z-index: 2
    }

    .easyWheel .eWheel-center>.ew-center-empty {
        position: absolute
    }

    .easyWheel .eWheel-center>img {
        max-width: 100%;
        width: 200px;
        position: relative;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%)
    }

    .easyWheel .eWheel-center>div {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 0 0 !important
    }

    .easyWheel .eWheel-marker {
        border-spacing: 90px;
        width: 16%;
        height: 16%;
        position: absolute;
        left: 50%;
        top: -18%;
        margin-top: 7%;
        margin-left: -8%;
        transition: .2 rotate linear;
        z-index: 3;
        display: block;
        transform: rotate(0);
        transform-origin: 50% 35%
    }

    .easyWheel .eWheel-marker>svg {
        height: 100%;
        display: block;
        text-align: center;
        margin: 0 auto
    }

    .easyWheel .rotate {
        transform: rotate(100deg)
    }

    .eWheel>.eWheel-bg-layer>svg {
        margin: 0 auto;
        border-radius: 50%;
        display: block;
        width: 100%;
        height: 100%;
        transform: rotate(0)
    }

    .eWheel>.eWheel-txt-wrap>.eWheel-txt>div.ew-ccurrent {
        color: #CFD8DC
    }

    img.show-spin {
        width: 120%;
        transform: rotate(-272deg) translate(3px, -50%);
        max-width: 227px !important;
        height: auto !important;
    }


</style>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="wheel.js"></script>
<div class="card">
    <div class="card-header bg-dark text-white"><i class="fa fa-gamepad fa-lg"></i> สุ่มวงล้อ</div>
    <div class="card-body">
        
        <div class="row">
            <div class="col-12">
                <div class="spinners"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="mt-2 btn btn-danger btn-block spin-button"><i class="fa fa-gamepad"></i>&nbsp;สุ่มวงล้อ (  <?= $wheel['bet'] ?> Point )</button>
            </div>
        </div>
    <h3></h3>
</div>
</div>


<script>
var items = [
<?php 


$items = [
    ['id'=>"0",'image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
    ['id'=>"1",'image'=>$wheel['item'][1]['image'],'name'=>$wheel['item'][1]['name']],
    ['id'=>"2",'image'=>$wheel['item'][2]['image'],'name'=>$wheel['item'][2]['name']],
    ['id'=>"3",'image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
    ['id'=>"4",'image'=>$wheel['item'][4]['image'],'name'=>$wheel['item'][4]['name']],
    ['id'=>"5",'image'=>$wheel['item'][5]['image'],'name'=>$wheel['item'][5]['name']],
];

foreach($items as $key => $value){
    ?>
    {
        name: "<img src='<?= $value['image'] ?>' class='show-spin'></img>",
        color: "#ed616f",
        message: "คุณได้รับ <?= $value['name'] ?>",
        id: "<?= $key ?>"
    },
    <?php
}
?>
];
var markercolor = "#ab1b2a";
var centerlinecolor = "#dc3545";
var slicelinecolor = "#dc3545";
var outerlinecolor = "#dc3545";


jQuery(document).ready(function() {
tick = new Audio('css/tick.mp3');
var lose = false;
$('.spinners').easyWheel({
    items: items,
    duration: 8000,
    rotates: 8,
    frame: 1,
    easing: "easyWheel",
    rotateCenter: true,
    type: "spin",
    markerAnimation: true,
    centerClass: 0,
    width: 500,
    fontSize: 13,
    textOffset: 10,
    letterSpacing: 0,
    textLine: "v",
    textArc: false,
    shadowOpacity: 0,
    sliceLineWidth: 1,
    outerLineWidth: 5,
    centerWidth: 40,
    centerLineWidth: 3,
    centerImageWidth: 25,
    textColor: "#fff",
    markerColor: markercolor,
    centerLineColor: centerlinecolor,
    centerBackground: "transparent",
    centerImage: '<?= $wheel['center'] ?>',
    centerWidth: 30,
    centerImageWidth: 20,
    sliceLineColor: slicelinecolor,
    outerLineColor: outerlinecolor,
    shadow: "#000",
    selectedSliceColor: "rgb(66, 66, 66)",
    button: '.spin-button',
    frame: 1,
    ajax: {
        url: '',
        type: 'POST',
        nonce: true,
        success: function(msg) {
            if(msg.lose == true){
                lose = true;
            }else{
                lose = false;
            }
        },
        error: function(msg) {
            res = msg.responseJSON;
            alert(res.message)
        }
    },
    onStart: function(results, spinCount, now) {},
    onStep: function(results, slicePercent, circlePercent) {
        if (typeof tick.currentTime !== 'undefined')
            tick.currentTime = 0;
        tick.play();
    },
    onProgress: function(results, spinCount, now) {
        $(".spin-button").attr("disabled", true);
        $(".spin-button").html("รอสักครู่...");
    },
    onComplete: function(results, count, now) {
        $(".spin-button").attr("disabled", false);
        $(".spin-button").html('<i class="fa fa-gamepad"></i>&nbsp;สุ่มวงล้อ (  <?= $wheel['bet'] ?> Point )');
        if(lose == true){
            Swal.fire({
                title: 'แย่จัง',
                icon: 'error',
                html:
                '<u class="text-danger">คุณไม่ได้รับรางวัล</u>',
                confirmButtonText:'ตกลง',
                confirmButtonColor:'#dc3545',
            })
        }else{
            console.log(results);
            Swal.fire({
                title: 'ยินดีด้วย',
                icon: 'success',
                html:
                '<u class="text-success">คุณได้รับ '+results.message+'</u>',
                confirmButtonText:'ตกลง',
                confirmButtonColor:'#dc3545',
            })
        }


    },
    onFail: function(results, spinCount, now) {
        Swal.fire({
            title: 'ผิดพลาด',
            icon: 'error',
            html:
            '<u class="text-danger">เครดิตไม่เพียงพอ</u>',
            confirmButtonText:'ตกลง',
            confirmButtonColor:'#dc3545',
        })
    },

});
});

</script>

</body>
</html>
