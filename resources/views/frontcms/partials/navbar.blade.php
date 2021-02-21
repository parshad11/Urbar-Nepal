<!-- Header navbar start -->
<div class="header-navbar fixed-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="my-nav-row">
                    <div class="row">
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <nav class="navbar navbar-default">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" data-hover="dropdown" data-animations="fadeIn">
                                    <ul class="nav navbar-nav">
                                        <li class="{{ Request::segment(1) == '' ? 'active' : ''}}">
                                            <a href="{{ route('front_dashboard') }}">Home <i class="fa fa-home" aria-hidden="true"></i></a>
                                        </li>
                                        <li class="{{ Request::segment(1) == 'about-us' ? 'active' : ''}}">
                                            <a href="{{ route('front_about') }}" >About</a>
                                        </li>
                                        <li><a href="#">Shop</a></li>
                                        <li><a href="{{route('blog')}}">Blog</a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{route('teams')}}">Our Team</a></li>
                                                <li><a href="{{route('faqs')}}">Faq Page</a></li>
                                             
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('contact')}}">Contact</a></li>
                                        <li><a href="javascript:;">Login / Register</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="my-search-box">
                                <form method="post">
                                    <div class="input-group">
                                        <input placeholder="Search Here....." class="form-control" name="search-field" type="text">
                                        <span class="input-group-btn">
                                      <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                      </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
