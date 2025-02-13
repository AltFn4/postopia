<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <div class="flex flex-col justify-between gap-2">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $user->name }}
                </h2>
                <div class="flex flex-row justify-between">
                    @if($user->role->id !== 1)
                    <div class="bg-white text-gray-900 m-2 p-2 rounded shadow">
                        <p>{{ $user->role->name }}</p>
                    </div>
                    @endif
                    @if($user->email_verified_at !== NULL)
                    <div class="bg-green-700 text-white m-2 p-2 rounded shadow">
                        <p>verified</p>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="text-right">
                <div class="max-w-xl text-gray-500">
                    <p>Created at {{ $user->created_at }}</p>
                </div>
            </div>
        </div>
    </x-slot>
    <div  class="py-12 border-b border-gray-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div x-data="{ showPosts: true }">
                <!-- Navigation Bar -->
                <div class="flex flex-row p-2 sm:p-4 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
                    <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <button>
                            <x-nav-link @click="showPosts = true">
                                Posts
                            </x-nav-link>
                        </button>
                    </div>
                    <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <button>
                            <x-nav-link @click="showPosts = false">
                                Comments
                            </x-nav-link>    
                        </button>
                        
                    </div>
                </div>

                <!-- Content Section -->
                <div>
                    <div x-show="showPosts" class="flex flex-col gap-5 justify-between">
                        @foreach($user->posts as $post)
                        @include('post.partials.post')
                        @endforeach
                    </div>
                    <div x-show="!showPosts" class="flex flex-col gap-5 justify-between">
                        @foreach($user->comments as $comment)
                        @include('post.partials.comment')
                        @endforeach
                    </div>
                </div>    
            </div>
            
        </div>
    </div>
</x-app-layout>