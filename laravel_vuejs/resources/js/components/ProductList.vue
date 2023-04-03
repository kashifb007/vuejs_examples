<template>
    <div>
        <form id="createProductForm" action="/admin/products" @submit.prevent="addProduct">
            <input type="hidden" name="_token" :value="csrf">
            <div class="flex justify-between">
                <div class="flex">
                    <input type="text"
                           name="name"
                           id="name"
                           v-model="newProduct"
                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md m-4"/>
                    <button
                        class="m-4 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        type="submit"
                    >Add Product
                    </button>
                    <div class="invalid-feedback text-red-700 mt-4">
                    </div>
                </div>
                <input type="text" name="search" id="search"
                       class="m-4 block justify-self-end rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                       placeholder="Search" v-on:input="debounceInput"/>
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
            <product
                v-for="(product, index) in filteredProducts"
                :key="product.id"
                v-bind:name="product.name"
                v-bind:id="product.id"
                v-bind:index="index"
                v-on:deleteProduct="deleteProduct"
                v-on:errorMessage="errorMessage"
                v-on:successUpdate="successUpdate"
                :name.sync="product.name"
            ></product>
            <tr class="bg-white hover:bg-gray-100" v-if="!filteredProducts.length">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6" colspan="3">No
                    products found.
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import Product from './Product.vue';

export default {
    name : 'ProductList',
    data() {
        return {
            message: '',
            newProduct: '',
            query: '',
            products: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    computed: {
        filteredProducts() {
            return this.products.filter((product) => {
                return product.name.toLowerCase().includes(this.query.toLowerCase());
            })
        }
    },
    components: {
        Product
    },
    mounted() {
        axios.get('/admin/product/json_index').then(response => this.products = response.data.products);
    },
    methods: {
        addProduct(evt) {

            evt.preventDefault();

            let form = $('#createProductForm');
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

                success: function (data) {
                    this.products.push({'id': data.id, 'name': this.newProduct});
                    this.newProduct = '';
                }.bind(this),
                error: function (data) {
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
        deleteProduct(index) {
            this.products.splice(index, 1);
        },
        errorMessage(error) {
            let form = $('#createProductForm');
            $(form).find('[name="name"], [name="name[]"]').parent().find('.invalid-feedback').text(error);
        },
        successUpdate() {
            let form = $('#createProductForm');
            $(form).find('[name="name"], [name="name[]"]').parent().find('.invalid-feedback').text('');
        }
    },
}
</script>
