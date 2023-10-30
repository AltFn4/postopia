<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @include('post.partials.post')
        @foreach($post->comments as $comment)
            @include('post.partials.comment')
        @endforeach
        </div>
    </div>
</x-app-layout>