@component('mail::message')
# Customer Contact Message Info

## Customer FullName : {{$name}}
## Customer Email Address : {{$email}}

# Message

{{$message}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent