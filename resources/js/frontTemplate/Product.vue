<template>
    <Layout>
        <template v-slot:content="solotProps">
            <!-- breadcrumb-area -->
            <div class="breadcrumb-area breadcrumb-style-two" data-background="img/bg/s_breadcrumb_bg01.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 d-none d-lg-block">
                            <div class="previous-product">
                                <a href="shop-details.html"><i class="fas fa-angle-left"></i> previous product</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="breadcrumb-content">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item"><a href="shop.html">Winter 20</a></li>
                                        <li class="breadcrumb-item"><a href="shop.html">Women</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Tracker Jacket</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-3 d-none d-lg-block">
                            <div class="next-product">
                                <a href="shop-details.html">Next product <i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb-area-end -->

            <!-- shop-details-area -->
            <section class="shop-details-area pt-100 pb-95">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="shop-details-flex-wrap">
                                <div class="shop-details-nav-wrap">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li v-for="(item, index) in images" :key="item.id" class="nav-item" role="presentation">
                                            <a :class="'nav-link ' +showActiveClass(1, index)" :id="'item-'+item.id+'-tab'" data-toggle="tab" :href="'#item-'+item.id" role="tab" aria-controls="item-one" aria-selected="true"><img :src="item.image" alt=""></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="shop-details-img-wrap">
                                    <div class="tab-content" id="myTabContent">
                                        <div v-for="(item, index) in images" :key="item.id" :class="'tab-pane fade' +showActiveClass(2, index)" :id="'item-'+item.id" role="tabpanel" aria-labelledby="item-one-tab">
                                            <div class="shop-details-img">
                                                <img :src="item.image" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="shop-details-content">
                                <!-- <a href="#" class="product-cat">Tracker Jacket</a> -->
                                <h3 class="title">{{ product.name }}</h3>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="style-name">Style Name : {{ product.item_code }}</p>
                                <div class="price">Price : $ {{ product.product_attributes[0].price }}</div>
                                <div class="product-details-info">
                                    <span>Size <a href="#">Guide</a></span>
                                    <div class="sidebar-product-size mb-30">
                                        <h4 class="widget-title">Product Size</h4>
                                        <div class="shop-size-list">
                                            <ul>
                                                <li v-for="item in uniqueSizes" :key="item.id"><a href="javascript:void(0)" v-on:click="showColor(item), this.size = item" :class="this.size == item ? sizeColor:''">{{ item }}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="sidebar-product-color">
                                        <h4 class="widget-title">Color</h4>
                                        <div class="shop-color-list">
                                            <ul>
                                                <li v-for="item in uniqueColors" :key="item.id" v-on:click="this.color.id = item.id, this.color.text=item.text" :class="this.color.id == item.id ? colorColor:''" :style="{backgroundColor : item.value}"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="perched-info">
                                    <div class="cart-plus-minus">
                                        <form action="#" class="num-block">
                                            <input type="text" min="0" class="" value="{{ qty }}" v-model="qty" readonly="">
                                            <div class="qtybutton-box">
                                                <span class="plus" v-on:click="qty+=1"><img src="/front_assets/img/icon/plus.png" alt=""></span>
                                                <span class="minus dis" v-on:click="qty-=1"><img src="/front_assets/img/icon/minus.png" alt=""></span>
                                            </div>
                                        </form>
                                    </div>
                                    <a href="javascript:void(0)" @click="solotProps.addToCart(product.id, product?.product_attributes[0]?.id, 1)" class="btn">add to cart</a>
                                    <div class="wishlist-compare">
                                        <ul>
                                            <li><a href="#"><i class="far fa-heart"></i> Add to Wishlist</a></li>
                                            <li><a href="#"><i class="fas fa-retweet"></i> Add to Compare List</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-details-share">
                                    <ul>
                                        <li>Share :</li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product-desc-wrap">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description"
                                            aria-selected="true">Description Guide</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                            aria-selected="false">Reviews</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                        <div class="product-desc-title mb-30">
                                            <h4 class="title">Additional information :</h4>
                                        </div>
                                        <p v-html="product.description"></p>
                                        <div class="color-size-info">
                                            <ul>
                                                <li><span>COLOR :</span> Black, Gray</li>
                                                <li><span>SIZE :</span> XS, S, M, L</li>
                                            </ul>
                                        </div>
                                        <div class="additional-table">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Size Name</th>
                                                            <td>28</td>
                                                            <td>49</td>
                                                            <td>36</td>
                                                            <td>55</td>
                                                            <td>44</td>
                                                            <td>34</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Waist Stretch</th>
                                                            <td>19</td>
                                                            <td>38</td>
                                                            <td>31</td>
                                                            <td>55</td>
                                                            <td>44</td>
                                                            <td>34</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Hip (7½” below from waist)</th>
                                                            <td>11</td>
                                                            <td>18</td>
                                                            <td>21</td>
                                                            <td>55</td>
                                                            <td>44</td>
                                                            <td>34</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">length (Out seam)</th>
                                                            <td>28</td>
                                                            <td>31</td>
                                                            <td>19</td>
                                                            <td>55</td>
                                                            <td>44</td>
                                                            <td>34</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <p>The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn't
                                        distract from the layout. A practice not without controversy, laying out pages with meaningless filler text can be very
                                        useful when the focus is meant to be on design, not content.</p>
                                    </div>
                                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                        <div class="product-desc-title mb-30">
                                            <h4 class="title">Reviews (0) :</h4>
                                        </div>
                                        <p>Your email address will not be published. Required fields are marked</p>
                                        <p class="adara-review-title">Be the first to review “Adara”</p>
                                        <div class="review-rating">
                                            <span>Your rating *</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <form action="#" class="comment-form review-form">
                                            <span>Your review *</span>
                                            <textarea name="message" id="comment-message" placeholder="Your Comment"></textarea>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" placeholder="Your Name*">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="email" placeholder="Your Email*">
                                                </div>
                                            </div>
                                            <div class="comment-check-box">
                                                <input type="checkbox" id="comment-check">
                                                <label for="comment-check">Save my name and email in this browser for the next time I comment.</label>
                                            </div>
                                            <button class="btn">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="related-product-wrap">
                        <div class="row">
                            <div class="col-12">
                                <div class="related-product-title">
                                    <h4 class="title">You May Also Like...</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row related-product-active">
                            <div v-for="item in otherProducts" :key="item.id" class="col-xl-3">
                                <div class="new-arrival-item text-center">
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
                </div>
            </section>
            <!-- shop-details-area-end -->
        </template>
    </Layout>
</template>
<script>
import Layout from './Layout.vue';
import getUrlList from '../provider';
import axios from 'axios';
import { useRoute } from 'vue-router';

export default{
    name: 'Product',
    components:{
        Layout
    },
    data(){
        return {
            slug: '',
            itemCode:'',
            product:{
                product_attributes:[
                    price=>'',
                ]
            },
            images:[],
            colors:[],
            sizes:[],
            uniqueSizes:[],
            uniqueColors:[],
            size: '',
            color:{id:'', text:'', product_attr:''},
            brandColor:'brandColor',
            sizeColor:'sizeColor',
            colorColor:'colorColor',
            qty: 1,
            otherProducts: [],
        }
    },
    watch:{
        '$route'(){
            this.getProducts();
        },
        qty(val){
            if(val == 0 || val < 1){
                this.qty = 1;
            }
        }
    },
    mounted(){
        this.getProducts();
    },
    methods:{
        showColor(size){
            this.uniqueColors = [];
            this.color.id = '';
            this.color.text = '';
            this.color.product_attr = '';

            for(var item in this.colors){
                if(this.colors[item].size == size){
                    this.uniqueColors.push(this.colors[item]);
                    this.size = size;
                }
            }

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
        async getProducts(){
            try {
                const route = useRoute();
                this.slug = this.$route.params.slug;
                this.itemCode = this.$route.params.item_code;
                if(this.slug == '' || this.slug == undefined || this.slug == null ||
                    this.itemCode == '' || this.itemCode == undefined || this.itemCode == null){
                    this.$router.push({name: 'Index'});
                }else{
                    let data = await axios.get(`${getUrlList().getProductData}/${this.itemCode}/${this.slug}`);

                    if(data.status == 200 && data.data.data.data != undefined){
                        this.product = data.data.data.data;
                        this.otherProducts = data.data.data.data.otherProducts;

                        for(var item in this.product.product_attributes){
                            this.images = [];
                            for(var subItem in this.product.product_attributes[item].images){
                                this.images.push(this.product.product_attributes[item].images[subItem])
                            }

                            this.colors.push({
                                id: this.product.product_attributes[item].color.id,
                                value: this.product.product_attributes[item].color.value,
                                product_attr_id: this.product.product_attributes[item].id,
                                size: this.product.product_attributes[item].size.text,
                            });

                            this.sizes.push({
                                id: this.product.product_attributes[item].size.id,
                                text: this.product.product_attributes[item].size.text,
                                product_attr_id: this.product.product_attributes[item].id,
                            })
                        }

                        this.uniqueSizes = [...new Set(this.sizes.map(item => item.text))];
                        this.uniqueColors = this.colors;


                    }else{
                        console.log('Data not found');
                    }
                }
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>

<style>
.brandColor::before{
    background-color: #ff5400 !important;
}
.sizeColor::before{
    background-color: #ff5400 !important;
    color: #ffffff;
}
.colorColor::before{
    content: '\2713';
    display: inline-block;
    color: red;
    padding: 0 6px 0 0;
}
</style>
