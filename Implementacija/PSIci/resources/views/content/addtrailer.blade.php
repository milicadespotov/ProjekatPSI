@extends('layouts.master')


@section('content')
    <div class="backgroundLogin">
        <br>
        <br>
        <div class="container-fluid">
            <div class="row" style="font-size:18px;color:#8A2BE2">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$content->trailer}}" style="width:100%;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="col-md-3">&nbsp;</div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="row" style="font-size:22px;color:#8A2BE2">
                <div class="col-md-12">
                <form id="info-form" enctype= "multipart/form-data" method="post" action="{{ route('addtrailerpost',['id'=>$content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                    @csrf
                    <fieldset>
                        <div class="col-md-2">
                            &nbsp;
                        </div>


                        <div class="col-md-8">
                            <div class="form-group ">
                                <input type="hidden" name="id" value="{{$content->id}}">
                               <center> <label class="control-label" for="trailer" >Youtube link do novog trejlera:</label></center>

                                <input id="trailer" name="trailer" placeholder="Unesite link" class="form-control input-md" type="text" >
                                <center><div style="color:deeppink">  {{ $errors->first('trailer') }}</div></center>
                            </div>
                            <br>


                            <div class="form-group">

                                <center>
                                    <button type="submit" class="btn btn-transparent">Potvrdi</button>
                                </center>

                            </div>
                        </div>
                        <div class="col-md-2">
                            &nbsp;
                        </div>
                    </fieldset>
                </form>
                </div>
            </div>


        </div>


        <br>
        <br>
    </div>
@endsection