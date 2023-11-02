<script>
    function toggleCommentForm(post_id, show) {
        var commentForm = document.getElementById('comment-form-' + post_id);
        commentForm.style.display = show ? 'block' : 'none';
    }

    function toggleDeleteForm(post_id, show) {
        var form = document.getElementById('delete-form-' + post_id);
        form.style.display = show ? 'block' : 'none';
    }

    function toggleEditForm(post_id, show) {
        var content = document.getElementById('content-' + post_id);
        var form = document.getElementById('edit-form-' + post_id);

        form.style.display = show ? 'block' : 'none';
        content.style.display = show ? 'none' : 'block';
    }
</script>

<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="max-w-xl">
        <section>
            <x-grid>
                <div style="grid-area: menu">
                    <div>
                        <button>
                            <x-upvote-logo/>
                        </button>
                    </div>
                    <div>
                        <button>
                            <x-downvote-logo/>
                        </button>
                    </div> 
                </div>
                
                <div style="grid-area: right">
                    @if($user->id == $post->user->id)
                    <x-primary-button onclick="toggleEditForm({{ $post->id }}, true)">
                            edit
                    </x-primary-button>
                    <x-secondary-button onclick="toggleDeleteForm({{ $post->id }}, true)">
                        delete
                    </x-secondary-button>
                    @endif
                </div>

                @include('post.partials.delete-post-form')

                <div style="grid-area: header">
                    <a href="/post/{{ $post->id }}" class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ $post->title }}
                    </a>
                    <br>
                    <a href="/profile/{{ $post->user->id }}" class="text-sm mt-2 text-gray-800 dark:text-gray-200 italic">
                        <u>
                            {{ $post->user->name }}
                        </u>
                    </a>
                </div>
                <div style="grid-area: main">
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200" id="content-{{ $post->id }}">
                        {{ $post->content }}
                    </p>
                    <form action="/post" method="post" class="hidden" id="edit-form-{{ $post->id }}">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{ $post->id }}">
                        <x-textarea name="content" required>{{ $post->content }}</x-textarea>
                        <x-primary-button>submit</x-primary-button>
                        <x-danger-button type="button" onclick="toggleEditForm({{ $post->id }}, false)">cancel</x-danger-button>
                    </form>
                </div>
                
                <div style="grid-area: footer">
                    <button onclick="toggleCommentForm({{ $post->id }}, true)" id="comment-btn">
                        <x-comment-logo/>
                    </button>
                    <label class="text-sm mt-2 text-gray-800 dark:text-gray-200" for="comment-btn">{{ $post->comments->count() }}</label>
                    
                    <x-collapsed id="comment-form-{{ $post->id }}">
                        <form action="/comment/{{ $post->id }}" method="post">
                            @csrf
                            @method('post')
                            <x-textarea name="content" placeholder="Type something..." required />
                            <br>
                            <x-primary-button>
                                Submit
                            </x-primary-button>
                            <x-danger-button onclick="toggleCommentForm({{ $post->id }}, false)" type="button">
                                Cancel
                            </x-danger-button>
                        </form>
                    </x-collapsed>
                </div>    
            </x-grid>
            
        </section>
     </div>
</div>