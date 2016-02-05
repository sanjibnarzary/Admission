<nav class="navbar">
    <div>
        <img src="/assets/img/banner.jpg" class="img-responsive img-rounded banner">
    </div>
</nav>

<nav class="navbar navbar-default">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Admission 2016</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class=""><a href="/dashboard">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More.. <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <li>
                                <a href="/auth/logout">Logout</a>
                            </li>
                        @else
                            <li>
                                <a href="/auth/register">Register</a>
                            </li>
                            <li>
                                <a href="/auth/login">Login</a>
                            </li>
                        @endif

                        <li><a href="/help">Help?</a></li>
                        <li><a href="/faq">FAQ</a></li>
                        <li><a href="//www.cit.ac.in">CIT Kokrajhar</a></li>

                            <li><a href="/credits"><i class="fa fa-anchor"></i> Credits</a></li>
                    </ul>
                </li>

                <li style="width: 40%;">
                    <a href="#" ><marquee>SMS <strong>CITK &nbsp;&nbsp; ADM2016</strong> to <strong>56161</strong> For information regarding CITK Admission 2016 (SMS charges Apply)</marquee></a>
                </li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>