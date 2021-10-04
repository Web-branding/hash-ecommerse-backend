<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        #order{
            border-collapse: collapse;
            width: 100%;
        }
        #order td,#order th{
            border: 1px solid #ddd;
            padding: 8px;
        }
        #order tr:nth-child(even){
            background-color: #ededed;
        }
        #order th{
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background: #4b6cb7;
            color: #fff;
        }
    </style>
</head>
<body>
    <h4>Order List</h4>
    <hr>
    <table id="order">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Payment Mode</th>               
                <th>Status</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{$order->order_id}}</td>
                <td>{{$order->fname}} {{$order->lname}}</td>
                <td>{{$order->email}}</td>              
                <td>{{$order->payment_mode}}</td>           
                <td>{{$order->status}}</td>
                <td>{{$order->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>