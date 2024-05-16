<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

### run server
# config Data Base 
- install Xamp or laragon
- start running Apache and MySQL with port 3306
- create a new DB with the name e-commerce
- set password vide
- use the user root
# make migration: php artisan migrate
# run server: php artisan serve

### documentation 
# Example send data with a token: const response =  await axios.post('http://127.0.0.1:8000/api/product', Data, config);
## Register & Login 
# register
- URL = "http://127.0.0.1:8000/api/register"
- data send = { username, email, password,password_confirmation}
- data response = { token , buyer }
- method = post
- status success = 201
# login
- URL = "http://127.0.0.1:8000/api/login"
- data send = { email, password }
- data response = { token , buyer }
- method = post
- status success = 200
## Profile 
all of the routes you must authenticate in the platform with a token
# get data profile
- URL = "http://127.0.0.1:8000/api/profile"
- data send = none
- method = get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { buyer }
- status success = 200
# LogOut 
- URL = "http://127.0.0.1:8000/api/profile/logout"
- data send = none
- method = get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message "Logged out successfully" }
- status success = 200
  
# Update Profile 
- URL = "http://127.0.0.1:8000/api/profile/update"
- data send = {username, address, phone, image(jpeg,png,jpg,gif,svg|max:2048)}
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Profile updated successfully', buyer }
- status success = 200
  
# updateImage
- URL = "http://127.0.0.1:8000/api/profile/updateImage"
- data send = {image(jpeg,png,jpg,gif,svg|max:2048)}
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'image updated successfully', buyer }
- status success = 200

# chose be a Seller(updateRole) or use store new brand :
# method one: join to existing brand 
- URL = "http://127.0.0.1:8000/api/profile/updateRole"
- data send = { brand_id, commercialRecord(pdf)}
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Seller created successfully', seller }
- status success = 201
# method two: with create a new brand
- URL = "http://127.0.0.1:8000/api/brand/store"
- data send = { name(name brand), commercialRecord(pdf) , logo(image|max:2048) , background_image(image|max:2048) }
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Brand and Seller Account created successfully', seller }
- status success = 201

# update Password
- URL = "http://127.0.0.1:8000/api/profile/resetPassword"
- data send = {old_password, new_password , password_confirmation }
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Password changed successfully' }
- status success = 200

  

##  Brands 
these without authenticate 
# get All Brands
- URL = "http://127.0.0.1:8000/brand/getBrands"
- data send = none
- method = get
- data response = { brands }
- status success = 200
# view brand
- URL = "http://127.0.0.1:8000/brand/showBrand/{brand_id}"
- data send = none
- method = get
- data response = { brand }
- status success = 200



## Seller
this without authenticate 
# View seller
- URL = "http://127.0.0.1:8000/seller/showSeller/{seller_id}"
- data send = none
- method = get
- data response = { seller }
- status success = 200

# View Stocks
- URL = "http://127.0.0.1:8000/seller/stock"
- data send = none
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- method = get
- data response = { stocks }
- status success = 200

# Show Stock
- URL = "http://127.0.0.1:8000/seller/stock/{product_id}"
- data send = none
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- method = get
- data response = { stock }
- status success = 200






## category
# categories
- URL = "http://127.0.0.1:8000/categories"
- data send = none
- method = get
- data response = { categories }
- status success = 200


## Product 
# Get All Products with Pagination
- URL = "http://127.0.0.1:8000/products"
- data send = none
- method = get
- data response = { products , paginate }
- status success = 200

# Get Products with search
- URL = "http://127.0.0.1:8000/products?search={search}"
- data send = none
- method = get
- data response = { products , paginate }
- status success = 200


# Get Products with a Select category 
- URL = "http://127.0.0.1:8000/products?category_id={category_id}"
- data send = none
- method = get
- data response = { products , paginate }
- status success = 200


# Get Products with price comparison  
- URL = "http://127.0.0.1:8000/products?min_price={min_price}&max_price={max_price}"
- data send = none
- method = get
- data response = { products , paginate }
- status success = 200

# view Product 
- URL = "http://127.0.0.1:8000//product/{product_id}"
- data send = none
- method = get
- data response = { product }
- status success = 200

# Manage your Product (for seller)
# Store new Product: this with an authentication
- URL = "http://127.0.0.1:8000/api/product/storeProduct"
- data send = {name, price, description , quantity ,category_id ,photos(array of photos , min 3 photo max 6 photos)}
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Product created successfully', product }
- status success = 201


# update Product
- URL = "http://127.0.0.1:8000/api/product/updateProduct/{product_id}"
- data send = {name, price, description , quantity}
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Product details updated successfully', product }
- status success = 200

# update  Product Photos
- URL = "http://127.0.0.1:8000/api/product/updatePhotos/{product_id}"
- data send = { photos(array of photos , min 3 photo max 6 photos) }
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Product photos updated successfully', product }
- status success = 200

# Delete Product
- URL = "http://127.0.0.1:8000/api/product/deleteProduct/{product_id}"
- data send = none
- method = Delete
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Product deleted successfully' }
- status success = 200

## Cart all of these you need to be authenticated
# Add To Cart
- URL = "http://127.0.0.1:8000/api/cart/addToCart"
- data send = {product_id}
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Product added to cart successfully', cart }
- status success = 201


# update Cart (change quantity)
- URL = "http://127.0.0.1:8000/api/cart/updateCart"
- data send = {id(id_cart) , qte}
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'cart(Qte) updated successfully', cart }
- status success = 200

# Delete cart 
- URL = "http://127.0.0.1:8000/api/cart/deleteCart/{cart_id}"
- data send = none
- method = delete
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Cart deleted successfully' }
- status success = 200


# Clear all my carts
- URL = "http://127.0.0.1:8000/api/cart/clearCarts"
- data send = none
- method = delete
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Carts deleted successfully' }
- status success = 200
 
# Get All my Cart 
- URL = "http://127.0.0.1:8000/api/cart/getCarts"
- data send = none
- method = get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { carts }
- status success = 200

# Discount 
# Get All Discount vailable for this cart 
- URL = "http://127.0.0.1:8000/api/discount/{cart_id}"
- data send = none
- method = get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { carts }
- status success = 200

# Store new Discount for seller 
- URL = "http://127.0.0.1:8000/api/discount/store"
- data send = {discount , max_discount , dateE }
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message : Discount created successfully  , discount }
- status success = 201

# Update exist Discount for seller 
- URL = "http://127.0.0.1:8000/api/discount/update/{discount_id}"
- data send = {discount , max_discount , dateE }
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message : Discount updated successfully  , discount }
- status success = 200

# Update exist Discount for seller 
- URL = "http://127.0.0.1:8000/api/discount/delete/{discount_id}"
- data send = none
- method = delete
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message : Discount deleted successfully  }
- status success = 200

# Activate Discount for cart 
- URL = "http://127.0.0.1:8000/api/discount/activate/{discount_id}"
- data send = {cart_id}
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message : discount activated successfully  , cart }
- status success = 200

# Deactivate All Discounts for cart 
- URL = "http://127.0.0.1:8000/api/discount/deactivate/{cart_id}"
- data send = none
- method = put
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message : discount deactivated successfully  , cart }
- status success = 200

# Search about Coupon  for this  cart 
- URL = "http://127.0.0.1:8000/api/discount/searchCoupon"
- data send = {cart_id , search}
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { coupon }
- status success = 200

# Activate Coupon for cart 
- URL = "http://127.0.0.1:8000/api/discount/activateCoupon/{coupon_id}"
- data send = {cart_id}
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message : coupon activated successfully  , cart }
- status success = 200

## Order must be authenticate
# these for buyer
# Set Order 
- URL = "http://127.0.0.1:8000/api/order/order"
- data send = {cart_id}
- method = Post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message :  the order sent successfully , Order  }
- status success = 201


# Get All Orders
- URL = "http://127.0.0.1:8000/api/order/hisOrders"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  Orders  }
- status success = 200

# Show Order
- URL = "http://127.0.0.1:8000/api/order/hisOrders/{order}"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  Order  }
- status success = 200

# Get All Order Accepted 
- URL = "http://127.0.0.1:8000/api/order/acceptedHisOrders"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  Orders  }
- status success = 200

# Get All Orders Rejected 
- URL = "http://127.0.0.1:8000/api/order/rejectedHisOrders"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  Orders  }
- status success = 200

# Get All Orders waiting to accept or reject by seller
- URL = "http://127.0.0.1:8000/api/order/waitingHisOrders"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  Orders  }
- status success = 200


# All these for seller
# Accept Order by Seller
- URL = "http://127.0.0.1:8000/api/order/acceptOrder/{order_id}"
- data send = none
- method = Put
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message :  the order accepted successfully , Order  }
- status success = 200

# Reject Order by Seller
- URL = "http://127.0.0.1:8000/api/order/rejectOrder/{order_id}"
- data send = none
- method = Put
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message :  the order rejected successfully , Order  }
- status success = 200


# Get All Orders
- URL = "http://127.0.0.1:8000/api/order/sellerOrders"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  Orders  }
- status success = 200

# Show Order
- URL = "http://127.0.0.1:8000/api/order/sellerOrder/{order_id}"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  Order  }
- status success = 200

# Get All seller Accepted Orders
- URL = "http://127.0.0.1:8000/api/order/sellerAcceptedOrders"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  Orders  }
- status success = 200

# Get All seller Rejected Orders
- URL = "http://127.0.0.1:8000/api/order/sellerRejectedOrders"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  Orders  }
- status success = 200

# Get All Orders waiting to accept or reject by seller
- URL = "http://127.0.0.1:8000/api/order/waitingOrders"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  Orders  }
- status success = 200


## Notificatoin , status of notification can be one of these ['success', 'warning', 'question', 'danger' , 'error' ]
# Get All Notificaton 
- URL = "http://127.0.0.1:8000/api/profile/notification"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  notification  }
- status success = 200

# Destroy Notification
- URL = "http://127.0.0.1:8000/api/profile/notification/{notification_id}"
- data send = none
- method = Delete
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  'message' => 'Notification deleted successfully'  }
- status success = 200


# Review 
# Test this Buyer Can Store Review 
- URL = "http://127.0.0.1:8000/api/review/test/{product_id}"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { True Or False }
- status success = 200

# Get All Review By Product 
- URL = "http://127.0.0.1:8000/api/review/{product_id}"
- data send = none
- method = Get
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  reviews  }
- status success = 200

# Store Review By Product 
- URL = "http://127.0.0.1:8000/api/review/{product_id}"
- data send = {rating , content}
- method = Post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  message : Review created successfully  , review   }
- status success = 201

# Ubdate Review  
- URL = "http://127.0.0.1:8000/api/review/update/{review_id}"
- data send = {rating , content}
- method = Post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  message : Review Updated successfully  , review   }
- status success = 200

# Delete Review  
- URL = "http://127.0.0.1:8000/api/review/delete/{review_id}"
- data send = none
- method = Delete
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  message : Review Deleted successfully  }
- status success = 200

# Complaints 
# Store Complaint about review 
## for this you must be a seller (Owner of Product)
- URL = "http://127.0.0.1:8000/api/review/complaint/{review_id}"
- data send = {title , body }
- method = Post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  message : complaint Created successfully , complaint  }
- status success = 201

# Store Complaint about Product 
## for this you must be a seller  (Owner of Product)
- URL = "http://127.0.0.1:8000/api/product/complaint/{product_id}"
- data send = {title , body }
- method = Post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  message : complaint Created successfully , complaint  }
- status success = 201

# Store Complaint about buyer 
## for this you must be a seller (this buyer ordered from you anything)
- URL = "http://127.0.0.1:8000/api/order/complaint/{order_id}"
- data send = {title , body }
- method = Post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  message : complaint Created successfully , complaint  }
- status success = 201

# Store Complaint about seller 
## for this you must be a buyer (you ordered from  this seller anything)
- URL = "http://127.0.0.1:8000/api/order/complaint/seller/{order_id}"
- data send = {title , body }
- method = Post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = {  message : complaint Created successfully , complaint  }
- status success = 201


