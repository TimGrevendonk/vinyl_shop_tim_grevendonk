@component('mail::message')
# Dear {{ $request->name }},
Thanks for you message.<br>
We'll contact you as soon as possible.

<hr>
<p>
<b>Your name:</b> {{ $request->name }}<br>
<b>Your email:</b> {{ $request->email }}
</p>
<p>
<b>Your message:</b><br>{!! nl2br($request->message) !!}
</p>
<p>
    <b>From:</b><br>{!! nl2br($request->contact) !!}
</p>
Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
{{-- nl2br = each line automatically gets a <br> --}}
