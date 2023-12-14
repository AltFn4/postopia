<div class="fixed z-1 py-8 inset-x-0 top-0 w-full h-full overflow-auto bg-black bg-opacity-25 text-current" x-show="delete_open">
    <div class="m-auto bg-white dark:bg-gray-800 shadow sm:rounded-lg p-10 w-4/5">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Confirm
        </h2>
        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
            Are you sure that you want to delete this post?
        </p>
        <form action="/post" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="id" x-model="delete_id">
            <x-primary-button>
                confirm
            </x-primary-button>
            <x-danger-button type="button" @click="deleteClick(0)">
                cancel
            </x-danger-button>
        </form>
    </div>
</div>