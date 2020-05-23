@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("includes.message")
        <div class="col-md-10">

                <div class="card pub-image pub-image-detail">
                    <div class="card-header">
                        @if ($image->user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" alt="Avatar" class="avatar">
                            </div>
                        @endif      
                        <div class="data-user">
                            <a href="{{route('profile',['user_id'=>$image->user->id])}}">
                                {{$image->user->name.' '.$image->user->surname}}
                                <span class="nickname">
                                    {{' | @'.$image->user->nickname}}
                                </span>
                            </a>
                        </div>
                        @include("includes.editImage")
                    </div>

                    <div class="card-body">
                        <div class="image-container image-detail">
                            <img src="{{route('Image.file',['filename'=>$image->image_path])}}" alt="Publicación de {{'@'.$image->user->nickname}}">
                        </div>
                        
                        <div class="likes">
                            <!--Comprobar si el usuario dio like-->
                            <?php $user_like = false;?>
                            @foreach ($image->likes as $like)
                                @if ($like->user->id == Auth::user()->id)
                                    <?php $user_like = true;?>
                                @endif
                            @endforeach

                            @if ($user_like)
                                <img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-like">
                            @else
                                <img src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-dislike">
                            @endif
                            <span class="number_likes"> {{count($image->likes)}}</span>
                            
                        </div>
                        <div class="description">
                            <span class="nickname">{{'@'.$image->user->nickname}}</span>
                            {{$image->description}}
                        </div>
                        <div class="clearfix"></div>
                        <div class="comments">
                            <h2>
                                Comentarios ({{count($image->comments)}})
                            </h2>    
                            <hr>
                                <form method="POST" action="{{route('Comment.save')}}">
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{$image->id}}" class="@error('image_id') is-invalid @enderror">
                                    @error('image_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <p>
                                            <textarea class="form-control @error('content') is-invalid @enderror" name="content" required></textarea>
                                            @error('content')
                                                <span class="invalid-feedback alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </p>
                                    <button type="submit" class="btn btn-success">
                                        Enviar
                                    </button> 
                                </form>
                                @foreach ($image->comments as $comment)
                                    <div class="comment">
                                        <span class="nickname">{{'@'.$comment->user->nickname}}</span>
                                        {{$comment->content}}
                                        @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                            
                                            <a href="{{route('Comment.delete',['id'=>$comment->id])}}" class="btn btn-sm btn-danger float-right">
                                                Eliminar
                                            </a>
                                        @endif

                                        <div class="date">
                                            {{ \FormatTime::LongTimeFilter($comment->created_at) }}
                                        </div>
                                    </div>                                        
                                @endforeach
                        </div>
                        
                        <div class="date">
                            {{ \FormatTime::LongTimeFilter($image->created_at) }}
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
</div>
@endsection