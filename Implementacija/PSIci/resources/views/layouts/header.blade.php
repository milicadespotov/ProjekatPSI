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
                <li>
                    <a href="#">Uloguj se</a>
                </li>
                <li>
                    <a href="#">Prijavi se</a>
                </li>
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