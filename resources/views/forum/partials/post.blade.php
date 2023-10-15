<section>
    <a href="" class="text-sm mt-2 text-gray-800 dark:text-gray-200" style="font:italic">
        <u>
            {{ $post->user->name }}
        </u>
    </a>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $post->title }}
        </h2>
    </header>
    <div>
        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
            {{ $post->content }}
        </p>
    </div>
    <div>
        <button>
            @include('components.upvote-logo')
        </button>
        <button>
            @include('components.downvote-logo')
        </button>
        <button onclick="toggleComment()">
            @include('components.comment-logo')
        </button>
    </div>
    <div class="comment-section" style="display: none">
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
</section>
