<template>
    <Layout>
        <template v-slot:content="solotProps">
            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg" data-background="img/bg/breadcrumb_bg03.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-content">
                                <h2>Cart Page</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            <!-- cart-area -->
            <div class="cart-area pt-100 pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="cart-wrapper">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail"></th>
                                                <th class="product-name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">QUANTITY</th>
                                                <th class="product-subtotal">SUBTOTAL</th>
                                                <th class="product-delete"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-if="solotProps.cartCount>0" v-for="item in solotProps.cartProduct" :key="item.id">
                                                <td class="product-thumbnail"><router-link :to="'/product/'+item.products[0].item_code+'/'+item.products[0].slug"><img :src="item.products[0].image" alt=""></router-link></td>
                                                <td class="product-name">
                                                    <h4><router-link :to="'/product/'+item.products[0].item_code+'/'+item.products[0].slug">{{ item.products[0].name }}</router-link></h4>
                                                </td>
                                                <td class="product-price">$ {{ item.products[0].product_attributes[0].price }}</td>
                                                <td class="product-quantity">
                                                    <div class="cart-plus-minus">
                                                        <form action="#" class="num-block">
                                                            <input type="text" class="in-num" :value="item.qty" readonly="">
                                                            <div class="qtybutton-box">
                                                                <span class="plus" @click="solotProps.addToCart(item.products[0].id, item?.products[0].product_attributes[0]?.id, 1)"><img src="/front_assets/img/icon/plus.png" alt=""></span>
                                                                <span class="minus dis" @click="solotProps.removeCartData(item.products[0].id, item.products[0].product_attributes[0].id, 1)"><img src="/front_assets/img/icon/minus.png" alt=""></span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal"><span>$ {{ item.products[0].product_attributes[0].price * item.qty}}</span></td>
                                                <td class="product-delete"><a href="javascript:void(0)" @click="solotProps.removeCartData(item.products[0].id, item.products[0].product_attributes[0].id, item.qty)"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="shop-cart-bottom mt-20">
                                    <div class="cart-coupon">
                                        <form action="#">
                                            <input type="text" ref="couponName" :value="solotProps.couponName" placeholder="Enter Coupon Code...">
                                            <button type="button" class="btn" @click="solotProps.addCoupon(this.$refs.couponName.value)">Apply Coupon</button>
                                        </form>
                                    </div>
                                    <div class="continue-shopping">
                                        <a href="javascript:void(0)" @click="solotProps.getCartData(),solotProps.removeCoupon(),this.$refs.couponName.value=''" class="btn">Remove Coupon</a>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-total pt-95">
                                <h3 class="title">CART TOTALS</h3>
                                <div class="shop-cart-widget">
                                    <form action="#">
                                        <ul>
                                            <li class="sub-total"><span>SUBTOTAL</span> $ {{ solotProps.cartTotal }}</li>
                                            <li>
                                                <span>SHIPPING</span>
                                                <div class="shop-check-wrap">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">FLAT RATE: $15</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                        <label class="custom-control-label" for="customCheck2">FREE SHIPPING</label>
                                                    </div>
                                                    <a href="#" class="calculate">Calculate shipping</a>
                                                </div>
                                            </li>
                                            <li class="cart-total-amount"><span>TOTAL</span> <span class="amount">$ {{ solotProps.cartTotal }}</span></li>
                                        </ul>
                                        <router-link :to="'/checkout'" class="btn">PROCEED TO CHECKOUT</router-link>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- cart-area-end -->
        </template>
    </Layout>
</template>
<script>
import Layout from './Layout.vue';
import getUrlList from '../provider';
import axios from 'axios';
import { useRoute } from 'vue-router';

export default{
    name: 'ShoppingCart',
    components:{
        Layout
    },
    data(){
        return {
            couponName: '',
        }
    },
    watch:{
        couponName(val){
            this.couponName = val.replace('/\s+/g','')
        }
    }
}
</script>
