<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(){
      if ({{ Auth::check() }}) {
        var user_id = "{{ Auth::user()->id }}";
        var notification_list = document.getElementById("notification-list");

        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
          cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
        });

        var channel = pusher.subscribe('channel-' + user_id);
        channel.bind('notify', function(data) {
            var message = data.message;
            var url = data.url;
            var nid = data.id;
            
            var div = document.createElement('div');
            var a = document.createElement('a');
            var link = document.createTextNode(message);
            var btn = document.createElement('button');
            
            a.href = url;
            a.className = "block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out";
            a.appendChild(link);
            div.appendChild(a);
            div.appendChild(btn);
            notification_list.appendChild(div);
            
            btn.type = "button";
            btn.onclick = function() { destroyNotification(nid) };
            btn.innerHTML = '<svg width="10px" height="10px" viewBox="151.3 133.019 214.757 224.128" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}><path style="stroke-width: 50px; fill: rgb(255, 255, 255); stroke: rgb(255, 255, 255);" d="M 157.234 133.019 L 349.254 357.147" transform="matrix(0.9999999999999999, 0, 0, 0.9999999999999999, -5.684341886080802e-14, -2.842170943040401e-14)"/><path style="stroke-width: 50px; fill: rgb(255, 255, 255); stroke: rgb(255, 255, 255);" d="M 366.057 135.009 L 151.3 352.95" transform="matrix(0.9999999999999999, 0, 0, 0.9999999999999999, -5.684341886080802e-14, -2.842170943040401e-14)"/></svg>';
        });
      }
    });

    function destroyNotification(id) {
        var notification = $('#notification-' + id);
        $.ajax({
            url: '{{ route('notification.destroy', ['id' => '']) }}' + id,
            type: 'DELETE',
            data: {'_token': '{{ csrf_token() }}',},
            success: function(data) {
                if (data.success) {
                    notification.remove();
                }
            }
        });
    }
</script>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 fill-current text-congo_pink-600"/>
                        <p class="text-deep_peach-600">Postopia</p>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('forum')" :active="request()->routeIs('forum')">
                        {{ __('Forum') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex">
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <x-notification-logo width="20px" height="20px"/>
                            </button>
                        </x-slot>
                        <x-slot name="content" class="p-5 w-64 h-80 sm:flex sm:items-center">
                            <div class="text-white m-2">
                                {{ __('Notification') }}
                            </div>
                            <hr>
                            <div class="overflow-auto h-80" id="notification-list">
                                @foreach(Auth::user()->notifications as $notification)
                                <div id="notification-{{ $notification->id }}">
                                    <x-dropdown-link :href="route('post.show', ['id' => $notification->comment->post->id])">
                                        {{ $notification->comment->user->name }} has left a comment on your post {{ $notification->comment->post->title}} : "{{ $notification->comment->content }}"
                                    </x-dropdown-link>
                                    <button type="button" onclick="destroyNotification({{ $notification->id }})">
                                        <x-destroy-logo width="10px" height="10px"/>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': active, 'inline-flex': ! active }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! active, 'inline-flex': active }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('forum')" :active="request()->routeIs('forum')">
                {{ __('Forum') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ __('Notification') }}</div>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
