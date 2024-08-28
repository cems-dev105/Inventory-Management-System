<template>
    <div id="Edit">
        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Product</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="updateProduct">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Product Name" v-model="editData.product_name" />
                                                <label>Product Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Product Code" v-model="editData.product_code" />
                                                <label>Product Code</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-control" v-model="editData.category_id">
                                                    <option value="" disabled>Select Category</option>
                                                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
                                                </select>
                                                <label>Category</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-control" v-model="editData.supplier_id">
                                                    <option value="" disabled>Select Supplier</option>
                                                    <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{ supplier.name }}</option>
                                                </select>
                                                <label>Supplier</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Root" v-model="editData.root" />
                                                <label for="inputSalary">Root</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Buying Price" v-model="editData.buying_price" />
                                                <label>Buying Price</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Selling Price" v-model="editData.selling_price" />
                                                <label>Selling Price</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="date" placeholder="Buying Date" v-model="editData.buying_date" />
                                                <label>Buying Date</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Product Quantity" v-model="editData.product_quantity" />
                                                <label>Product Quantity</label>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-flex">
                                                    <button class="btn btn-success btn-block btn-space" type="submit">Update</button>
                                                    <button class="btn btn-primary btn-block" type="button" v-on:click="cancelEdit">Cancel</button>
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
import { error } from 'jquery';


export default {
    name: "Edit",

    data()
    {
        return {

            editData: {

                product_name: '',
                product_code: '',
                category_id: '',
                supplier_id: '',
                root: '',
                buying_price: '',
                selling_price: '',
                buying_date: '',
                product_quantity: '',
            },
            errors: {},
            categories: {},
            suppliers: {}
        }
    },

    methods:{

        editProduct()
        {
            axios.get(`/api/product/${this.$route.params.id}`)
            .then((response) => {
                let data = this.editData = response.data.data;
                console.log(data);
            })
            .catch((error) => {
                console.log(error);
            })
        },

        updateProduct()
        {
            alert('test');
        },

        cancelEdit()
        {
            this.$router.push('/product-list');
        }

    },

    mounted()
    {
        this.editProduct();

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

.btn-space{
    margin-right: 5px;
}

</style>
