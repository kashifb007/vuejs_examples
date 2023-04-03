<template>
    <tr class="bg-white hover:bg-gray-100">
        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
            <input v-if="edit" v-model="nameInput"
                   @blur="edit=false; editProduct($props.id, nameInput)"
                   @keyup.enter="edit=false; editProduct($props.id, nameInput)"
                   v-focus
                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            <div v-else>
                <label @click="edit=true;">{{ name }}</label>
            </div>
        </td>
        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
            <a :href="'/admin/products/' + $props.id"
               class="text-indigo-600 hover:text-indigo-900">Edit Components<span
                class="sr-only">, {{ name }}</span></a>
        </td>
        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
            <input type="hidden" name="_token" :value="csrf">
            <button class="text-indigo-600 hover:text-indigo-900"
                    onclick="return confirm('Are you sure you want to delete this product?');"
                    type="button"
                    v-on:click="deleteProduct($props.id, index)"
            >Delete
            </button>
        </td>
    </tr>
</template>
<script>
export default {
    computed: {
        nameInput: {
            get: function () {
                return this.name;
            },
            set: function (newValue) {
                if(newValue.length >= 3 && newValue.length <= 255) {
                    this.$emit('update:name', newValue);
                    this.$emit('successUpdate');
                } else {
                    this.$emit('errorMessage','Name must be at least 3 characters');
                }
            }
        },
    },
    props: {
        id: {
            type: Number,
            default: 1,
            required: false,
        },
        name: {
            type: String,
            default: '',
            required: true,
        },
        index: {
            type: Number,
            default: 0,
            required: true,
        },
    },
    data() {
        return {
            edit: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    methods: {
        editProduct(id, newValue) {
            let formData = new FormData();
            formData.append('name', newValue);
            formData.append('_method', 'PUT');
            let action = '/admin/products/' + id;

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
                error: function (data) {
                    let errors = (data.responseJSON) ? data.responseJSON.errors : [];

                    $.each(errors, (key, value) => {
                        this.$emit('errorMessage',value[0]);
                    });
                }
            });
        },
        deleteProduct(id, index) {
            let formData = new FormData();
            formData.append('id', id);
            let action = '/admin/products/' + id;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'DELETE',
                url: action,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    this.$emit('deleteProduct', index);
                }.bind(this),
                error: function (data) {
                    let errors = (data.responseJSON) ? data.responseJSON.errors : [];

                    $.each(errors, (key, value) => {
                        this.$emit('errorMessage',value[0]);
                    });
                }
            });
        },
    },
    directives: {
        focus: {
            inserted(el) {
                el.focus()
            }
        }
    }
}
</script>
