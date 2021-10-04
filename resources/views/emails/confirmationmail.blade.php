<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<p>Hai {{$details['fname']}} {{$details['lname']}},</p>
<p>Your order has been successfully placed. We are pleased to confirm your order no {{$details['order_id']}}.
Thank you for shopping with Ecommerce! If you have any questions or need assistance, contact at us help@gmail.com
</p>
<p style="font-size:20px">Delivery Address</p>
<pre style="font-family:sans-serif">
{{$details['fname']}} {{$details['lname']}}
{{$details['address']}}
{{$details['city']}}
{{$details['state']}} - {{$details['zip']}}
{{$details['phone']}}
</pre>
<p style="font-size:20px">Payment Details</p>
<hr>
<p>Amount Payable on Delivery Rs {{$details['total_price']}}</p>
</body>
</html>