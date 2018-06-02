@extends('layouts.master')

@section('content')
    <div class="container">
        <form method="POST" enctype="multipart/form-data" action="/confirmSeries" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @csrf
        <div class="row justify-content-center" style="margin-top:20px;">
            <div class="col-lg-6">
                        <div class="form-group">
                            <label for="mainImage" style = "font-size: 18px" class="col-form-label text-md-right color">Naslovna slika:</label><br>
                            <input type="file" name="mainImage" class="form-control input-file" id="mainImage">
                        </div>
                        <div class="form-group">
                            <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Ostale slike:</label><br>
                            <input type="file" name="pictures[]" multiple class="form-control input-file" id="pictures">
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


                            <label for="genre" style = "font-size: 18px" class="col-form-label text-md-right color">Žanr:</label>

                                        <table cell-padding="20px">
                                            <tr>
                                                <td style="padding:10px">
                                                    <label for="dokumentarna">Dokumentarna:</label></td><td style="padding:10px">
                                                    <input type="checkbox" name="zanr[]" value="dokumentarna">
                                                </td>
                                                <td style="padding:10px">
                                                    <label for="komedija">Komedija:</label></td><td style="padding:10px">
                                                    <input type="checkbox" name="zanr[]" value="komedija">
                                                </td>
                                                <td style="padding:10px">
                                                    <label for="akcija">Akcija:</label></td><td style="padding:10px">
                                                    <input type="checkbox" name="zanr[]" value="akcija">
                                                </td>
                                                <td style="padding:10px">
                                                    <label for="horor">Horor:</label></td><td style="padding:10px">
                                                    <input type="checkbox" name="zanr[]" value="horor">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:10px">
                                                    <label for="triler">Triler:</label></td><td style="padding:10px">
                                                    <input type="checkbox" name="zanr[]" value="triler">
                                                </td>
                                                <td style="padding:10px">
                                                    <label for="drama">Drama:</label></td><td style="padding:10px">
                                                    <input type="checkbox" name="zanr[]" value="drama">
                                                </td>
                                                <td style="padding:10px">
                                                    <label for="romansa">Romansa:</label></td><td style="padding:10px">
                                                    <input type="checkbox" name="zanr[]" value="romansa">
                                                </td>
                                                <td style="padding:10px">
                                                    <label for="animirana">Animirana:</label></td><td style="padding:10px">
                                                    <input type="checkbox" name="zanr[]" value="animirana">
                                                </td>
                                            </tr>
                                        </table>


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