<nav class="bg-white mb-8">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button -->
                <button aria-controls="mobile-menu"
                        aria-expanded="false"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        type="button">
                    <span class="sr-only">Open main menu</span>
                    <!--
                      Icon when menu is closed.

                      Heroicon name: outline/menu

                      Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg aria-hidden="true" class="block h-6 w-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"/>
                    </svg>
                    <!--
                      Icon when menu is open.

                      Heroicon name: outline/x

                      Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg aria-hidden="true" class="hidden h-6 w-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0 flex items-center">
                    <img alt="59club" class="block lg:hidden h-8 w-auto"
                         src="{{ asset('images/59club-logo-2019.png') }}">
                    <img alt="59club" class="hidden lg:block h-8 w-auto"
                         src="{{ asset('images/59club-logo-2019.png') }}">
                </div>
                <div class="hidden sm:ml-12 sm:flex sm:space-x-8">
                    {{ $slot }}
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <button
                    class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    type="button">
                    <span class="sr-only">View notifications</span>
                    <!-- Heroicon name: outline/bell -->
                    <svg aria-hidden="true" class="h-6 w-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                            stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"/>
                    </svg>
                </button>

                <!-- Profile dropdown -->
                <div class="ml-3 relative" x-cloak x-data="{ open: false }">
                    <div>
                        <button aria-expanded="false" aria-haspopup="true"
                                class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                id="user-menu-button" type="button" x-on:click="open = ! open">
                            <span class="sr-only">Open user menu</span>
                            <img alt=""
                                 class="h-8 w-8 rounded-full"
                                 src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80">
                        </button>
                    </div>

                    <!--
                      Dropdown menu, show/hide based on menu state.

                      Entering: "transition ease-out duration-200"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
                    <div aria-labelledby="user-menu-button" aria-orientation="vertical"
                         class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                         role="menu"
                         tabindex="-1" x-on:click.outside="open = false" x-show="open" x-transition>
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                        <a class="block px-4 py-2 text-sm text-gray-700" href="#" id="user-menu-item-0" role="menuitem"
                           tabindex="-1">Your Profile</a>
                        @auth()
                            <x-form.form :action="route('logout')" method="post">
                                <button class="px-4 py-2 text-sm text-gray-700"
                                        type="submit">{{ __('Sign out') }}</button>
                            </x-form.form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden">
        <div class="pt-2 pb-4 space-y-1">
            {{ $slot }}
        </div>
    </div>
</nav>
