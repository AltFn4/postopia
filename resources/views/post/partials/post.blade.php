<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="max-w-xl">
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
                    <a href="/post/{{ $post->id }}" class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ $post->title }}
                    </a>
                    <br>
                    <a href="" class="text-sm mt-2 text-gray-800 dark:text-gray-200" style="font:italic">
                        <u>
                            {{ $post->user->name }}
                        </u>
                    </a>
                </div>
                <div style="grid-area: main" id="content-{{ $post->id }}">
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ $post->content }}
                    </p>
                </div>
                
                <div style="grid-area: footer">
                    <button>
                        <x-comment-logo/>
                    </button>
                    <x-collapsed id="comment-form">
                        <form action="" method="post">
                            <x-textarea placeholder="Type something..."/>
                            <x-primary-button>
                                Submit
                            </x-primary-button>
                        </form>
                    </x-collapsed>
                </div>    
            </x-grid>
            
        </section>
     </div>
</div>