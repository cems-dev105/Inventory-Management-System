<template>
    <div id="Create">
        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Product</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="createProduct">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Product Name" v-model="form.product_name" />
                                                <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                                                <label>Product Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Product Code" v-model="form.product_code" />
                                                <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                                                <label>Product Code</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-control" v-model="form.category_id">
                                                    <option value="" disabled>Select Category</option>
                                                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
                                                </select>
                                                <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                                                <label>Category</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-control" v-model="form.supplier_id">
                                                    <option value="" disabled>Select Supplier</option>
                                                    <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{ supplier.name }}</option>
                                                </select>
                                                <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                                                <label>Supplier</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Root" v-model="form.root" />
                                                <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                                                <label for="inputSalary">Root</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Buying Price" v-model="form.buying_price" />
                                                <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                                                <label>Buying Price</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Selling Price" v-model="form.selling_price" />
                                                <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                                                <label>Selling Price</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="date" placeholder="Buying Date" v-model="form.buying_date" />
                                                <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                                                <label>Buying Date</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Product Quantity" v-model="form.product_quantity" />
                                                <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                                <label>Product Quantity</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="file" v-on:change="onPhotoChange" />
                                                <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                                                <label for="inputPhoto">Image</label>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary btn-block" type="submit">Create Product</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toastification';


export default {

    name: "Create",

    data()
    {
        return {
            form: {
                product_name: '',
                product_code: '',
                category_id: '',
                supplier_id: '',
                root: '',
                buying_price: '',
                selling_price: '',
                buying_date: '',
                product_quantity: '',
                image: null
            },
            errors: {},
            categories: {},
            suppliers: {}
        }
    },

    methods:{

        onPhotoChange(event) {
            this.form.image = event.target.files[0];
        },

        createProduct()
        {
            const toast = useToast();
            const formData = new FormData();

            for(const key in this.form)
            {
                formData.append(key, this.form[key]);
            }

            axios.post('/api/product', formData)
            .then((response) => {
                this.$router.push('/product-list');
                toast.success(response.data.message);
                console.log(response.data);
            })
            .catch((error) => {
                if (error.response && error.response.data && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                    toast.error('Product Create Failed!');
                } else {
                    console.error(error);
                }
            });
        }

    },

    mounted()
    {
        axios.get('/api/category')
        .then((response) => {
            this.categories = response.data.data;
        })
        .catch((error) => {
            console.error(error);
        });

        axios.get('/api/supplier')
        .then((response) => {
            this.suppliers = response.data.data;
        })
        .catch((error) => {
            console.error(error);
        });
    }
}

</script>

<style scoped>

</style>
