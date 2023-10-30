<div>
    <button>
        expand
    </button>
    <x-collapsed id="comment-list">
        @foreach($post->comments as $comment)
            @include('forum.partials.comment')
        @endforeach
    </x-collapsed> 
</div>
