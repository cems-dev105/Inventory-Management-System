<template>
    <div id="Edit">
        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Supplier</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="updateSupplier">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputName" type="text" placeholder="Full Name" v-model="editData.name"/>
                                                <label for="inputName">Full Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" v-model="editData.email"/>
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPhone" type="text" placeholder="Phone" v-model="editData.phone"/>
                                                <label for="inputPhone">Phone</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputAddress" type="text" placeholder="Address" v-model="editData.address"/>
                                                <label for="inputAddress">Address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputShopname" type="text" placeholder="Shopname" v-model="editData.shopname"/>
                                                <label for="inputShopname">Shop Name</label>
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
import { useToast } from 'vue-toastification';

export default {
    name: "Edit",

    data()
    {
        return {
            editData: {

                name: '',
                email: '',
                phone: '',
                address: '',
                shopname: ''

            },
            errors: {}
        }
    },

    methods: {

        editSupplier()
        {
            axios.get(`/api/supplier/${this.$route.params.id}`)
            .then((response) => {
                this.editData = response.data.data;
                console.log(response.data.message);
            })
            .catch((error) => {
                console.error(error);
            });
        },

        updateSupplier()
        {
            const toast = useToast();

            axios.patch(`/api/supplier/${this.$route.params.id}`, this.editData)
            .then((response) => {
                this.$router.push('/supplier-list');
                toast.success(response.data.message);
                console.log(response.data);
            })
            .catch((error) => {
                    if (error.response && error.response.data && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                        toast.error(response.data.message);
                    } else {
                        console.error(error);
                    }
                });
        },

        cancelEdit()
        {
            this.$router.push("/supplier-list");
        }


    },

    mounted()
    {
        this.editSupplier();
    }
}
</script>

<style scoped>

.btn-space{
    margin-right: 5px;
}

</style>
