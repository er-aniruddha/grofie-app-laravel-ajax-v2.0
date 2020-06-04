<script>
    $('#title').text('Products');      
    $("#cover-spin").show();
    $(document).ready(function(){
        var pro_id_after_load ; /*for load product_id in url when scrolling event work*/
        var sub_cat_id , last_pro_id ;
        var allProductsInfo = [];
        var cartItem = {!! json_encode($cart_item) !!};
    //to load list of product-list
    $.ajax({
        type: 'GET',
        url: "@php route('apps.category.sub.product.list', $sub_cat_id ) @endphp",
        cache: false,
        dataType: 'json',
        beforeSend: function () {
            $("#shop-list").load(window.location + " #shop-list");
        },
        success: function (data) {

            last_pro_id = data.last_pro_id.product_id;
            
            sub_cat_id = data.products[0].sub_cat_id;

            $("#cover-spin").hide();

            if (data.success == 1) {

                for (var count = 0; count < data.products.length; count++) {
                    /*Active and In hand Stoc Products */
                    if (data.products[count].product_in_hand_stock > 0) {

                        if (data.products[count].product_offers > 0) {
                            $("#product-list").append(' <div class="cat-each">'

                                +'<div class="product">'
                                +'<div class="product-header">' 

                                +'<img class="img-fluid" src="{{$base_url}}'+data.products[count].product_image_main+'" alt=""> </div>'

                                +'<div class="product-body">'
                                +'<h5>'+data.products[count].product_name+'</h5>'
                                +'<h4>'+data.products[count].brand_name+'</h4>'

                                +'<h6><span class="mdi mdi-approval"></span> Unite - <span>'+data.products[count].unit_name_sm+'</span></h6>'

                                +'<div class="bal">'
                                +'<div class="pp">'
                                +'<p class="offer-price mb-0"><span class="regular-price">Rs. '+ data.products[count].product_sell_price +'</span> </p>'
                                +'<p class="price">Rs. '+data.products[count].product_sell_price_after_offer+'</p>'
                                +' </div>'
                                +'<div class="pcb">'
                                //Product add to temporary cart 
                                +'<button type="button" class="btn" id="_add_to_bagBtn" data-id="'+data.products[count].product_id+'" data-stock="'+data.products[count].product_in_hand_stock+'" data-price="'+data.products[count].product_sell_price_after_offer+'">'
                                +'<img src="{{asset("public/apps/img/bag.svg")}}" alt="" />'
                                +'</button>'

                                +'</div>'
                                +'</div>'

                                +'<div class="each-pqty">'
                                +'<button type="button" id="_sub_qty_Btn" class="sub" data-id="'+data.products[count].product_id+'" data-price="'+data.products[count].product_sell_price_after_offer+'" data-stock="'+data.products[count].product_in_hand_stock+'">-</button>'
                                +'<input type="number" id="_eachQtyInput" value="1"/>'
                                +'<button type="button" id="_add_more_qty_Btn" class="add" data-id="'+data.products[count].product_id+'" data-price="'+data.products[count].product_sell_price_after_offer+'" data-stock="'+data.products[count].product_in_hand_stock+'">+</button>'
                                +'<input type="hidden" id="maxQty'+data.products[count].product_id+'" value=""/>'
                                +'</div>'
                                +'</div>'
                                +'<span class="badge badge-danger off">'+data.products[count].product_offers+'% off</span>'

                                +' </div>'

                                +'</div>');
                        }
                        else {
                            $("#product-list").append(' <div class="cat-each">'

                                +'<div class="product">'
                                +'<div class="product-header">' 

                                +'<img class="img-fluid" src="{{$base_url}}'+data.products[count].product_image_main+'" alt=""> </div>'

                                +'<div class="product-body">'
                                +'<h5>'+data.products[count].product_name+'</h5>'
                                +'<h4>'+data.products[count].brand_name+'</h4>'

                                +'<h6><span class="mdi mdi-approval"></span> Unite - <span>'+data.products[count].unit_name_sm+'</span></h6>'

                                +'<div class="bal">'
                                +'<div class="pp">'
                                +'<p class="offer-price mb-0"><span class="regular-price"></span> </p>'
                                +'<p class="price">Rs. '+data.products[count].product_sell_price+'</p>'
                                +' </div>'
                                +'<div class="pcb">'
                                +'<button type="button" class="btn" id="_add_to_bagBtn" data-id="'+data.products[count].product_id+'" data-stock="'+data.products[count].product_in_hand_stock+'" data-price="'+data.products[count].product_sell_price+'">'
                                +'<img src="{{asset("public/apps/img/bag.svg")}}" alt="" />'
                                +'</button>'

                                +'</div>'
                                +'</div>'

                                +'<div class="each-pqty">'
                                +'<button type="button" id="_sub_qty_Btn" class="sub" data-id="'+data.products[count].product_id+'" data-price="'+data.products[count].product_sell_price+'" data-stock="'+data.products[count].product_in_hand_stock+'">-</button>'
                                +'<input type="number" id="_eachQtyInput" value="1"/>'
                                +'<button type="button" id="_add_more_qty_Btn" class="add" data-id="'+data.products[count].product_id+'" data-price="'+data.products[count].product_sell_price+'" data-stock="'+data.products[count].product_in_hand_stock+'" >+</button>'
                                +'<input type="hidden" id="maxQty'+data.products[count].product_id+'" value=""/>'
                                +'</div>'
                                +'</div>'
                                +'<span class="badge badge-danger off"></span>'

                                +' </div>'

                                +'</div>');
                        }
                    }
                    /*Active and In hand Stoc Products */
                    else {
                        if (data.products[count].product_offers > 0) {
                            $("#product-list").append('<div class="cat-each not-aviable">'

                                +'<div class="product">'
                                +'<div class="product-header">' 

                                +'<img class="img-fluid" src="{{$base_url}}'+data.products[count].product_image_main+'" alt=""> </div>'

                                +'<div class="product-body">'
                                +'<h5>'+data.products[count].product_name+'</h5>'
                                +'<h4>'+data.products[count].brand_name+'</h4>'

                                +'<h6><span class="mdi mdi-approval"></span> Unite - <span>'+data.products[count].unit_name_sm+'</span></h6>'

                                +'<div class="bal">'
                                +'<div class="pp">'
                                +'<p class="offer-price mb-0"><span class="regular-price">Rs. '+ data.products[count].product_sell_price_after_offer +'</span> </p>'
                                +'<p class="price">Rs. '+data.products[count].product_sell_price+'</p>'
                                +' </div>'
                                +'<div class="pcb">'
                                +'<button type="button" class="btn" id="_add_to_bagBtn" data-id="'+data.products[count].product_id+'" data-stock="'+data.products[count].product_in_hand_stock+'" data-price="'+data.products[count].product_sell_price_after_offer+'">'
                                +'<img src="{{asset("public/apps/img/bag.svg")}}" alt="" />'
                                +'</button>'

                                +'</div>'
                                +'</div>'

                                +'<div class="each-pqty">'
                                +'<button type="button" id="_sub_qty_Btn" class="sub" data-id="'+data.products[count].product_id+'" data-price="'+data.products[count].product_sell_price_after_offer+'" data-stock="'+data.products[count].product_in_hand_stock+'">-</button>'
                                +'<input type="number" id="_eachQtyInput" value="1"/>'
                                +'<button type="button" id="_add_more_qty_Btn" class="add" data-id="'+data.products[count].product_id+'" data-price="'+data.products[count].product_sell_price_after_offer+'" data-stock="'+data.products[count].product_in_hand_stock+'" >+</button>'
                                +'<input type="hidden" id="maxQty'+data.products[count].product_id+'" value=""/>'
                                +'</div>'
                                +'</div>'
                                +'<span class="badge badge-danger off">'+data.products[count].product_offers+'% off</span>'

                                +' </div>'

                                +'</div>');
                        }
                        else {
                            $("#product-list").append('<div class="cat-each not-aviable">'

                                +'<div class="product">'
                                +'<div class="product-header">' 

                                +'<img class="img-fluid" src="{{$base_url}}'+data.products[count].product_image_main+'" alt=""> </div>'

                                +'<div class="product-body">'
                                +'<h5>'+data.products[count].product_name+'</h5>'
                                +'<h4>'+data.products[count].brand_name+'</h4>'

                                +'<h6><span class="mdi mdi-approval"></span> Unite - <span>'+data.products[count].unit_name_sm+'</span></h6>'

                                +'<div class="bal">'
                                +'<div class="pp">'
                                +'<p class="offer-price mb-0"><span class="regular-price"></span> </p>'
                                +'<p class="price">Rs. '+data.products[count].product_sell_price+'</p>'
                                +' </div>'
                                +'<div class="pcb">'
                                +'<button type="button" class="btn" id="_add_to_bagBtn" data-id="'+data.products[count].product_id+'" data-stock="'+data.products[count].product_in_hand_stock+'" data-price="'+data.products[count].product_sell_price+'">'
                                +'<img src="{{asset("public/apps/img/bag.svg")}}" alt="" />'
                                +'</button>'

                                +'</div>'
                                +'</div>'

                                +'<div class="each-pqty">'
                                +'<button type="button" id="_sub_qty_Btn" class="sub" data-id="'+data.products[count].product_id+'" data-price="'+data.products[count].product_sell_price+'" data-stock="'+data.products[count].product_in_hand_stock+'">-</button>'
                                +'<input type="number" id="_eachQtyInput" value="1"/>'
                                +'<button type="button" id="_add_more_qty_Btn" class="add" data-id="'+data.products[count].product_id+'" data-price="'+data.products[count].product_sell_price+'" data-stock="'+data.products[count].product_in_hand_stock+'" >+</button>'
                                +'<input type="hidden" id="maxQty'+data.products[count].product_id+'" value=""/>'
                                +'</div>'
                                +'</div>'
                                +'<span class="badge badge-danger off"></span>'

                                +' </div>'

                                +'</div>');
                        }
                    }
                    pro_id_after_load = data.products[count].product_id;  

                }//loop end

            }//if success end

        },//Ajax Success end
        error: function(badRes){
                console.log(badRes);
            }
    });//ajax function end

/*On Scroll event*/
$(window).scroll(function(event){
    event.preventDefault();        

    if($(window).scrollTop() + $(window).height() > $(".load-more").height()){

        if(last_pro_id == pro_id_after_load){

            function preventDefault(e) {
                e.preventDefault();
            }

            function disableScroll(){
                document.body.addEventListener('touchmove', preventDefault, { passive: false });
            }

            $('.load-spin').remove();
            $('#_enpx').show();
        }
        else{
            $('.load-spin').show();
            loadmore();
        }
        
    }
});

function loadmore(){

    $.ajax({
        type:'GET',
        url:"{{ url('apps/product/loadmore/') }}/"+sub_cat_id+'/'+pro_id_after_load,
        dataType: 'json',

        success:function(data){  

            for(var count=0; count < data.moreProducts.length && last_pro_id != pro_id_after_load ; count++){ 

                /*Active and In hand Stoc Products */
                if (data.moreProducts[count].product_in_hand_stock > 0) {

                    if (data.moreProducts[count].product_offers > 0) {
                        $("#product-list").append(' <div class="cat-each">'

                            +'<div class="product">'
                            +'<div class="product-header">' 

                            +'<img class="img-fluid" src="{{$base_url}}'+data.moreProducts[count].product_image_main+'" alt=""> </div>'

                            +'<div class="product-body">'
                            +'<h5>'+data.moreProducts[count].product_name+'</h5>'
                            +'<h4>'+data.moreProducts[count].brand_name+'</h4>'

                            +'<h6><span class="mdi mdi-approval"></span> Unite - <span>'+data.moreProducts[count].unit_name_sm+'</span></h6>'

                            +'<div class="bal">'
                            +'<div class="pp">'
                            +'<p class="offer-price mb-0"><span class="regular-price">Rs. '+ data.moreProducts[count].product_sell_price_after_offer +'</span> </p>'
                            +'<p class="price">Rs. '+data.moreProducts[count].product_sell_price+'</p>'
                            +' </div>'
                            +'<div class="pcb">'
                            +'<button type="button" class="btn add-cart-btn" id="_add_to_bagBtn" data-id="'+data.moreProducts[count].product_id+'" data-stock="'+data.moreProducts[count].product_in_hand_stock+'" data-price="'+data.moreProducts[count].product_sell_price_after_offer+'">'
                            +'<img src="{{asset("public/apps/img/bag.svg")}}" alt="" />'
                            +'</button>'

                            +'</div>'
                            +'</div>'

                            +'<div class="each-pqty">'
                            +'<button type="button" id="_sub_qty_Btn" class="sub" data-id="'+data.moreProducts[count].product_id+'" data-price="'+data.moreProducts[count].product_sell_price_after_offer+'" data-stock="'+data.moreProducts[count].product_in_hand_stock+'">-</button>'
                            +'<input type="number" id="_eachQtyInput" value="1"/>'
                            +'<button type="button" id="_add_more_qty_Btn" class="add" data-id="'+data.moreProducts[count].product_id+'" data-price="'+data.moreProducts[count].product_sell_price_after_offer+'" data-stock="'+data.moreProducts[count].product_in_hand_stock+'">+</button>'
                            +'<input type="hidden" id="maxQty'+data.moreProducts[count].product_id+'" value=""/>'
                            +'</div>'
                            +'</div>'
                            +'<span class="badge badge-danger off">'+data.moreProducts[count].product_offers+'% off</span>'

                            +' </div>'

                            +'</div>');
                    }
                    else {
                        $("#product-list").append(' <div class="cat-each">'

                            +'<div class="product">'
                            +'<div class="product-header">' 

                            +'<img class="img-fluid" src="{{$base_url}}'+data.moreProducts[count].product_image_main+'" alt=""> </div>'

                            +'<div class="product-body">'
                            +'<h5>'+data.moreProducts[count].product_name+'</h5>'
                            +'<h4>'+data.moreProducts[count].brand_name+'</h4>'

                            +'<h6><span class="mdi mdi-approval"></span> Unite - <span>'+data.moreProducts[count].unit_name_sm+'</span></h6>'

                            +'<div class="bal">'
                            +'<div class="pp">'
                            +'<p class="offer-price mb-0"><span class="regular-price"></span> </p>'
                            +'<p class="price">Rs. '+data.moreProducts[count].product_sell_price+'</p>'
                            +' </div>'
                            +'<div class="pcb">'
                            +'<button type="button" class="btn add-cart-btn" id="_add_to_bagBtn" data-id="'+data.moreProducts[count].product_id+'" data-stock="'+data.moreProducts[count].product_in_hand_stock+'" data-price="'+data.moreProducts[count].product_sell_price+'">'
                            +'<img src="{{asset("public/apps/img/bag.svg")}}" alt="" />'
                            +'</button>'

                            +'</div>'
                            +'</div>'

                            +'<div class="each-pqty">'
                            +'<button type="button" id="_sub_qty_Btn" class="sub" data-id="'+data.moreProducts[count].product_id+'" data-price="'+data.moreProducts[count].product_sell_price+'" data-stock="'+data.moreProducts[count].product_in_hand_stock+'">-</button>'
                            +'<input type="number" id="_eachQtyInput" value="1"/>'
                            +'<button type="button" id="_add_more_qty_Btn" class="add" data-id="'+data.moreProducts[count].product_id+'" data-price="'+data.moreProducts[count].product_sell_price+'" data-stock="'+data.moreProducts[count].product_in_hand_stock+'">+</button>'
                            +'<input type="hidden" id="maxQty'+data.moreProducts[count].product_id+'" value=""/>'
                            +'</div>'
                            +'</div>'
                            +'<span class="badge badge-danger off"></span>'

                            +' </div>'

                            +'</div>');
                    }
                }
                /*Active and In hand Stoc Products */
                else {
                    if (data.moreProducts[count].product_offers > 0) {
                        $("#product-list").append('<div class="cat-each not-aviable">'

                            +'<div class="product">'
                            +'<div class="product-header">' 

                            +'<img class="img-fluid" src="{{$base_url}}'+data.moreProducts[count].product_image_main+'" alt=""> </div>'

                            +'<div class="product-body">'
                            +'<h5>'+data.moreProducts[count].product_name+'</h5>'
                            +'<h4>'+data.moreProducts[count].brand_name+'</h4>'

                            +'<h6><span class="mdi mdi-approval"></span> Unite - <span>'+data.moreProducts[count].unit_name_sm+'</span></h6>'

                            +'<div class="bal">'
                            +'<div class="pp">'
                            +'<p class="offer-price mb-0"><span class="regular-price">Rs. '+ data.moreProducts[count].product_sell_price_after_offer +'</span> </p>'
                            +'<p class="price">Rs. '+data.moreProducts[count].product_sell_price+'</p>'
                            +' </div>'
                            +'<div class="pcb">'
                            +'<button type="button" class="btn add-cart-btn" id="_add_to_bagBtn" data-id="'+data.moreProducts[count].product_id+'" data-stock="'+data.moreProducts[count].product_in_hand_stock+'" data-price="'+data.moreProducts[count].product_sell_price_after_offer+'">'
                            +'<img src="{{asset("public/apps/img/bag.svg")}}" alt="" />'
                            +'</button>'

                            +'</div>'
                            +'</div>'

                            +'<div class="each-pqty">'
                            +'<button type="button" id="_sub_qty_Btn" class="sub" data-id="'+data.moreProducts[count].product_id+'" data-price="'+data.moreProducts[count].product_sell_price_after_offer+'" data-stock="'+data.moreProducts[count].product_in_hand_stock+'">-</button>'
                            +'<input type="number" id="_eachQtyInput" value="1"/>'
                            +'<button type="button" id="_add_more_qty_Btn" class="add" data-id="'+data.moreProducts[count].product_id+'" data-price="'+data.moreProducts[count].product_sell_price_after_offer+'" data-stock="'+data.moreProducts[count].product_in_hand_stock+'">+</button>'
                            +'<input type="hidden" id="maxQty'+data.moreProducts[count].product_id+'" value=""/>'
                            +'</div>'
                            +'</div>'
                            +'<span class="badge badge-danger off">'+data.moreProducts[count].product_offers+'% off</span>'

                            +' </div>'

                            +'</div>');
                    }
                    else {
                        $("#product-list").append('<div class="cat-each not-aviable">'

                            +'<div class="product">'
                            +'<div class="product-header">' 

                            +'<img class="img-fluid" src="{{$base_url}}'+data.moreProducts[count].product_image_main+'" alt=""> </div>'

                            +'<div class="product-body">'
                            +'<h5>'+data.moreProducts[count].product_name+'</h5>'
                            +'<h4>'+data.moreProducts[count].brand_name+'</h4>'

                            +'<h6><span class="mdi mdi-approval"></span> Unite - <span>'+data.moreProducts[count].unit_name_sm+'</span></h6>'

                            +'<div class="bal">'
                            +'<div class="pp">'
                            +'<p class="offer-price mb-0"><span class="regular-price"></span> </p>'
                            +'<p class="price">Rs. '+data.moreProducts[count].product_sell_price+'</p>'
                            +' </div>'
                            +'<div class="pcb">'
                            +'<button type="button" class="btn add-cart-btn" id="_add_to_bagBtn" data-id="'+data.
                            moreProducts[count].product_id+'" data-stock="'+data.moreProducts[count].
                            product_in_hand_stock+'" data-price="'+data.moreProducts[count].
                            product_sell_price+'">'
                            +'<img src="{{asset("public/apps/img/bag.svg")}}" alt="" />'
                            +'</button>'

                            +'</div>'
                            +'</div>'

                            +'<div class="each-pqty">'
                            +'<button type="button" id="_sub_qty_Btn" class="sub" data-id="'+data.moreProducts[count].product_id+'" data-price="'+data.moreProducts[count].product_sell_price+'" data-stock="'+data.moreProducts[count].product_in_hand_stock+'">-</button>'
                            +'<input type="number" id="_eachQtyInput" value=""/>'
                            +'<button type="button" id="_add_more_qty_Btn" class="add" data-id="'+data.moreProducts[count].product_id+'" data-price="'+data.moreProducts[count].product_sell_price+'" data-stock="'+data.moreProducts[count].product_in_hand_stock+'">+</button>'
                            +'<input type="hidden" id="maxQty'+data.moreProducts[count].product_id+'" value=""/>'
                            +'</div>'
                            +'</div>'
                            +'<span class="badge badge-danger off"></span>'

                            +' </div>'

                            +'</div>');
                    }
                }                    
                pro_id_after_load = data.moreProducts[count].product_id;

                }//for loop end

            }, //function end

        });//ajax end

    }// Loadmore Function End



var selectProductInfo = {};
var productInHandStock;

$(document).on('click' ,'#_add_to_bagBtn', function(event){  

    productInHandStock = $(this).data('stock');
    var selectProductId = $(this).data('id');
    var selectProductPrice = $(this).data('price');
    var hasProInCart = $.grep(cartItem,function(result){
        return result.product_id === selectProductId;
    })

    if(hasProInCart != ''){

        selectProductInfo = {
            selectProductId : selectProductId, 
            selectProductPrice : selectProductPrice * (5 - hasProInCart[0].qty),
            selectProductQty: (5 - hasProInCart[0].qty)
        } 
        $('#maxQty'+$(this).data('id')).val(5-hasProInCart[0].qty);       
    } 
    else{
        selectProductInfo = {
            selectProductId : $(this).data('id'), 
            selectProductPrice : $(this).data('price'),
            selectProductQty: 1 
        } 
        $('#maxQty'+$(this).data('id')).val(5);
       
    }     
    allProductsInfo.push(selectProductInfo);
    bottomProductDetailsChange();
    $(this).parents(".bal").hide();   
    $(this).parents(".product-body").children(".each-pqty").show();
    $('.price-detail').addClass('price-detail-show');
    bottomProductDetailsChange();
});


$(document).on('click','#_add_more_qty_Btn', function () {

    productInHandStock = $(this).data('stock');

    var addMoreProductId =  $(this).data('id');
    var addMoreProductPrice =  $(this).data('price');
    var selectedProQty;

    if ($(this).prev().val() < 5 && $(this).prev().val() < productInHandStock && $(this).prev().val() < $(this).next().val()) {
        $(this).prev().val(+$(this).prev().val() + 1);                       
    }
    selectedProQty = +$(this).prev().val();

    for(var i = 0; i < allProductsInfo.length; i++){

        if(allProductsInfo[i].selectProductId == addMoreProductId){
            var subTotalPrice = selectedProQty*addMoreProductPrice;

            allProductsInfo = allProductsInfo.filter(function(elem){
               return elem != allProductsInfo[i]; 
            });                
            addMore_selectProductInfo = {
                selectProductId : $(this).data('id'), 
                selectProductPrice :  subTotalPrice,
                selectProductQty: selectedProQty
            }  
            allProductsInfo.push(addMore_selectProductInfo);
            bottomProductDetailsChange();
        }
    }
});

$(document).on('click','#_sub_qty_Btn', function () {

    productInHandStock = $(this).data('stock');
    var subDscProductId =  $(this).data('id');
    var subDscProductPrice =  $(this).data('price');
    var selectedProQty;       

    if ($(this).next().val() >= 1) {  

        selectedProQty = +$(this).next().val()-1;    

        if(selectedProQty < 1) {

            $(this).parents(".each-pqty").hide();
            $(this).parents(".product-body").children(".bal").show();

            for(var i = 0; i < allProductsInfo.length; i++){

                if(allProductsInfo[i].selectProductId == subDscProductId){

                    allProductsInfo = allProductsInfo.filter(function(elem){
                       return elem != allProductsInfo[i]; 
                    });     
                    bottomProductDetailsChange();              
                }
            }

        }
        else{

            $(this).next().val(+$(this).next().val() - 1); 

            for(var i = 0; i < allProductsInfo.length; i++){

                if(allProductsInfo[i].selectProductId == subDscProductId){
                    var subTotalPrice = selectedProQty*subDscProductPrice;

                    allProductsInfo = allProductsInfo.filter(function(elem){
                       return elem != allProductsInfo[i]; 
                   });                
                    subDsc_selectProductInfo = {
                        selectProductId : $(this).data('id'), 
                        selectProductPrice :  subTotalPrice,
                        selectProductQty: selectedProQty
                    }  
                    allProductsInfo.push(subDsc_selectProductInfo);
                    bottomProductDetailsChange();              
                }
            }

        }     
    } 
});

function bottomProductDetailsChange(){

    var subTotalAmount = 0;
    var itemCount = 0;
    var itemId;

    for(var subTotalCount = 0; subTotalCount < allProductsInfo.length; subTotalCount++){

        subTotalAmount =  subTotalAmount + allProductsInfo[subTotalCount].selectProductPrice;

        if(allProductsInfo[subTotalCount].selectProductId != itemId){
            itemCount ++;
            itemId = allProductsInfo[subTotalCount].selectProductId;
        }

    }

    if(itemCount == 0){
        if ($('.price-detail').hasClass('price-detail-show')) {
          $('.price-detail').removeClass('price-detail-show');          
        }
    }

    $("#_item_count").html(itemCount);
    $("#_subPrice").html(subTotalAmount);

}

/*Add to cart*/
$(document).on('click' ,'#_add_to_cartBtn',function(event){
    event.preventDefault()  
    $("#_bag_progress").show();
    $(':button').prop('disabled',true);
        $.ajax({
        type:'POST',
        url: "{{route('product.add.cart')}}",
        data: {allProductsInfo : JSON.stringify(allProductsInfo)},
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        statusCode:{
            401: function() {
                window.location = "{{route('apps.login')}}"
            }
        },
        success:function(data){
            if(data.success == 1){
                $(':button').prop('disabled',false);
                $("#_bag_progress").hide();
                $('.price-detail').removeClass('price-detail-show');
                $(".each-pqty").hide();
                $(".product-body").children(".bal").show();                
                $(".head-load").show();
                $('.lara-shown').hide();
                $('.ajax_shown').show();
                $("#_cart_item_val").text(data.i);
                $("#_eachQtyInput").val(1);
                cartItem = data.cartItem;
            }//data success end   

        },//Ajax success end
        error:function(badRes){
            console.log(badRes);
        }

    });//Ajax End

});//Add to cart function end



});
</script>