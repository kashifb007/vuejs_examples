<template>
    <div>
        <form id="createComponentForm" action="/admin/components" @submit.prevent="addComponent">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="product_id" :value="product_id">
            <div class="flex justify-between">
                <div class="flex">
                    <input type="text" name="name" id="name" v-model="newComponent" class="m-4 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    <button class="m-4 flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="submit">Add Component</button>
                    <div class="invalid-feedback mt-4 text-red-700"></div>
                </div>
                <input type="text" name="search" id="search" class="m-4 block justify-self-end rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Search" v-on:input="debounceInput" />
            </div>
        </form>
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col"
                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                    Name
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Edit</span>
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Delete</span>
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
            <product-component
                v-for="(component, index) in filteredComponents"
                :key="component.id"
                v-bind:name="component.name"
                v-bind:id="component.id"
                v-bind:index="index"
                v-bind:product_id="product_id"
                v-on:deleteComponent="deleteComponent"
                v-on:errorMessage="errorMessage"
                v-on:successUpdate="successUpdate"
                :name.sync="component.name"
            ></product-component>
            <tr class="bg-white hover:bg-gray-100" v-if="!filteredComponents.length">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6" colspan="3">No
                    components found.
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import ProductComponent from './ProductComponent.vue';

export default {
    name : 'ComponentList',
    props: {
        product_id: '',
    },
    data() {
        return {
            message: '',
            newComponent: '',
            query: '',
            components: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    computed: {
        filteredComponents() {
            return this.components.filter((component) => {
                return component.name.toLowerCase().includes(this.query.toLowerCase());
            })
        }
    },
    components: {
        ProductComponent
    },
    mounted() {
        axios.get('/admin/components/json_index/' + this.product_id).then(response => this.components = response.data.components);
    },
    methods: {
        addComponent(evt) {

            evt.preventDefault();

            let form = $('#createComponentForm');
            let formData = new FormData(form[0]);
            let action = form.attr('action');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: action,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success: function(data) {
                    this.components.push({'id': data.id, 'name': this.newComponent});
                    this.newComponent = '';
                }.bind(this),
                error: function(data) {
                    let errors = (data.responseJSON) ? data.responseJSON.errors : [];

                    $.each(errors, (key, value) => {
                        $(form).find('[name="' + key + '"], [name="' + key + '[]"]').parent().find('.invalid-feedback').text(value[0]);
                    });
                }
            });
        },
        debounceInput: _.debounce(function (e) {
            this.query = e.target.value;
        }, 1500),
        deleteComponent(index) {
            this.components.splice(index, 1);
        },
        errorMessage(error) {
            let form = $('#createComponentForm');
            $(form).find('[name="name"], [name="name[]"]').parent().find('.invalid-feedback').text(error);
        },
        successUpdate() {
            let form = $('#createComponentForm');
            $(form).find('[name="name"], [name="name[]"]').parent().find('.invalid-feedback').text('');
        }
    },
}
</script>
