<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
        * {
            font-family: "Poppins", sans-serif !important;
        }
        body{
            display: flex;
            justify-content: center;
        }
        .cart{
            max-width: 500px;
            padding: 20px;
            box-shadow: 10px 5px 10px #eee;
        }
        .head{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .head h3{
            color: #FB923C;
            margin-left: 5px;
        }
        .title{
            text-align: center;
            font-weight: 800;
            color: #2d3748;
        }
        .body{
            text-align: center;
            padding: 5px 30px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="cart" >
        <div class="head ">
            <h3>Tajir.com</h3>
        </div>
        <div class="title">
            Validation seller Account is successful
        </div>
        <div class="body">
            Congratulations, {{ $buyer->username }} <br>
            Your seller account has been successfully validated by our community.
            You're now ready to start listing your products and contributing to our marketplace! 🚀
        </div>
    </div>
</body>
</html>
