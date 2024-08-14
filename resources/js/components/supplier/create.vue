<template>
    <div id="Create">
        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Supplier</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="createSupplier">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputName" type="text" placeholder="Full Name" v-model="form.name" />
                                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                                <label for="inputName">Full Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" v-model="form.email" />
                                                <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                                <label for="inputEmail">Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPhone" type="text" placeholder="Phone" v-model="form.phone" />
                                                <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                                <label for="inputPhone">Phone</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputAddress" type="text" placeholder="Address" v-model="form.address" />
                                                <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                                <label for="inputAddress">Address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputShopName" type="text" placeholder="Shop Name" v-model="form.shopname" />
                                                <small class="text-danger" v-if="errors.shopname">{{ errors.shopname[0] }}</small>
                                                <label for="inputShopName">Shop Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPhoto" type="file" v-on:change="onPhotoChange" />
                                                <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                                                <label for="inputPhoto">Photo</label>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary btn-block" type="submit">Create Supplier</button>
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
            form:
            {
                name: '',
                email: '',
                phone: '',
                address: '',
                shopname: '',
                photo: ''
            },
            errors: {}
        }
    },

    methods:{

        onPhotoChange(event)
        {
            this.form.photo = event.target.files[0];
        },

        createSupplier()
        {
            const toast = useToast();
            const formData = new FormData();

            for(const key in this.form)
            {
                formData.append(key, this.form[key]);
            }

            axios.post('/api/supplier', formData)
            .then((response) => {
                this.$router.push('/supplier-list');
                toast.success(response.data.message);
                console.log(response.data);
            })
            .catch((error) => {
                if(error.response && error.response.data && error.response.data.errors){
                    this.errors = error.response.data.errors;
                    toast.error('Supplier Create Failed');
                }else {
                    console.error(error);
                }
            });
        }
    }
}

</script>

<style scoped>

</style>
