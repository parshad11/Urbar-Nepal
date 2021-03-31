@extends('ecommerce.layouts.master')
@section('content')
<!--  category -->
<section id="category-filter">
    <div class="w-100 mx-auto">
        <div class="row my-4">
            <div class=" col-lg-2 col-md-3 col-sm-12 px-4 ">
                <aside class="left__side mb mt-3">

                    <ul uk-accordion="multiple: true">
                        <li class="">
                            <a class="uk-accordion-title" href="#">
                                <h5> Category</h5>
                            </a>
                            <div class="uk-accordion-content">
                                <div class="scrollbar   mCustomScrollbar">
                                    <ul>
                                        <li class="category-list"><a class="link-category" href="#">category 1
                                            </a></li>
                                        <li class="category-list"><a class="link-category" href="#">category 2
                                            </a></li>

                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class=" ">
                            <a class="uk-accordion-title" href="#">
                                <h5> Price</h5>
                            </a>
                            <div class="uk-accordion-content">
                                <div class="price-list ">



                                    <h6>Range :</h6>
                                    <form action="" class="price-range mt-2 mx-auto d-flex">
                                        <input type="number" placeholder="Min." min="1">
                                        &nbsp; - &nbsp;
                                        <input type="number" placeholder="Max." min="1">
                                    </form>
                                </div>
                            </div>
                        </li>

                    </ul>

                </aside>

            </div>
            <div class=" col-lg-10 col-md-9 box-shadow-xy">

                <div class="d-flex align-items-center justify-content-between">
                    <div class="Name__of__category mt-2">
                        <div class="heading d-flex">
                            <h3>Category Products </h3>
                        </div>

                    </div>
                    <div class="product_sort_by ">
                        <div class="d-flex align-items-center">
                            <div class="heading">
                                <h5>Sort by: &nbsp;</h5>

                            </div>
                            <select name="" class="uk-select" style="width: 100px">
                                <option value="">New</option>
                                <option value="">Price</option>
                                <option value="">Popular</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="product-category white-product">

                    <article class="product mt-2 instock sale purchasable">
                        <div class="product-wrap">
                            <div class="product-top">
                                <span class="product-label discount">new</span>


                                <figure>
                                    <a href="singlepage.html">
                                        <div class="product-image">
                                            <img width="320" height="320"
                                                src="https://cdn.shopify.com/s/files/1/0108/7370/0415/products/Shop-1.png"
                                                class="attachment-shop_catalog size-shop_catalog" alt="">
                                        </div>
                                    </a>
                                </figure>


                            </div>
                            <div class="product-description">

                                <div class="product-meta">
                                    <div class="title-wrap">
                                        <p class="product-title">
                                            <a href="singlepage.html">Water Melon || Per KG</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="product_price">
                                        <div class="product_price-actual">
                                            Rs.50
                                        </div>
                                        <div class="product_price-discount">
                                            <span class="line-through">
                                                Rs.70
                                            </span>
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="product_cart">
                                        <a href="javascript:void(0)">
                                            <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="product mt-2 instock sale purchasable">
                        <div class="product-wrap">
                            <div class="product-top">
                                <span class="product-label discount">new</span>








                                <figure>
                                    <a href="singlepage.html">
                                        <div class="product-image">
                                            <img width="320" height="320"
                                                src="https://images.unsplash.com/photo-1555704574-f9ecf4717298?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=80"
                                                class="attachment-shop_catalog size-shop_catalog" alt="">
                                        </div>
                                    </a>
                                </figure>


                            </div>
                            <div class="product-description">

                                <div class="product-meta">
                                    <div class="title-wrap">
                                        <p class="product-title">
                                            <a href="singlepage.html">Kurilo || Muthha</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="product_price">
                                        <div class="product_price-actual">
                                            Rs.200
                                        </div>
                                        <div class="product_price-discount">
                                            <span class="line-through">
                                                Rs.250
                                            </span>
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="product_cart">
                                        <a href="javascript:void(0)">
                                            <ion-icon name="cart" uk-tooltip=" Add to Cart" title=""
                                                aria-expanded="false" role="img" class="hydrated"
                                                aria-label="cart"></ion-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="product mt-2 instock sale purchasable">
                        <div class="product-wrap">
                            <div class="product-top">
                                <span class="product-label discount">new</span>


                                <figure>
                                    <a href="singlepage.html">
                                        <div class="product-image">
                                            <img width="320" height="320"
                                                src="https://cdn.shopify.com/s/files/1/0108/7370/0415/products/Shop-4.png"
                                                class="attachment-shop_catalog size-shop_catalog" alt="">
                                        </div>
                                    </a>
                                </figure>


                            </div>
                            <div class="product-description">

                                <div class="product-meta">
                                    <div class="title-wrap">
                                        <p class="product-title">
                                            <a href="singlepage.html">Hen EGG || Per Caret</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="product_price">
                                        <div class="product_price-actual">
                                            Rs.380
                                        </div>
                                        <div class="product_price-discount">
                                            <span class="line-through">
                                                Rs.400
                                            </span>
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="product_cart">
                                        <a href="javascript:void(0)">
                                            <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="product mt-2 instock sale purchasable">
                        <div class="product-wrap">
                            <div class="product-top">
                                <span class="product-label discount">new</span>


                                <figure>
                                    <a href="singlepage.html">
                                        <div class="product-image">
                                            <img width="320" height="320"
                                                src="https://m.economictimes.com/thumb/height-450,width-600,imgsize-111140,msid-72862126/potato-getty.jpg"
                                                class="attachment-shop_catalog size-shop_catalog" alt="">
                                        </div>
                                    </a>
                                </figure>


                            </div>
                            <div class="product-description">

                                <div class="product-meta">
                                    <div class="title-wrap">
                                        <p class="product-title">
                                            <a href="singlepage.html">White Potato || Per KG</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="product_price">
                                        <div class="product_price-actual">
                                            Rs.150
                                        </div>
                                        <div class="product_price-discount">
                                            <span class="line-through">
                                                Rs.180
                                            </span>
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="product_cart">
                                        <a href="javascript:void(0)">
                                            <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="product mt-2 instock sale purchasable">
                        <div class="product-wrap">
                            <div class="product-top">
                                <span class="product-label discount">new</span>


                                <figure>
                                    <a href="singlepage.html">
                                        <div class="product-image">
                                            <img width="320" height="320" src="https://solidstarts.com/wp-content/uploads/introducing-avocado-to-babies.jpg
                                                " class="attachment-shop_catalog size-shop_catalog" alt="">
                                        </div>
                                    </a>
                                </figure>


                            </div>
                            <div class="product-description">

                                <div class="product-meta">
                                    <div class="title-wrap">
                                        <p class="product-title">
                                            <a href="singlepage.html">White Potato || Per KG</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="product_price">
                                        <div class="product_price-actual">
                                            Rs.150
                                        </div>
                                        <div class="product_price-discount">
                                            <span class="line-through">
                                                Rs.180
                                            </span>
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="product_cart">
                                        <a href="javascript:void(0)">
                                            <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="product mt-2 instock sale purchasable">
                        <div class="product-wrap">
                            <div class="product-top">
                                <span class="product-label discount">new</span>


                                <figure>
                                    <a href="singlepage.html">
                                        <div class="product-image">
                                            <img width="320" height="320" src="https://solidstarts.com/wp-content/uploads/introducing-avocado-to-babies.jpg
                                                " class="attachment-shop_catalog size-shop_catalog" alt="">
                                        </div>
                                    </a>
                                </figure>


                            </div>
                            <div class="product-description">

                                <div class="product-meta">
                                    <div class="title-wrap">
                                        <p class="product-title">
                                            <a href="singlepage.html">White Potato || Per KG</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="product_price">
                                        <div class="product_price-actual">
                                            Rs.150
                                        </div>
                                        <div class="product_price-discount">
                                            <span class="line-through">
                                                Rs.180
                                            </span>
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="product_cart">
                                        <a href="javascript:void(0)">
                                            <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="product mt-2 instock sale purchasable">
                        <div class="product-wrap">
                            <div class="product-top">
                                <span class="product-label discount">new</span>


                                <figure>
                                    <a href="singlepage.html">
                                        <div class="product-image">
                                            <img width="320" height="320" src="https://media.istockphoto.com/photos/dragon-fruit-or-pitahaya-isolated-on-white-background-picture-id912578564?k=6&m=912578564&s=612x612&w=0&h=Ytkftlpuj1PWRvBhQBB7txb2dLRkY3PQdmUh3Pb0lZ8=

                                                " class="attachment-shop_catalog size-shop_catalog" alt="">
                                        </div>
                                    </a>
                                </figure>


                            </div>
                            <div class="product-description">

                                <div class="product-meta">
                                    <div class="title-wrap">
                                        <p class="product-title">
                                            <a href="singlepage.html">White Potato || Per KG</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="product_price">
                                        <div class="product_price-actual">
                                            Rs.150
                                        </div>
                                        <div class="product_price-discount">
                                            <span class="line-through">
                                                Rs.180
                                            </span>
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="product_cart">
                                        <a href="javascript:void(0)">
                                            <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>



                </div>

            </div>
        </div>
    </div>
</section>
@endsection