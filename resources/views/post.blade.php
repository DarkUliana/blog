<div class="card">
        <img class="card-img-top" src="{{ asset($post->image) }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->text }}</p>
        </div>
</div>