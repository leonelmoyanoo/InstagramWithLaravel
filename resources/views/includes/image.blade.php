<div class="card pub-image">
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
        <div class="image-container">
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
        <div class="comments">
            <a href="{{route('Image.detail',['id'=>$image->id])}}" class="btn btn-sm btn-warning btn-comments">
                Comentarios ({{count($image->comments)}})
            </a>
        </div>
        <div class="date">
            {{ \FormatTime::LongTimeFilter($image->created_at) }}
        </div>
    </div>
</div>