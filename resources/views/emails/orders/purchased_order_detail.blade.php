<x-mail::message>

Good day {{ $order->name }},

We are happy to inform you that your order has been successfully processed. Below are the details of your order:

<table>
    <tr>
        <td>Order ID</td>
        <td>:</td>
        <td>{{ $order->id }}</td>
    </tr>
    <tr>
        <td>Product</td>
        <td>:</td>
        <td>{{ $order->product->name }} (<a href="{{ route('category.product', $order->product_id) }}" target="_blank">View Product Here</a>)</td>
    </tr>
    <tr>
        <td>Quantity</td>
        <td>:</td>
        <td>{{ $order->quantity }}</td>
    </tr>
    <tr>
        <td>Total Price</td>
        <td>:</td>
        <td>${{ number_format($order->price, 2) }}</td>
    </tr>
    <tr>
        <td>Date of Purchased</td>
        <td>:</td>
        <td>{{ $order->created_at->format('m/d/Y h:i A') }}</td>
    </tr>
</table>

<br>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
