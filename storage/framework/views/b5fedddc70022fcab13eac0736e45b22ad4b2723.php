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
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($order->order_id); ?></td>
                <td><?php echo e($order->fname); ?> <?php echo e($order->lname); ?></td>
                <td><?php echo e($order->email); ?></td>              
                <td><?php echo e($order->payment_mode); ?></td>           
                <td><?php echo e($order->status); ?></td>
                <td><?php echo e($order->created_at); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH C:\Users\Anju\Desktop\projects\ecomm_backend\resources\views/order/allorders.blade.php ENDPATH**/ ?>