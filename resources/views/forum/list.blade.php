<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Forum') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($posts as $post)
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('forum.partials.post')
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div style='justify-content: center; display: flex'>
        @if($page > 0)
            <a href="{{ route('forum', ['page' => $page - 1]) }}" class="p-4 text-gray-900 dark:text-gray-100">
                prev
            </a>
        @endif

        @for($i = 0; $i < $count; $i++)
            <a href="{{ route('forum', ['page' => $i]) }}" class="p-4 text-gray-900 dark:text-gray-100">
            @if($page == $i)
                <font color="#00FFFF">{{$i}}</font>
            @else
                {{$i}}
            @endif
            </a>
        @endfor

        @if($page < $count - 1)
            <a href="{{ route('forum', ['page' => $page + 1]) }}" class="p-4 text-gray-900 dark:text-gray-100">
                next
            </a>
        @endif
    </div>
</x-app-layout>