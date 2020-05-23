@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            <h1>Gente</h1>
            <form method="GET" action="{{route('user.index')}}" id="searcher">
                <div class="form-group">
                    <input type="text" id="search" class="form-controller" required>
                    <input type="submit" value="buscar" class="btn btn-success btn-sm btn-search">
                </div>
            </form>
            <hr>
            @foreach ($users as $user)
                <div class="data-profile">
                    @if ($user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar',['filename'=>$user->image]) }}" alt="Avatar" class="avatar">
                        </div>
                    @endif  
                    <div class="data-user">
                        
                        <a href="{{route('profile',['user_id'=>$user->id])}}">
                            <h2>
                                {{'@'.$user->nickname}}
                            </h2>
                        </a>
                        <h3>
                            {{$user->name.' '.$user->surname}}
                        </h3>
                        <p>
                            {{'Se unió '. \FormatTime::LongTimeFilter($user->created_at) }}
                        </p>
                    </div>
                </div>
                <hr>
            @endforeach
            
            <!--PAGINACION-->
            <div class="clearfix"></div>
                {{$users->links()}}
        </div>
    </div>
</div>
@endsection

