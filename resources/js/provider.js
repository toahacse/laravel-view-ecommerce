export function getUrlList(){
    const baseUrl = 'http://127.0.0.1:8000/api';
    return {
        getHeaderCategoriesData : `${baseUrl}/getHeaderCategoriesData`,
        getHomeData : `${baseUrl}/getHomeData`,
        getCategoryData : `${baseUrl}/getCategoryData`,
        getProductData : `${baseUrl}/getProductData`,
        getUserData : `${baseUrl}/getUserData`,
        getCartData : `${baseUrl}/getCartData`,
        addToCart : `${baseUrl}/addToCart`,
        removeCartData : `${baseUrl}/removeCartData`,
        addCoupon : `${baseUrl}/addCoupon`,
        getUserCoupon : `${baseUrl}/getUserCoupon`,
        removeCoupon : `${baseUrl}/removeCoupon`,
        getPincodeData : `${baseUrl}/getPincodeData`,
        placeOrder : `${baseUrl}/placeOrder`,
    }
}

export default getUrlList;
