<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $user->name }}
            </h2>
            <div class="text-right">
                <div class="max-w-xl text-gray-500">
                    <p>Created at {{ $user->created_at }}</p>
                </div>
                @if($user->email_verified_at !== NULL)
                <div class="text-green-300">
                    <p>verified</p>
                </div>
                @endif    
            </div>
        </div>
    </x-slot>
    <div  class="py-12 border-b border-gray-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div x-data="{ active: true }">
                <!-- Navigation Bar -->
                <div class="flex flex-row p-2 sm:p-4 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <button @click="active = true">
                            Posts
                        </button>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <button @click="active = false">
                            Comments
                        </button>
                    </div>
                </div>

                <!-- Content Section -->
                <div>
                    <div x-show="active" class="flex flex-col gap-5 justify-between">
                        @foreach(Auth::user()->posts as $post)
                        @include('post.partials.post')
                        @endforeach
                    </div>
                    <div x-show="!active" class="flex flex-col gap-5 justify-between">
                        @foreach(Auth::user()->comments as $comment)
                        @include('post.partials.comment')
                        @endforeach
                    </div>
                </div>    
            </div>
            
        </div>
    </div>
</x-app-layout>