<h3>Thank you {{ $data->user_id }}</h3>
<h4 class="">Order placed Successfully</h4>
<h4>Order details</h4>
<h5>Shop : {{ $name }}</h5>
<p>Product-id : {{ $data->product_id }}</p>
<p>Order id : {{ $data->order_id }}</p>
<p>Payment_method : {{ $data->payment_method}}</p>
<p>Coupon Used : {{ $data->coupon_code }}</p>
<p>Total Ammount : {{ $data->order_total }}</p>