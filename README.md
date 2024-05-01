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
#example send data with a token: axios.post('http://127.0.0.1:8000/api/product', Data, config);
#get data profile
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
  
#updateImage
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

#chose be a Seller(updateRole) or use store new brand :
method one: join to existing brand 
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
method two: with create a new brand
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

#update Password
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
# view seller
- URL = "http://127.0.0.1:8000/seller/showSeller/{seller_id}"
- data send = none
- method = get
- data response = { seller }
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

# Store new Product: this with an authentication
- URL = "http://127.0.0.1:8000/api/product/storeProduct
- data send = {name, price, description ,category_id ,photos(array of photos , min four photo)}
- method = post
- config send = {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
- data response = { message: 'Product created successfully', product }
- status success = 201


