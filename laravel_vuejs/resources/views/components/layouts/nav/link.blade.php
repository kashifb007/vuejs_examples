@props([
    'route'
])

<a class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium sm:border-l-0 sm:inline-flex sm:hover:bg-transparent sm:hover:border-gray-300 sm:hover:text-gray-700 sm:hover:border-l-0 sm:items-center sm:px-1 sm:pt-1 sm:border-b-2 sm:text-sm"
   href="{{ $route }}">{{ $slot }}</a>
