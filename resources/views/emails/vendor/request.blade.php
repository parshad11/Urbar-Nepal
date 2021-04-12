@component('mail::message')
Hello  {{ Config('mail.from.name') }},<br> 
Someone has just contacted you from freshktm contact field with following detail.

@component('mail::panel')
Name: {{$name}}<br>
Email: {{$email}}<br>
Phone Number: {{$phone}}<br>
Message: {{$message}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
