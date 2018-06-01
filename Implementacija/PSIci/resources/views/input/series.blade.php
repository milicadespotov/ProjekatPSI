@extends('layouts.master')

@section('content')
    <div class="container">
        <form method="POST" enctype="multipart/form-data" action="{{ route('confirmSeries') }}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @csrf
        <div class="row justify-content-center">
            <div class="col-lg-6">
                        <div class="form-group">
                            <label for="main_picture" style = "font-size: 18px" class="col-form-label text-md-right color">Naslovna slika:</label><br>
                            <input type="file" name="mainImage" class="form-control" id="mainImage">
                        </div>
                        <div class="form-group">
                            <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Ostale slike:</label><br>
                            <input type="file" name="pictures[]" multiple class="form-control" id="pictures">
                        </div>
                        <div class="form-group">
                            <label for="trailer" style="font-size:18px" class="col-form-label text-md-right color">Trejler:</label>
                            <input type="text" name="trailer" class="form-control" id="trailer">
                        </div>
                        <div class="form-group">
                            <label for="name" style = "font-size: 18px" class="col-form-label text-md-right color">Ime serije:</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="sel">
                                <div class="container">
                            <label for="genre" style = "font-size: 18px" class="col-form-label text-md-right color">Žanr:</label>
                                    <div class="dropdown dropdown-dark">
                                        <select name="two" class="dropdown-select form-control" multiple="multiple">
                                            <option value="komedija">Komedija</option>
                                            <option value="horor">Horor</option>
                                            <option value="akcija">Akcija</option>
                                            <option value="romansa">Romansa</option>
                                            <option value="triler">Triler</option>
                                            <option value="dokumentarna">Dokumentarna</option>
                                            <option value="drama">Drama</option>
                                        </select>
                                    </div>
                        </div>
                    </div>
                </div>
                        <div class="form-group">
                           <label for="description" style = "font-size: 18px" class="col-form-label text-md-right color">Kratak opis:</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="releaseDate" style = "font-size: 18px" class="col-form-label text-md-right color">Datum izlaska:</label>
                    <input type="date" name="releaseDate" class="form-control">
                </div>
                <div class="form-group">
                    <label for="country" style = "font-size: 18px" class="col-form-label text-md-right color">Zemlja porekla:</label>
                    <input type="text" name="country" class="form-control">
                </div>
                <div class="form-group">
                    <label for="language" style = "font-size: 18px" class="col-form-label text-md-right color">Jezik:</label>
                    <input type="text" name="language" class="form-control">
                </div>
                <div class="form-group">
                    <label for="duration" style = "font-size: 18px" class="col-form-label text-md-right color">Trajanje epizode: (u minutima)</label>
                    <input type="text" name="duration" class="form-control">
                </div>
                <div class="form-group">
                    <label for="endDate" style = "font-size: 18px" class="col-form-label text-md-right color">Datum završetka:</label>
                    <input type="date" name="endDate" class="form-control">
                </div>
                <div class="form-group">
                    <label for="episodes" style = "font-size: 18px" class="col-form-label text-md-right color">Broj epizoda:</label>
                    <input type="text" name="episodes" class="form-control">
                </div>

    </div>
        </div>
            <div class="row justify-content-center">
                <input type="submit" class="btn btn-transparent" value="Dalje">
                <a href="/"><button class="btn btn-transparent">Odustani</button></a>
            </div>
        </form>
    </div>
    @endsection