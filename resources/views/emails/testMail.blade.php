@component('mail::message')
# Introduction

The body of your message.
    Title : {{$OrderShipped['title']}}
    Message : {{$OrderShipped['body']}}


@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

@component('mail::button', ['url' => '', 'color' => 'primary'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
