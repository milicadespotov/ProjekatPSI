<?php
/**
 * Created by PhpStorm.
 * User: Filip Djukic
 * Date: 31-May-18
 * Time: 20:44
 */

@extends('layouts.master')


@section('content')

    <br>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-6">
                    <img src="img/profilna_test.jpg" style="width:100%">
                    <h4>Status: Administrator</h4>
                    <p>
                        <a href="#">
                            <input type="submit" value="Izmeni informacije" class="btn btn-transparent">
                        </a>
                    </p>
                    <p>
                        <a href="#">
                            <input type="submit" value="Odgledano" class="btn btn-transparent">
                        </a>
                    </p>
                </div>
                <div class="col-md-6">
                    <h2>Ime i prezime</h2>
                    <h4>Email adresa: </h4>
                    <h4>Datum rodjenja: 22.06.1996.</h4>
                    <h4>Pol: muski</h4>
                    <h4>Clan od: </h4>
                </div>
            </div>
            <div class="col-md-8 ">
                <center>
                    <h3>Poslednje ocenjeno</h3>
                </center>
                <br>
                <div>
                    <center>
                        <a href="img/favicon.png" data-lightbox="movie">
                            <img src="img/got.jpg" style="width:300px">
                        </a>
                        <a href="img/got.jpg" data-lightbox="movie">
                            <img src="img/got.jpg" style="width:300px">
                        </a>
                        <a href="img/logo-meghna.png" data-lightbox="movie">
                            <img src="img/got.jpg" style="width:300px">
                        </a>

                    </center>
                </div>
                <br>
                <br>
                <br>
                <br>
                <center>
                    <h3>Poslednje odgledano</h3>
                </center>
                <br>
                <div>
                    <center>
                        <a href="img/favicon.png" data-lightbox="movie">
                            <img src="img/got.jpg" style="width:300px">
                        </a>
                        <a href="img/got.jpg" data-lightbox="movie">
                            <img src="img/got.jpg" style="width:300px">
                        </a>
                        <a href="img/logo-meghna.png" data-lightbox="movie">
                            <img src="img/got.jpg" style="width:300px">
                        </a>

                    </center>
                </div>
            </div>
        </div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

@endsection