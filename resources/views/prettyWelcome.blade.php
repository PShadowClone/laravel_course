@component('mail::message')
    # Introduction

    {{$user->name}} Welcome

    {{--@component('mail::button', ['url' => ''])--}}
        {{--Button Text--}}
    {{--@endcomponent--}}

    Thanks,
    {{ config('app.name') }}
@endcomponent
