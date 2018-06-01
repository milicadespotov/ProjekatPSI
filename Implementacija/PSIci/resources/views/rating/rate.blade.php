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
                @if ($content->currentRate==null) {{0}};
        @else {{$content->currentRate}}
        @endif;

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
            document.getElementById("rating-num").innerHTML=1;
            document.getElementById("rateForm").submit();
        });
        $("#2").click(function() {
            document.getElementById("rating-num").innerHTML=1;
            document.getElementById("rateForm").submit();
        });
        $("#3").click(function() {
            document.getElementById("rating-num").innerHTML=1;
            document.getElementById("rateForm").submit();
        });
        $("#4").click(function() {
            document.getElementById("rating-num").innerHTML=1;
            document.getElementById("rateForm").submit();
        });
        $("#5").click(function() {
            document.getElementById("rating-num").innerHTML=1;
            document.getElementById("rateForm").submit();
        });
        $("#6").click(function() {
            document.getElementById("rating-num").innerHTML=1;
            document.getElementById("rateForm").submit();
        });
        $("#7").click(function() {
            document.getElementById("rating-num").innerHTML=1;
            document.getElementById("rateForm").submit();
        });
        $("#8").click(function() {
            document.getElementById("rating-num").innerHTML=1;
            document.getElementById("rateForm").submit();
        });
        $("#9").click(function() {
            document.getElementById("rating-num").innerHTML=1;
            document.getElementById("rateForm").submit();
        });
        $("#10").click(function() {
            document.getElementById("rating-num").innerHTML=1;
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
Broj glasova:&nbsp;{{$content->number_of_rates}}&nbsp;Prosecna ocena:{{$content->rating}} Ocenite:
@if (Auth::check())
<form action="{{$type}}/{{$content->id}}/rate" method="post" id="rateForm">
    {{ csrf_field() }}
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