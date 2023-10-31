<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-500">
                    <p>Created at {{ $user->created_at }}</p>
                </div>
                @if($user->isVerified())
                <div class="text-green-300">
                    <p>verified</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>