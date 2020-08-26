@component('mail::message')
# Introduction


<p>user Reset password code is {{$code}}</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
