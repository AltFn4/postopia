<div class="p-6 bg-gray-700 rounded">
    <a href="{{ route('profile.show', ['id' => $comment->user->id ]) }}" class="text-sm mt-2 text-gray-800 dark:text-gray-200" style="font:italic">
        <u>
            {{ $comment->user->name }}
        </u>
    </a>
    <div>
        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
            {{ $comment->content }}
        </p>
    </div>
</div>