@if (Auth::User()->image)
    <div class="container-avatar">
        <img src="{{ route('user.avatar',['filename'=>Auth::User()->image]) }}" alt="Avatar" class="avatar">
    </div>
@endif      