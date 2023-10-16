<section>
    <x-grid>
        <div>
            <div style="grid-area: menu">
                <button>
                    <x-upvote-logo/>
                </button>
            </div>
            <div style="grid-area: menu">
                <button>
                    <x-downvote-logo/>
                </button>
            </div> 
        </div>
        <div style="grid-area: right">
            @if($user->id == $post->user->id)
            <x-secondary-button>
                edit
            </x-secondary-button>
            @endif
        </div>
        <div style="grid-area: header">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $post->title }}
            </h2>
            <a href="" class="text-sm mt-2 text-gray-800 dark:text-gray-200" style="font:italic">
                <u>
                    {{ $post->user->name }}
                </u>
            </a>
        </div>
        <div style="grid-area: main">
            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                {{ $post->content }}
            </p>
        </div>
        
        <div style="grid-area: footer">
            <button onclick="toggleComment()">
                <x-comment-logo/>
            </button>
            <div class="comment-section" style="display: none;">
                <form action="" method="post">
                    <x-text-input placeholder="Type something..."/>
                    <x-primary-button>
                        Submit
                    </x-primary-button>
                </form>
            </div>
            <div>
                @foreach($post->comments as $comment)
                    @include('forum.partials.comment')
                @endforeach
            </div>
        </div>    
    </x-grid>
    
</section>
