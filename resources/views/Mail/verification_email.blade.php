@extends('Mail.layout')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            <h3 class="email-headline">
                {{-- <strong>{{__('Hello :name', ['name'=>$customer->first_name ?? 'Customer'])}}</strong> --}}
                <strong>Hello {{ $user->username }}!</strong>
            </h3>
            <p>Click the button below to verify your email address.</p>
            <div class="text-center mt20" style="margin-bottom:20px">
                <a href="{{ $url }}" target="_blank" class="btn btn-primary">{{__('Verify Email Address')}}</a>
            </div>
            <hr>
            <div>
                <p class="p-wrap">If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser: <a href="{{ $url }}" target="_blank">{{ $url }}</a></p>
            </div>
        </div>
    </div>
@endsection

