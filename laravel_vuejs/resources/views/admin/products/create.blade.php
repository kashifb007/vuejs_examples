<x-layouts.main>

    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">{{ __('Create Product') }}</h2>
        </div>

        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <x-form.form action="{{ route('admin.products.store') }}" class="space-y-6" method="post">
                    <div class="pb-5 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Product Info</h3>
                    </div>

                    <div>
                        <x-form.input for="name" required type="text" value="{{ old('name') }}"/>
                    </div>

                    <div>
                        <x-form.button type="submit">{{ __('Create') }}</x-form.button>
                    </div>
                </x-form.form>
            </div>
        </div>
    </div>

</x-layouts.main>
