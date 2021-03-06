<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<style>
    .checked {
        color: orange;
    }
</style>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var route = <?php echo '\''.route('ratings').'\''?>;
        var contentId = <?php echo $content->id?>;
        var startRate =
            <?php
            if (Auth::user()) {
                if ($content->currentRate()==null) echo 0;
                else echo $content->currentRate()->rate;
            } else echo 0;
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
        $("#1").click(function() {
            document.getElementById("rating-num").value="1";
            startRate=1;
            $.ajax({
                type:'GET',
                url:route,
                data:{
                    id: contentId,
                    ratedNum: 1},
                success:function(data){
                    document.getElementById("setData").innerHTML = data.rating+"/10";
                    document.getElementById("numData").innerHTML = "Broj glasova: "+data.num;
                }
            });
        });
        $("#2").click(function() {
            document.getElementById("rating-num").value="2";
            startRate=2;
            $.ajax({
                type:'GET',
                url:route,
                data:{
                    id: contentId,
                    ratedNum: 2},
                success:function(data){
                    document.getElementById("setData").innerHTML = data.rating+"/10";
                    document.getElementById("numData").innerHTML = "Broj glasova: "+data.num;
                }
            });
        });
        $("#3").click(function() {
            document.getElementById("rating-num").value=3;
            startRate=3;
            $.ajax({
                type:'GET',
                url:route,
                data:{
                    id: contentId,
                    ratedNum: 3},
                success:function(data){
                    document.getElementById("setData").innerHTML = data.rating+"/10";
                    document.getElementById("numData").innerHTML = "Broj glasova: "+data.num;
                }
            });
        });
        $("#4").click(function() {
            document.getElementById("rating-num").value=4;
            startRate=4;
            $.ajax({
                type:'GET',
                url:route,
                data:{
                    id: contentId,
                    ratedNum: 4},
                success:function(data){
                    document.getElementById("setData").innerHTML = data.rating+"/10";
                    document.getElementById("numData").innerHTML = "Broj glasova: "+data.num;
                }
            });
        });
        $("#5").click(function() {
            document.getElementById("rating-num").value=5;
            startRate=5;
            $.ajax({
                type:'GET',
                url:route,
                data:{
                    id: contentId,
                    ratedNum: 5},
                success:function(data){
                    document.getElementById("setData").innerHTML = data.rating+"/10";
                    document.getElementById("numData").innerHTML = "Broj glasova: "+data.num;
                }
            });
        });
        $("#6").click(function() {
            document.getElementById("rating-num").value=6;
            startRate=6;
            $.ajax({
                type:'GET',
                url:route,
                data:{
                    id: contentId,
                    ratedNum: 6},
                success:function(data){
                    document.getElementById("setData").innerHTML = data.rating+"/10";
                    document.getElementById("numData").innerHTML = "Broj glasova: "+data.num;
                }
            });
        });
        $("#7").click(function() {
            document.getElementById("rating-num").value=7;
            startRate=7;
            $.ajax({
                type:'GET',
                url:route,
                data:{
                    id: contentId,
                    ratedNum: 7},
                success:function(data){
                    document.getElementById("setData").innerHTML = data.rating+"/10";
                    document.getElementById("numData").innerHTML = "Broj glasova: "+data.num;
                }
            });
        });
        $("#8").click(function() {
            document.getElementById("rating-num").value=8;
            startRate=8;
            $.ajax({
                type:'GET',
                url:route,
                data:{
                    id: contentId,
                    ratedNum: 8},
                success:function(data){
                    document.getElementById("setData").innerHTML = data.rating+"/10";
                    document.getElementById("numData").innerHTML = "Broj glasova: "+data.num;
                }
            });
        });
        $("#9").click(function() {
            document.getElementById("rating-num").value=9;
            startRate=9;
            $.ajax({
                type:'GET',
                url:route,
                data:{
                    id: contentId,
                    ratedNum: 9},
                success:function(data){
                    document.getElementById("setData").innerHTML = data.rating+"/10";
                    document.getElementById("numData").innerHTML = "Broj glasova: "+data.num;
                }
            });
        });
        $("#10").click(function() {
            document.getElementById("rating-num").value=10;
            startRate=10;
            $.ajax({
                type:'GET',
                url:route,
                data:{
                    id: contentId,
                    ratedNum: 10},
                success:function(data){
                    document.getElementById("setData").innerHTML = data.rating.toFixed(2)+"/10";
                    document.getElementById("numData").innerHTML = "Broj glasova: "+data.num;
                }
            });
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
        <td><center><div id="setData">{{round($content->rating, 2)}}/10</div> </center></td>
    </tr> &nbsp;
    <tr>
        <td><center><div id="numData">Broj glasova: {{$content->numberOfRates()}}</div></center></td></tr>
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