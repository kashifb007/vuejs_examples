<x-layouts.main>

    <x-forms.header label="{{ __('Edit Profile') }}"/>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="{{ route('user-profile-information.update') }}">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    @csrf
                    @method('PUT')

                    <div class="col-span-6 py-2">
                        <x-forms.label label="{{ __('Name') }}" for="name"/>
                        <x-forms.input for="name" type="text"/>
                    </div>
                    <div class="col-span-6 py-2">
                        <x-forms.label label="{{ __('E-Mail Address') }}" for="email"/>
                        <x-forms.input for="email" type="email"/>
                    </div>

                    <div class="py-5 bg-white">
                        <x-forms.button label="{{ __('Update Profile') }}" type="submit"/>
                    </div>
                </div>
            </div>
        </form>
    </div>

</x-layouts.main>
