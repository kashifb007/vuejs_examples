<x-layouts.main>

    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">{{ $product->name }} {{ __('Components') }}</h2>
        </div>

        @if(session()->has('message'))
            <div>
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg" id="app">
                            <component-list
                                v-bind:product_id="{{ $product->id }}"
                            ></component-list>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.main>
