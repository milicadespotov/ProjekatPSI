<header id="navigation" class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header" style="margin-left:7%">
            <!-- responsive nav button -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- /responsive nav button -->

            <!-- logo -->
            <a class="navbar-brand" href="#body">
                <h1 id="logo">
                    <img src="{{ asset('img/probni_logo.png') }}" style="width:100px;height:auto" alt="WSS" />
                </h1>
            </a>
            <!-- /logo -->
        </div>

        <!-- main nav -->
        <nav class="collapse navbar-collapse navbar-right" role="Navigation">
            <ul id="nav" class="nav navbar-nav">
                <li class="current">
                    <a href="#">Početna</a>
                </li>

                <li>
                    <a href="#">Najpopularnije</a>
                </li>
                <li>
                    <a href="#">Predstojeće</a>
                </li>

                <li class="dropdown">
                    <a href="#" data-toggle="dropdown">Opcije
                        <span class="fa fa-caret-down"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <a href="#"> MESTA PROJEKCIJE </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#"> FILMOVI </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#"> PRODAJNA MESTA </a>
                        </li>



                    </ul>
                </li>
                @if(!Auth::check())
                <li>
                    <a href="#">Uloguj se</a>
                </li>
                <li>
                    <a href="#">Prijavi se</a>
                </li>
                @endif
                @if(Auth::check())
                    @if(Auth::user()->is_admin==true)

                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown">{{Auth::user()->name}} {{Auth::user()->surname}}
                                <span class="fa fa-caret-down"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li class="dropdown-item">
                                    <a href="#"> DODAVANJE NOVIH SERIJA </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#myModal" data-toggle="modal"> UKLONI NALOG </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#"> IZLOGUJ SE </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#"> UPRAVLJANJE NALOZIMA </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#"> PROMENI LOZINKU </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                    @if(Auth::user()->is_admin==false)
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown">{{Auth::user()->name}} {{Auth::user()->surname}}
                                    <span class="fa fa-caret-down"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a href="#myModal" data-toggle="modal"> UKLONI NALOG </a>
                                    </li>

                                    <li class="dropdown-item">
                                        <a href="#"> IZLOGUJ SE </a>
                                    </li>

                                    <li class="dropdown-item">
                                        <a href="#"> PROMENI LOZINKU </a>
                                    </li>

                                </ul>
                            </li>


                    @endif
                    @endif
                <li style="padding-top:15px;margin-left:20px">
                    <div class="widget-content">

                        <form action="#" id="search-form" method="get" role="search">
                            <table>
                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>Prva</option>
                                            <option>Druga</option>
                                        </select>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Pretraga..." autocomplete="on" name="seach">
                                        <button type="submit" title="Search" id="search-submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </td>

                                </tr>
                            </table>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </div>      <!-- /main nav -->
</header>

<div class="container-fluid">

    @if(Auth::check())

    <div class="modal" id="myModal" style="margin-top:15%;color:black;">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#2B2C30;color:white">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size:20px">Uklanjanje naloga
                        <button style="margin-bottom:10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></h5>
                </div>
                <div class="modal-body">
                    <p>Da li ste sigurni da želite da uklonite svoj nalog?</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="/removeAccount/{{Auth::user()->username}}">
                        <input type="submit" class="btn btn-transparent">Potvrdi</input>
                        <button type="button" class="btn btn-transparent" data-dismiss="modal">Odustani</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
        @endif
</div>
