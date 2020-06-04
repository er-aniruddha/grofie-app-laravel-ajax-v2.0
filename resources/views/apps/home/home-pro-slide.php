@if($topsevers)
            @foreach($topsevers as $topsaver)
            @if($topsaver->product_stat == 1 && $topsaver->product_in_hand_stock > 0)
            <div class="item">
               <div class="product ">
                  <a href="single.html">
                     <div class="product-header">                           
                        <img class="img-fluid" src="{{asset($topsaver->product_image_main)}}" alt="">                           
                     </div>
                     <div class="product-body">
                        <h5>{{$topsaver->product_name}}</h5>
                        <h6>{{$topsaver->unit_name_sm}} gm</h6>
                     </div>
                     <div class="product-footer">
                        <p class="offer-price mb-0"><span class="regular-price">Rs. {{$topsaver->product_sell_price}}</span> <span class="badge badge-danger">{{$topsaver->product_offers}} OFF</span> </p>
                        <p class="price">Rs. {{$topsaver->product_sell_price_after_offer}}</p>
                        <div class="clearfix"></div>
                     </div>
                  </a>
               </div>
            </div> 
            @else 
            <div class="item">
               <div class="product not-aviable">
                  <a href="single.html">
                     <div class="product-header">                           
                        <img class="img-fluid" src="{{asset($topsaver->product_image_main)}}" alt="">                           
                     </div>
                     <div class="product-body">
                        <h5>{{$topsaver->product_name}}</h5>
                        <h6>{{$topsaver->unit_name_sm}} gm</h6>
                     </div>
                     <div class="product-footer">
                        <p class="offer-price mb-0"><span class="regular-price">Rs. {{$topsaver->product_sell_price}}</span> <span class="badge badge-danger">{{$topsaver->product_offers}} OFF</span> </p>
                        <p class="price">Rs. {{$topsaver->product_sell_price_after_offer}}</p>
                        <div class="clearfix"></div>
                     </div>
                  </a>
               </div>
            </div>          
            @endif
            @endforeach
            @endif 