<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('post.create') }}" class="mt-6 space-y-6"  enctype="multipart/form-data">
        @csrf
        @method('post')

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div x-data="{ tag_ids: [], select (id) {
            if (this.tag_ids.includes(id)) {
                this.tag_ids.splice(this.tag_ids.indexOf(id), 1);
            } else {
                this.tag_ids.push(id);
            }
        } }">
            <x-input-label for="tags" :value="__('Tags')" />
            <input type="hidden" name="tag_ids" x-model="JSON.stringify(tag_ids)" readonly>

            <div name="tags" class="overflow-x-auto flex flex-row gap-2">
                @foreach( $tags as $tag )
                <button type="button" @click="select({{ $tag->id }})" style="background-color: {{ $tag->colour }}" :class="{'opacity-100 border border-white border-2': tag_ids.includes({{ $tag->id }}), 'opacity-25': ! tag_ids.includes({{ $tag->id }})}" class="text-sm text-center rounded-lg shadow">
                    {{ $tag->name }}
                </button>
                @endforeach
            </div>
        </div>

        <div>
            <x-input-label for="content" :value="__('Content')" />
            <x-textarea id="content" name="content" type="text" class="mt-1 block w-full" required/>
            <x-file-upload-logo/>
            <input type="file" name="files[]" accept="images/*" multiple/>
            <x-input-error :messages="$errors->get('files.0')" class="mt-2" />

            @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>

            @if (session('status') === 'post-created')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Created.') }}</p>
            @endif
        </div>
    </form>
</section>
