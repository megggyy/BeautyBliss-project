<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ $order->id}}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #ff2487;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h2>{{ $order->fullname }} placed a New Order.</h2>
    </div>
    <table class="order-details">
        <thead>
            <tr>
                <th width="100%" colspan="1">
                    <h2 class="text-start">Beauty Bliss</h2>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="100%">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Full Name: {{ $order->fullname }}</td>
            </tr>
            <tr>
                <td>Email Id: {{ $order->email }}</td>
            </tr>
            <tr>
                <td>Phone: {{ $order->phone }}</td>
            </tr>
            <tr>
                <td>Address: {{ $order->address }}</td>
            </tr>
            <tr>
                <td>Pin code: {{ $order->pincode }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Please prepare these items.
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrice = 0;
            @endphp
          @foreach ($order->orderItems as $orderItem)
              <tr>
               <td width="10%">{{ $orderItem->id}}</td>
               <td>
                   {{ $orderItem->product->name }} 

                   @if ($orderItem->productColor)            
                   
                       @if($orderItem->productColor->color)
                      
                            <span>- Color: {{ $orderItem->productColor->color->name }}</span>
                       @endif
                   @endif
               </td>
               <td width="10%">{{ $orderItem->price}}</td>
               <td width="10%">{{ $orderItem->quantity}}</td>
               <td width="15%" class="fw-bold">${{ $orderItem->quantity * $orderItem->price}}</td>
               @php
                $totalPrice += $orderItem->quantity * $orderItem->price;
               @endphp
              </tr>
                @endforeach
              <tr>
                   <td colspan="4" class="fw-bold">Total Amount:</td>
                   <td colspan="1" class="fw-bold">${{ $totalPrice}}</td>
              </tr>
       </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for shopping with Beauty Bliss!
    </p>

</body>
</html>