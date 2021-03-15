@extends('frontcms.layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('cms/css/shop.css') }}">
    @endsection
@section('content')
<!-- SHOP SECTION -->
<div class="shop ">

    <!-- OVERLAY -->
    <div class="shop-banner">
        <div class="image"><img src="https://merogroceries.com/images/media/2020/10/YXFgk16107.png" alt=""></div>
        <!-- <div class="overlay"></div> -->
        <!-- <a href="#content" class="btn btn-success">Shop Now</a> -->
    </div>

    <!-- CONTENT -->
    <div class="content container-fluid" id="content">
        <hr>
        <div class="row">
            <div class=" col-md-3 left">
                <div class="download">
                    <div class="title"> Catalogue</div>

                    <div class="download-options">
                        <button>Catalogue 1 &nbsp; <i class="fas fa-download"></i></button>

                        <button>Catalogue 2 &nbsp; <i class="fas fa-download"></i></button>
                    </div>
                </div>

                <div class="category">
                    <div class="title"> SPECIAL SALE</div>

                    <ul class="category-list">
                        <li><a href="category.htm">Seasonal</a></li>

                        <li><a href="category.htm">Non-Seasonal</a></li>
                        <li><a href="category.htm">Seasonal</a></li>

                        <li><a href="category.htm">Non-Seasonal</a></li>
                        <li><a href="category.htm">Seasonal</a></li>

                        <li><a href="category.htm">Non-Seasonal</a></li>


                    </ul>
                </div>

                <div class="category">
                    <div class="title"> Categories</div>

                    <ul class="category-list">
                        <li class="main"><a href="category.htm">Dry Fruits </a>
                            &nbsp;<i style="float: right; margin:auto" class="fas fa-chevron-right"></i>
                            <ul class="sub">
                                <li><a href="subcategory.htm">seasnal</a></li>

                                <li><a href="subcategory.htm"></a>Non seasnal</a></li>
                                <li><a href="subcategory.htm">seasnal</a></li>

                                <li><a href="subcategory.htm"></a>Non seasnal</a></li>

                            </ul>
                        </li>

                        <li class="main"><a href="category.htm">Dry Fruits </a>
                            &nbsp;<i style="float: right; margin:auto" class="fas fa-chevron-right"></i>
                            <ul class="sub">
                                <li><a href="subcategory.htm">seasnal</a></li>

                                <li><a href="subcategory.htm"></a>Non seasnal</a></li>
                                <li><a href="subcategory.htm">seasnal</a></li>

                                <li><a href="subcategory.htm"></a>Non seasnal</a></li>

                            </ul>
                        </li>

                        <li class="main"><a href="category.htm">Dry Fruits </a>
                            &nbsp;<i style="float: right; margin:auto" class="fas fa-chevron-right"></i>
                            <ul class="sub">
                                <li><a href="subcategory.htm">seasnal</a></li>

                                <li><a href="subcategory.htm"></a>Non seasnal</a></li>

                                <li><a href="subcategory.htm">seasnal</a></li>

                                <li><a href="subcategory.htm"></a>Non seasnal</a></li>

                            </ul>
                        </li>


                    </ul>
                </div>
            </div>
            <div class="col-md-9 right">

                <!-- SEARCH BOX -->
                <div class="search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search ...."
                               aria-describedby="basic-addon2">

                        <span class="input-group-addon btn btn-success" id="basic-addon2">Search &nbsp;<i
                                    class="fas fa-search"></i></span>
                    </div>
                </div>

                <!-- PRODUCTS -->
                <div class="row ">

                    <div class=" card col-md-4 col-sm-6 col-xs-6">
                        <div class="product">
                            <div class="img"><a href="single.htm
                  "><img src="https://www.radishbo-ya.co.jp/contents/shop/radish/commodity/249.jpg" alt=""></a>
                            </div>
                            <div class="description">
                                <div class="title"><b><a href="single.htm">Tomato</a></b></div>
                                <div class="price">
                                    <div class="kalimati"><small>Kalimati Price : 120 Rs</small></div>

                                    <div class="main main-offer">Price : 120 Rs</div>

                                    <div class="offer">Offer : 120 Rs</div>
                                </div>

                                <button class="btn btn-success">Add to Cart</button>
                            </div>

                        </div>


                    </div>

                    <div class=" card col-md-4 col-sm-6 col-xs-6">
                        <div class="product">
                            <div class="img"><a href="single.htm
                  "><img src="https://www.radishbo-ya.co.jp/contents/shop/radish/commodity/249.jpg" alt=""></a>
                            </div>
                            <div class="description">
                                <div class="title"><b><a href="single.htm">Tomato</a></b></div>
                                <div class="price">
                                    <div class="kalimati"><small>Kalimati Price : 120 Rs</small></div>

                                    <div class="main ">Price : 120 Rs</div>
                                    <div class="offer">Offer : N/A</div>


                                </div>

                                <button class="btn btn-success">Add to Cart</button>
                            </div>

                        </div>


                    </div>

                    <div class=" card col-md-4 col-sm-6 col-xs-6">
                        <div class="product">
                            <div class="img"><a href="single.htm
                  "><img src="https://www.radishbo-ya.co.jp/contents/shop/radish/commodity/249.jpg" alt=""></a>
                            </div>
                            <div class="description">
                                <div class="title"><b><a href="single.htm">Tomato</a></b></div>
                                <div class="price">
                                    <div class="kalimati"><small>Kalimati Price : 120 Rs</small></div>

                                    <div class="main main-offer">Price : 120 Rs</div>

                                    <div class="offer">Offer : 120 Rs</div>
                                </div>

                                <button class="btn btn-success">Add to Cart</button>
                            </div>

                        </div>


                    </div>

                    <div class=" card col-md-4 col-sm-6 col-xs-6">
                        <div class="product">
                            <div class="img"><a href="single.htm
                  "><img src="https://www.radishbo-ya.co.jp/contents/shop/radish/commodity/249.jpg" alt=""></a>
                            </div>
                            <div class="description">
                                <div class="title"><b><a href="single.htm">Tomato</a></b></div>
                                <div class="price">
                                    <div class="kalimati"><small>Kalimati Price : 120 Rs</small></div>

                                    <div class="main ">Price : 120 Rs</div>
                                    <div class="offer">Offer : N/A</div>


                                </div>

                                <button class="btn btn-success">Add to Cart</button>
                            </div>

                        </div>


                    </div>
                    <div class=" card col-md-4 col-sm-6 col-xs-6">
                        <div class="product">
                            <div class="img"><a href="single.htm
                  "><img src="https://www.radishbo-ya.co.jp/contents/shop/radish/commodity/249.jpg" alt=""></a>
                            </div>
                            <div class="description">
                                <div class="title"><b><a href="single.htm">Tomato</a></b></div>
                                <div class="price">
                                    <div class="kalimati"><small>Kalimati Price : 120 Rs</small></div>

                                    <div class="main main-offer">Price : 120 Rs</div>

                                    <div class="offer">Offer : 120 Rs</div>
                                </div>

                                <button class="btn btn-success">Add to Cart</button>
                            </div>

                        </div>


                    </div>

                    <div class=" card col-md-4 col-sm-6 col-xs-6">
                        <div class="product">
                            <div class="img"><a href="single.htm
                  "><img src="https://www.radishbo-ya.co.jp/contents/shop/radish/commodity/249.jpg" alt=""></a>
                            </div>
                            <div class="description">
                                <div class="title"><b><a href="single.htm">Tomato</a></b></div>
                                <div class="price">
                                    <div class="kalimati"><small>Kalimati Price : 120 Rs</small></div>

                                    <div class="main ">Price : 120 Rs</div>
                                    <div class="offer">Offer : N/A</div>


                                </div>

                                <button class="btn btn-success">Add to Cart</button>
                            </div>

                        </div>


                    </div>
                    <div class=" card col-md-4 col-sm-6 col-xs-6">
                        <div class="product">
                            <div class="img"><a href="single.htm
                  "><img src="https://www.radishbo-ya.co.jp/contents/shop/radish/commodity/249.jpg" alt=""></a>
                            </div>
                            <div class="description">
                                <div class="title"><b><a href="single.htm">Tomato</a></b></div>
                                <div class="price">
                                    <div class="kalimati"><small>Kalimati Price : 120 Rs</small></div>

                                    <div class="main main-offer">Price : 120 Rs</div>

                                    <div class="offer">Offer : 120 Rs</div>
                                </div>

                                <button class="btn btn-success">Add to Cart</button>
                            </div>

                        </div>


                    </div>

                    <div class=" card col-md-4 col-sm-6 col-xs-6">
                        <div class="product">
                            <div class="img"><a href="single.htm
                  "><img src="https://www.radishbo-ya.co.jp/contents/shop/radish/commodity/249.jpg" alt=""></a>
                            </div>
                            <div class="description">
                                <div class="title"><b><a href="single.htm">Tomato</a></b></div>
                                <div class="price">
                                    <div class="kalimati"><small>Kalimati Price : 120 Rs</small></div>

                                    <div class="main ">Price : 120 Rs</div>
                                    <div class="offer">Offer : N/A</div>


                                </div>

                                <button class="btn btn-success">Add to Cart</button>
                            </div>

                        </div>


                    </div>
                    <div class=" card col-md-4 col-sm-6 col-xs-6">
                        <div class="product">
                            <div class="img"><a href="single.htm
                  "><img src="https://www.radishbo-ya.co.jp/contents/shop/radish/commodity/249.jpg" alt=""></a>
                            </div>
                            <div class="description">
                                <div class="title"><b><a href="single.htm">Tomato</a></b></div>
                                <div class="price">
                                    <div class="kalimati"><small>Kalimati Price : 120 Rs</small></div>

                                    <div class="main main-offer">Price : 120 Rs</div>

                                    <div class="offer">Offer : 120 Rs</div>
                                </div>

                                <button class="btn btn-success">Add to Cart</button>
                            </div>

                        </div>


                    </div>

                    <div class=" card col-md-4 col-sm-6 col-xs-6">
                        <div class="product">
                            <div class="img"><a href="single.htm
                  "><img src="https://www.radishbo-ya.co.jp/contents/shop/radish/commodity/249.jpg" alt=""></a>
                            </div>
                            <div class="description">
                                <div class="title"><b><a href="single.htm">Tomato</a></b></div>
                                <div class="price">
                                    <div class="kalimati"><small>Kalimati Price : 120 Rs</small></div>

                                    <div class="main ">Price : 120 Rs</div>
                                    <div class="offer">Offer : N/A</div>


                                </div>

                                <button class="btn btn-success">Add to Cart</button>
                            </div>

                        </div>


                    </div>


                </div>
            </div>
        </div>

    </div>

</div>
@endsection
@section('scripts')
    <script src="{{ asset('cms/js/shop.js') }}"></script>
    @endsection
