<script>
    // Function that uses Ajax to submit the comment on post of given id.
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
                // Clear the text area.
                $("#comment-content-" + post_id).val("");
                // Add the newly created comment.
                $("#comment-section").prepend(data);
            }
        });
    }
</script>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('post.partials.post')
            <div>
                <x-textarea name="content" id="comment-content-{{ $post->id }}" placeholder="Leave a comment here..." required />
                <x-primary-button type="button" onclick="submitComment({{ $post->id }})">
                    Submit
                </x-primary-button>
            </div>
            <div id="comment-section" class="flex flex-col justify-between gap-5">
                @foreach(collect($post->comments)->sortByDesc('created_at') as $comment)
                    @include('post.partials.comment')
                @endforeach
            </div>
            
        </div>
    </div>
</x-app-layout>