<template>
<Layout>

    <template v-slot:content="solotProps">
        <!-- slider-area -->
        <section class="slider-area position-relative">
            <div class="third-slider-active">

                <div v-for="item in homeBanner" :key="item.id" class="third-slider-item third-slider-bg" style="background-image: url('/front_assets/img/slider/third_slider_bg.jpg');" data-background="/front_assets/img/slider/third_slider_bg.jpg">
                    <div class="container custom-container-two">
                        <div class="third-slider-wrap">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="slider-content">
                                        <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".4" data-duration-in="1.5">{{ item.text }}</h2>
                                        <a :href="item.link" class="btn" data-animation-in="fadeInUp" data-delay-in=".8" data-duration-in="1.5">Shop now</a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="third-slider-img">
                                        <div class="img-shape" data-background="/front_assets/img/slider/third_slide_shape.png" data-animation-in="zoomIn"
                                            data-delay-in="1" data-duration-in="1.5"></div>
                                        <img :src="item.image" alt="" class="main-img" data-animation-in="slideInRight2" style="height: 537px; width: 560px;"
                                            data-delay-in="1" data-duration-in="1.5">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- slider-area-end -->

        <!-- shoes-category-area -->
        <div class="shoes-category-area pt-80 pb-30">
            <div class="container custom-container-two">
                <div class="row justify-content-center">

                    <div v-for="item in getShortArray(3)" :key="item.id" class="col-lg-4 col-md-6 col-sm-9">
                        <div class="shoes-cat-item mb-50">
                            <div class="thumb mb-30">
                                <a href="shop-sidebar.html"><img :src="item.image" style="height: 200px;" alt=""></a>
                            </div>
                            <div class="content">
                                <ul>
                                    <li><a href="shop-sidebar.html">{{ item.name }}</a></li>
                                    <li><span>18</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- shoes-category-area-end -->

        <!-- trending-product-area -->
        <section class="trending-product-area trending-product-two gray-bg pt-95 pb-100">
            <div class="container custom-container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-6">
                        <div class="section-title title-style-two text-center mb-50">
                            <h3 class="title">Trending Products</h3>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters trending-product-grid">
                    <div class="col-2">
                        <div class="trending-products-list">
                            <h5>Category</h5>
                            <ul class="nav nav-tabs" id="trendingTab" role="tablist">

                                <li v-for="(catItem, index) in getShortArray(6)" :key="catItem.id" class="nav-item" role="presentation">
                                    <a :class="'nav-link ' +showActiveClass(1, index)" :id="'cat_'+catItem.id" data-toggle="tab" :href="'#cat-tab'+catItem.id" role="tab" :aria-controls="'cat_'+catItem.id" aria-selected="true">{{ catItem.name }}</a>
                                </li>

                            </ul>
                            <p class="offer"><a href="#">Limited-Time Offer!</a></p>
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="tab-content tp-tab-content" id="trendingTabContent">

                            <div v-for="(catItem, index) in getShortArray(6)" :key="catItem.id" :class="'tab-pane ' +showActiveClass(2, index)" :id="'cat-tab'+catItem.id" role="tabpanel" :aria-labelledby="'cat-tab'+catItem.id+'-tab'">
                                <div class="trending-products-banner banner-animation">
                                    <a href="shop-sidebar.html"><img :src="catItem.image" alt=""></a>
                                </div>
                                <div class="row trending-product-active">

                                    <div v-for="item in catItem.products" :key="item.id" class="col">
                                        <div class="features-product-item">
                                            <div class="features-product-thumb">
                                                <div class="discount-tag">-20%</div>
                                                <router-link :to="'/product/'+item.item_code+'/'+item.slug">
                                                    <img :src="item.image" alt="">
                                                </router-link>
                                                <div class="product-overlay-action">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                                        <li><router-link :to="'/product/'+item.item_code+'/'+item.slug"><i class="far fa-eye"></i></router-link></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="features-product-content">
                                                <div class="rating">
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                                <h5><router-link :to="'/product/'+item.item_code+'/'+item.slug">{{ item.name }}</router-link></h5>
                                                <p class="price">${{ item?.product_attributes[0]?.price ?? 0 }}</p>
                                                <div class="features-product-bottom">
                                                    <ul>
                                                        <li class="color-option">
                                                            <span class="gray"></span>
                                                            <span class="cyan"></span>
                                                            <span class="orange"></span>
                                                        </li>
                                                        <li class="limited-time"><a href="#">Limited-Time Offer!</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="features-product-cart"><a href="javascript:void(0)" @click="solotProps.addToCart(item.id, item?.product_attributes[0]?.id, 1)">add to cart</a></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- trending-product-area-end -->

        <!-- new-arrival-area -->
        <section class="new-arrival-area pt-95 pb-45">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-6">
                        <div class="section-title title-style-two text-center mb-45">
                            <h3 class="title">New Arrival Collection</h3>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="new-arrival-nav mb-35">
                            <button v-for="(catItem, index) in getShortArray(3)" :key="catItem.id" :class="'ok '+showActiveClass(1, index)" :data-filter="'.category_'+catItem.id">{{ catItem.name }}</button>
                        </div>
                    </div>
                </div>
                <div class="row new-arrival-active">
                    <div v-for="item in homeProducts" :key="item.id" :class="'col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer category_'+item.category_id">
                        <div class="new-arrival-item text-center mb-50">
                            <div class="thumb mb-25">
                                <router-link :to="'/product/'+item.item_code+'/'+item.slug"><img :src="item.image" alt=""></router-link>
                                <div class="product-overlay-action">
                                    <ul>
                                        <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                        <li><router-link :to="'/product/'+item.item_code+'/'+item.slug"><i class="far fa-eye"></i></router-link></li>
                                        <li><a href="javascript:void(0)" @click="solotProps.addToCart(item.id, item?.product_attributes[0]?.id, 1)"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content">
                                <h5><router-link :to="'/product/'+item.item_code+'/'+item.slug">{{ item.name }}</router-link></h5>
                                <span class="price">${{ item?.product_attributes[0]?.price ?? 0 }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- new-arrival-area-end -->

        <!-- shoes-banner-area -->
        <section class="shoes-banner-area">
            <div class="container">
                <div class="shoes-banner-active">
                    <div class="shoes-banner-bg" data-background="/front_assets/img/bg/shoes-banner_bg.jpg">
                        <div class="row">
                            <div class="col-12">
                                <div class="shoes-banner-content">
                                    <h6>Athletes Shoes</h6>
                                    <h2>9 Best <span>Shoes for</span> Standing All Day Review 2020</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shoes-banner-bg" data-background="/front_assets/img/bg/shoes-banner_bg.jpg">
                        <div class="row">
                            <div class="col-12">
                                <div class="shoes-banner-content">
                                    <h6>Athletes Shoes</h6>
                                    <h2>3 Best <span>Shoes for</span> Standing All Day Review 2021</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shoes-banner-bg" data-background="/front_assets/img/bg/shoes-banner_bg.jpg">
                        <div class="row">
                            <div class="col-12">
                                <div class="shoes-banner-content">
                                    <h6>Athletes Shoes</h6>
                                    <h2>8 Best <span>Shoes for</span> Standing All Day Review 2021</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shoes-banner-area-end -->

        <!-- promo-services -->
        <section class="promo-services pt-70 pb-25">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-6 col-sm-8">
                        <div class="promo-services-item mb-40">
                            <div class="icon"><img src="../assets/img/icon/promo_icon01.png" alt=""></div>
                            <div class="content">
                                <h6>payment & delivery</h6>
                                <p>Delivered, when you receive arrives</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-8">
                        <div class="promo-services-item mb-40">
                            <div class="icon"><img src="../assets/img/icon/promo_icon02.png" alt=""></div>
                            <div class="content">
                                <h6>Return Product</h6>
                                <p>Retail, a Product Return Process</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-8">
                        <div class="promo-services-item mb-40">
                            <div class="icon"><img src="../assets/img/icon/promo_icon03.png" alt=""></div>
                            <div class="content">
                                <h6>money back guarantee</h6>
                                <p>Options Including 24/7</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-8">
                        <div class="promo-services-item mb-40">
                            <div class="icon"><img src="../assets/img/icon/promo_icon04.png" alt=""></div>
                            <div class="content">
                                <h6>Quality support</h6>
                                <p>Support Options Including 24/7</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- promo-services-end -->

        <!-- instagram-post-area -->
        <div class="instagram-post-area">
            <div class="container-fluid p-0 fix">
                <div class="row no-gutters insta-active">

                    <div v-for="item in homeBrands" :key="item.id" class="col">
                        <div class="insta-post-item">
                            <a href="#">
                                <i class="fab fa-instagram"></i>
                                <img style="height: 220px; width: 380px;" :src="item.image" alt="">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- instagram-post-area-end -->
    </template>

</Layout>
</template>
<script>
import Layout from './Layout.vue';
import getUrlList from '../provider';
import axios from 'axios';

export default{
    name: 'Index',
    components:{
        Layout
    },
    data(){
        return {
            homeBanner:[],
            homeCategories:[],
            homeBrands:[],
            homeProducts:[],
        }
    },
    mounted(){
        this.getHomeBanner();
    },
    methods:{
        getShortArray(size){
            return this.homeCategories.slice(0,size)
        },
        showActiveClass(type, index){
            if(type == 1 && index == 0){
                return 'active';
            }else if(type ==2 && index == 0){
                return 'show active';
            }else{
                return '';
            }
        },
        async getHomeBanner(){
            try {
                let data = await axios.get(getUrlList().getHomeData);

                if(data.status == 200 && data.data.data.data.banner.length > 0){
                    this.homeBanner = data.data.data.data.banner;
                    this.homeCategories = data.data.data.data.categories;
                    this.homeBrands = data.data.data.data.brands;
                    this.homeProducts = data.data.data.data.products;
                }else{
                    console.log('Data not found');
                }
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>
