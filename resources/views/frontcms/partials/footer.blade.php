<!-- Footer start -->
<section class="our-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="our-footer-col">
                    <div class="footer-title">
                        <h2>Recent post</h2>
                    </div>
                    <div class="our-post">
                        <img src="images/blog/post-1.jpg" alt="">
                        <p><a href="#">Consectetur adipisicing elit. Eveniet, ex quis atque ab est corporis.</a></p>
                        <a href="#">3 minutes ago</a>
                    </div>
                    <div class="our-post">
                        <img src="images/blog/post-2.jpg" alt="">
                        <p><a href="#">Consectetur adipisicing elit. Eveniet, ex quis atque ab est corporis.</a></p>
                        <a href="#">5 minutes ago</a>
                    </div>
                    <div class="our-post last-post">
                        <img src="images/blog/post-3.jpg" alt="">
                        <p><a href="#">Consectetur adipisicing elit. Eveniet, ex quis atque ab est corporis.</a></p>
                        <a href="#">10 minutes ago</a>
                    </div>
                </div>  
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="our-footer-col">
                    <div class="our-footer-logo">
                        <a href="#"><img src="{{ asset('uploads/img/home/'.$home_settings->logo_image) }}" alt=""></a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed numquam hic nobis! Sint accusamus sapiente excepturi debitis corporis.</p>
                        <ul class="our-footer-social clearfix">
                            @php
                                $result = json_decode($home_settings->social_links, true);
                            @endphp
                            <li><a href="{{ $result['facebook'] }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="{{ $result['twitter'] }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="{{ $result['linkedin'] }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="{{ $result['google'] }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="subscribe-area">
                        <div class="footer-title">
                            <h2>Subscribe for Newsletter</h2>
                        </div>
                        <form>
                            <div class="input-group">
                                <input placeholder="Email Address" class="form-control" name="search-field" type="text">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-hover">Subscribe</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="our-footer-col clearfix">
                    <div class="footer-title">
                        <h2>Quick contact</h2>
                    </div>
                    <div class="quick-contact">
                        <form id="ajax-contact" method="post" action="php/contact.php">
                            <div class="row">
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required=""> 
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="">
                                </div>
                                <div class="col-sm-12">
                                    <textarea class="form-control textarea-hight-full" id="message" name="message" rows="6" placeholder="Message" required=""></textarea>
                                    <button class="btn btn-default theme-btn btn-hover" type="submit">Sent Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>


<!-- Copyright start from here -->
<div class="copyright">
    <div class="row">
        <div class="col-md-12">
            <div class="copyright-col text-center">
                <p>Copyright ©2021 <a href="https://freshktm.com" target="_blank">freshktm</a> All Rights Reserved</p>
            </div>
        </div>
    </div>
</div>