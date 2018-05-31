@extends('layouts.master')

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 ">

                <div class="blog-title">
                    <h1>Naziv serije</h1>
                </div>

            </div>
            <div class="col-lg-8">
                <div class="blog-title">
                    <h1>Ocenjivanje</h1>
                </div>

            </div>
            <!-- End col-lg-12 -->
        </div>
        <br>
        <br>



        <div class="row" style="font-size: 20px">

            <div class="col-md-5">
                <!--Glavna slika	-->
                <center>
                    <img src="{{ asset('img/got.jpg') }}" style="width:100%;height:auto">
                </center>
                <br>
                <!--Glavna slika serije-->
                <div class="col-md-12">
                    <b>Glumci: </b> Ovaj Onaj, Stiven Tulovic, Aleksa Simovic
                </div>
            </div>
            <div class="col-md-2">
                <table style="border-collapse: separate;border-spacing:25px">
                    <tr>
                        <td>
                            <b> TV Serija: </b> 2011-</td>
                    </tr>
                    <tr>
                        <td>
                            <b>Žanr: </b>Akcija, drama </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Zemlja: </b> SAD</td>
                    </tr>
                    <tr>
                        <td>
                            <b>Trajanje: </b> 57min</td>
                    </tr>
                    <tr>
                        <td>
                            <b>Jezik: </b> engleski</td>
                    </tr>
                    <tr>
                        <td>
                            @if (Auth::check() && Auth::user()->is_admin==true)
                            <a href="#">
                                <input type="submit" value="Izmeni podatke" class="btn btn-transparent">
                            </a>
                                @else
                            &nbsp;
                                @endif
                        </td>
                    </tr>
                </table>
            </div>


            <div class="col-md-5" style="font-weight: bold">
                <!--Sezone-->
                <table class="table-dark  " style="width:100%;text-align: center">
                    <th colspan="3" style="text-align: center">
                        <h3>Sezone</h3>
                    </th>
                    <tr>
                        <td style="width:30%">Ime sezone:</td>
                        <td style="padding-top:16px">
                            <div class="progress">
                                <div class="progress-bar" style="width:70%">70%</div>
                            </div>
                        </td>
                        <td style="width:15%;padding-left:5px">
                            4/22
                        </td>
                    </tr>
                </table>
                @if (Auth::check() && Auth::user()->is_admin==true)
                <center>
                    <a href="#">
                        <input type="submit" value="Dodaj sezonu" class="btn btn-transparent">
                    </a>
                </center>
                    @endif
            </div>



        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <center>
                    <h2>Opis:</h2>
                </center>
                <!--Opis-->
                Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem
                ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem
                ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem
                ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem
                ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem
                ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem
                ipsum v Lorem ipsum

            </div>
            <div class="col-md-6">
                <!--Trejler-->
                <center>
                    <h2>Trejler</h2>
                    @if(Auth::check() && Auth::user()->is_admin==true)
                    <a href="#">
                        <input type="submit" value="Dodaj trejler" class="btn btn-transparent">
                    </a>
                        @endif
                </center>

            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h2>Slike</h2>
                    <br>
                </center>
            </div>
            <!--Galerija-->
            <div class="col-md-12">
                <center>
                    <a href="{{ asset('img/favicon.png') }}" data-lightbox="movie">
                        <img src="{{ asset('img/favicon.png') }}">
                    </a>
                    <a href="{{ asset('img/got.jpg') }}" data-lightbox="movie">
                        <img src="{{ asset('img/got.jpg') }}" style="width:100px">
                    </a>
                    <a href="{{ asset('img/logo-meghna.png') }}" data-lightbox="movie">
                        <img src="{{ asset('img/logo-meghna.png') }}">
                    </a>
                    <a href="{{ asset('img/meghna.png') }}" data-lightbox="movie">
                        <img src="{{ asset('img/meghna.png') }}">
                    </a>
                </center>
                @if (Auth::check() && Auth::user()->is_admin==true)
                <center>
                    <a href="#">
                        <input type="submit" value="Dodaj sliku" class="btn btn-transparent">
                    </a>
                </center>
                    @endif
            </div>
        </div>



    </div>
    <br>
    <br>
@endsection