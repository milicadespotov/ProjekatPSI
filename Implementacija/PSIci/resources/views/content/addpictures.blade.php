
@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="row" style="font-size:25px;color:#8A2BE2">
            <div class="col-md-12">
                <br>
                <center>
                    <p>
                        Dodavanje slika
                    </p>
                </center>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-top:20px;">
           <div class="col-md-12">
               <form id="info-form" enctype= "multipart/form-data" method="post" action="{{ route('addpicturespost')}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                   <input type="hidden" name="id" value="{{$content->id}}">
                   @csrf
                   <fieldset>
                       <div class="col-md-1">
                           &nbsp;
                       </div>


                       <div class="col-md-10">
                           <div class="form-group ">
                               <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Dodaj sliku:</label><br>
                               <input type="file" style="margin-top:3px;" name="pictures[]" multiple class="form-control input-file" id="picture1">
                           </div>
                           <br>
                           <div class="form-group ">
                               <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Dodaj sliku:</label><br>
                               <input type="file" style="margin-top:3px;" name="pictures[]" multiple class="form-control input-file" id="picture2">
                           </div>
                           <br>
                           <div class="form-group ">
                               <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Dodaj sliku:</label><br>
                               <input type="file" style="margin-top:3px;" name="pictures[]" multiple class="form-control input-file" id="picture3">
                           </div>
                           <br>
                           <div class="form-group ">
                               <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Dodaj sliku:</label><br>
                               <input type="file" style="margin-top:3px;" name="pictures[]" multiple class="form-control input-file" id="picture4">
                           </div>
                           <br>
                           <div class="form-group ">
                               <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Dodaj sliku:</label><br>
                               <input type="file" style="margin-top:3px;" name="pictures[]" multiple class="form-control input-file" id="picture5">
                           </div>
                           <br>
                           <div class="form-group">

                               <center>
                                   <button type="submit" class="btn btn-transparent">Potvrdi</button>
                                   <a href="{{route('redirectback',['id' => $content->id])}}">
                                       <button type="button" class="btn btn-transparent" value="">Nazad</button>
                                   </a>
                               </center>

                           </div>
                       </div>
                       <div class="col-md-1">
                           &nbsp;
                       </div>
                   </fieldset>
               </form>
           </div>
        </div>
    </div>

@endsection