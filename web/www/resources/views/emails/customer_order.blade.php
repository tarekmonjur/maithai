@component('mail::message')

> # Thank you for your order
> ## Your order will processing soon.

---

### Order Summary
@component('mail::panel')
**Invoice No:** {{$order->invoice_no}}<br>
**Order Status:** {{$order->status}}<br>
**Payment Status:** {{$order->payment_status}}<br>
**Total Qty:** {{$order->total_qty}}<br>
**SubTotal:** {{$order->total_sub_total_amount}}<br>
**Processing Fee:** {{$order->processing_fee}}<br>
**Delivery Fee:** {{$order->delivery_fee}}<br>
**Total Amount:** {{$order->total_pay_amount}}<br>
@endcomponent

---

### Delivery Summary
@component('mail::panel')
**Full Name:** {{$order->shippingDetails->full_name}}<br>
**Email:** {{$order->shippingDetails->email}}<br>
**Mobile No:** {{$order->shippingDetails->mobile_no}}<br>
**City:** {{$order->shippingDetails->city}}<br>
**State:** {{$order->shippingDetails->state}}<br>
**Postal Code:** {{$order->shippingDetails->zip_code}}<br>
**Address:** {{$order->shippingDetails->address}}<br>
@endcomponent
---

Thanks,<br>
{{ config('app.name') }}
@endcomponent