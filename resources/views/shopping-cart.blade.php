<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shopping Cart</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Shopping Cart
                </div>
                @if(!empty($cart))
                    <div>
                        <p>
                            Click here to
                            <a href="/products">continue shopping</a>
                        </p>
                    </div>
                    @foreach($cart as $product => $details)
                        <p>Name: {{ $product }}</p>
                        <p>Price: {{ $details['price'] }}</p>
                        <p>Quantity: {{ $details['quantity'] }}</p>
                        <p>Total: {{ $details['total'] }}</p>
                        <form action="/shopping-cart/{{ strtolower($product) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit">Remove Product</button>
                        </form>
                    @endforeach
                    <div>
                        <p>Cart Total: {{ $cartTotal }}</p>
                    </div>
                @else
                    <p>
                        You have no items in your cart.
                        Return to the <a href="/products">products page</a>
                    </p>
                @endif
            </div>
        </div>
    </body>
</html>
