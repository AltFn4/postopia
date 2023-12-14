<script>
    function toggleCommentForm(post_id, show) {
        var commentForm = $("#comment-form-" + post_id);
        commentForm.style.display = show ? 'block' : 'none';
    }

    function toggleEditForm(post_id, show) {
        var content = document.getElementById('content-' + post_id);
        var form = document.getElementById('edit-form-' + post_id);

        form.style.display = show ? 'block' : 'none';
        content.style.display = show ? 'none' : 'block';
    }

    function submitComment(post_id) {
        var content = $("#comment-content-" + post_id).val();
        $.ajax({
            url: "{{ route('comment.create') }}",
            type: "POST",
            data: {
                '_token': '{{ csrf_token() }}',
                'content': content,
                'post_id': post_id,
            },
            success: function(data) {
                if (data.success) {
                    console.log('success!');
                    // Add comment UI
                }
            }
        });
    }
</script>

<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="max-w-full">
        <section>
            <x-grid>
                <div class="row-start-1 col-start-1 row-span-1 col-span-9">
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
                
                <div class="row-start-1 col-start-10 row-span-1 col-span-1 text-end">
                    @if(Auth::user()->role->canEdit || Auth::user()->id == $post->user->id)
                    <x-primary-button onclick="toggleEditForm({{ $post->id }}, true)">
                            edit
                    </x-primary-button>
                    @endif
                    @if(Auth::user()->role->canDelete || Auth::user()->id == $post->user->id)
                    <x-secondary-button @click="deleteClick({{ $post->id }})">
                        delete
                    </x-secondary-button>
                    @endif
                </div>

                <div class="row-start-2 col-start-2 col-span-9 bg-gray-700 p-5 sm:rounded-lg">
                    <p class="text-sm mt-2 text-gray-200 dark:text-gray-200" id="content-{{ $post->id }}">
                        {{ $post->content }}
                    </p>
                    @foreach($post->images as $image)
                        <div class="w-1/2">
                             <img class="bg-contain" src="{{ asset('storage/images/' . $image->name)}}" alt="{{ $image->name }}">
                        </div>
                    @endforeach
                    <form action="/post" method="post" class="hidden" id="edit-form-{{ $post->id }}">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{ $post->id }}">
                        <x-textarea name="content" required>{{ $post->content }}</x-textarea>
                        <x-primary-button>submit</x-primary-button>
                        <x-danger-button type="button" onclick="toggleEditForm({{ $post->id }}, false)">cancel</x-danger-button>
                    </form>
                </div>
                
                <div class="row-start-3 col-start-1 row-span-2 col-span-10">
                    <button onclick="toggleCommentForm({{ $post->id }}, true)" id="comment-btn">
                        <x-comment-logo/>
                    </button>
                    <label class="text-sm mt-2 text-gray-800 dark:text-gray-200" for="comment-btn">{{ $post->comments->count() }}</label>
                    <x-collapsed id="comment-form-{{ $post->id }}">
                        <div>
                            <x-textarea name="content" id="comment-content-{{ $post->id }}" placeholder="Type something..." required />
                            <br>
                            <x-primary-button type="button" onclick="submitComment({{ $post->id }})">
                                Submit
                            </x-primary-button>
                            <x-danger-button onclick="toggleCommentForm({{ $post->id }}, false)" type="button">
                                Cancel
                            </x-danger-button>
                        </div>
                    </x-collapsed>
                </div>
                
            </x-grid>
            
        </section>
     </div>
</div>