@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("includes.message")
        <div class="col-md-8">
            <div class="data-profile">
                @if ($user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar',['filename'=>$user->image]) }}" alt="Avatar" class="avatar">
                    </div>
                @endif  
                <div class="data-user">
                    <h1>
                        {{'@'.$user->nickname}}
                    </h1>
                    <h2>
                        {{$user->name.' '.$user->surname}}
                    </h2>
                    <p>
                        {{'Se unió '. \FormatTime::LongTimeFilter($user->created_at) }}
                    </p>
                </div>
            </div>
            
            <div class="clearfix"></div>
            <hr>
            @include('includes.message')
            @foreach ($user->images as $image)
                @include('includes.image',['image'=>$image])
            @endforeach
        </div>
    </div>
</div>
@endsection

