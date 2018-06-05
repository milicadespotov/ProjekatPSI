<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<style>
    .checked {
        color: orange;
    }
</style>
<script>
    $(document).ready(function(){
        var startRate =
        <?php
            if ($content->currentRate()==null) echo 0;
            else echo $content->currentRate()->rate;
        ?>;
        if (startRate==0) {
            for (i=1;i<=10;i++)
                $("#"+i).removeClass("checked");
        } else {
            for (i=1;i<=startRate;i++)
                $("#"+i).addClass("checked");
            for (i=startRate+1;i<=10;i++)
                $("#"+i).removeClass("checked");
        }

        $("#1").mouseenter(function(){
            var num=1;
            for (i=1;i<=num;i++) {
                $("#"+i).addClass("checked");
            }
            for (i=num+1;i<=10;i++) {
                $("#"+i).removeClass("checked");
            }
        });
        $("#2").mouseenter(function(){
            var num=2;
            for (i=1;i<=num;i++) {
                $("#"+i).addClass("checked");
            }
            for (i=num+1;i<=10;i++) {
                $("#"+i).removeClass("checked");
            }
        });
        $("#3").mouseenter(function(){
            var num=3;
            for (i=1;i<=num;i++) {
                $("#"+i).addClass("checked");
            }
            for (i=num+1;i<=10;i++) {
                $("#"+i).removeClass("checked");
            }
        });
        $("#4").mouseenter(function(){
            var num=4;
            for (i=1;i<=num;i++) {
                $("#"+i).addClass("checked");
            }
            for (i=num+1;i<=10;i++) {
                $("#"+i).removeClass("checked");
            }
        });
        $("#5").mouseenter(function(){
            var num=5;
            for (i=1;i<=num;i++) {
                $("#"+i).addClass("checked");
            }
            for (i=num+1;i<=10;i++) {
                $("#"+i).removeClass("checked");
            }
        });
        $("#6").mouseenter(function(){
            var num=6;
            for (i=1;i<=num;i++) {
                $("#"+i).addClass("checked");
            }
            for (i=num+1;i<=10;i++) {
                $("#"+i).removeClass("checked");
            }
        });
        $("#7").mouseenter(function(){
            var num=7;
            for (i=1;i<=num;i++) {
                $("#"+i).addClass("checked");
            }
            for (i=num+1;i<=10;i++) {
                $("#"+i).removeClass("checked");
            }
        });
        $("#8").mouseenter(function(){
            var num=8;
            for (i=1;i<=num;i++) {
                $("#"+i).addClass("checked");
            }
            for (i=num+1;i<=10;i++) {
                $("#"+i).removeClass("checked");
            }
        });
        $("#9").mouseenter(function(){
            var num=9;
            for (i=1;i<=num;i++) {
                $("#"+i).addClass("checked");
            }
            for (i=num+1;i<=10;i++) {
                $("#"+i).removeClass("checked");
            }
        });
        $("#10").mouseenter(function(){
            var num=10;
            for (i=1;i<=num;i++) {
                $("#"+i).addClass("checked");
            }
            for (i=num+1;i<=10;i++) {
                $("#"+i).removeClass("checked");
            }
        });
        $("#2").mouseenter(function(){
            $("#1").addClass("checked");
        });
        $("#1").mouseenter(function(){
            $("#1").addClass("checked");
        });
        $("#1").mouseenter(function(){
            $("#1").addClass("checked");
        });
        $("#1").click(function() {
            document.getElementById("rating-num").value="1";
            startRate=1;
            document.getElementById("rateForm").submit();
        });
        $("#2").click(function() {
            document.getElementById("rating-num").value="2";
            startRate=2;
            document.getElementById("rateForm").submit();
        });
        $("#3").click(function() {
            document.getElementById("rating-num").value=3;
            startRate=3;
            document.getElementById("rateForm").submit();
        });
        $("#4").click(function() {
            document.getElementById("rating-num").value=4;
            startRate=4;
            document.getElementById("rateForm").submit();
        });
        $("#5").click(function() {
            document.getElementById("rating-num").value=5;
            startRate=5;
            document.getElementById("rateForm").submit();
        });
        $("#6").click(function() {
            document.getElementById("rating-num").value=6;
            startRate=6;
            document.getElementById("rateForm").submit();
        });
        $("#7").click(function() {
            document.getElementById("rating-num").value=7;
            startRate=7;
            document.getElementById("rateForm").submit();
        });
        $("#8").click(function() {
            document.getElementById("rating-num").value=8;
            startRate=8;
            document.getElementById("rateForm").submit();
        });
        $("#9").click(function() {
            document.getElementById("rating-num").value=9;
            startRate=9;
            document.getElementById("rateForm").submit();
        });
        $("#10").click(function() {
            document.getElementById("rating-num").value=10;
            startRate=10;
            document.getElementById("rateForm").submit();
        });
        $("#stars_data").mouseleave(function(){
            if (startRate==0) {
                for (i=1;i<=10;i++)
                    $("#"+i).removeClass("checked");
            } else {
                for (i=1;i<=startRate;i++)
                    $("#"+i).addClass("checked");
                for (i=startRate+1;i<=10;i++)
                    $("#"+i).removeClass("checked");
            }
        });
    });
</script>
&nbsp; <table>
    <tr><td rowspan="2"><img src="{{ asset('img/star_rating.png') }}" style="width:30px;margin-bottom:5px"></td>
    <td><center>{{$content->rating}}/10 </center></td>
    </tr> &nbsp;
    <tr>
    <td><center>Broj glasova: {{$content->number_of_rates}}</center></td></tr>
</table>
@if (Auth::check())

<?php
$route = null;
if($type=='series')
    $route = 'rateseries';
else if($type=='season')
    $route = 'rateseason';
else
    $route = 'rateepisode'
?>

<form action="{{route($route,['content'=>$content->id])}}" method="post" id="rateForm">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @csrf
    <div id="stars_data">
        <li class="fa fa-star" id="1"></li>&nbsp;
        <li class="fa fa-star" id="2"></li>&nbsp;
        <li class="fa fa-star" id="3"></li>&nbsp;
        <li class="fa fa-star" id="4"></li>&nbsp;
        <li class="fa fa-star" id="5"></li>&nbsp;
        <li class="fa fa-star" id="6"></li>&nbsp;
        <li class="fa fa-star" id="7"></li>&nbsp;
        <li class="fa fa-star" id="8"></li>&nbsp;
        <li class="fa fa-star" id="9"></li>&nbsp;
        <li class="fa fa-star" id="10"></li>&nbsp;
    </div>
    <input type="text" id="rating-num" name="ratedNum" hidden>
    <input type="submit" id="submit-button" hidden>
</form>
@endif