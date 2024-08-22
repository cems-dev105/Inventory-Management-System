<template>
    <div id="Edit">
        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Category</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="updateCategory">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputName" type="text" placeholder="Full Name" v-model="editData.category_name"/>
                                                <label for="inputName">Category Name</label>
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
        return{
            editData: {
                category_name: ''
            },
            errors: {}
        }
    },

    methods: {

        editCategory()
        {
            axios.get(`/api/category/${this.$route.params.id}`)
            .then((response) => {
                this.editData = response.data.data;
            })
            .catch((error) => {
                console.error(error);
            });
        },

        updateCategory()
        {
            const toast = useToast();

            axios.patch(`/api/category/${this.$route.params.id}`,this.editData)
            .then((response) => {
                this.$router.push('/category-list');
                toast.success(response.data.message);
                console.log(response.data);
            })
            .catch((error) => {
                if(error.response && error.response.data && error.response.data.errors){
                    this.errors = error.response.data.errors;
                    toast.error(response.data.message);
                } else {
                    console.error(error);
                }
            });
        },

        cancelEdit()
        {
            this.$router.push('/category-list');
        }
    },

    mounted()
    {
        this.editCategory();
    }
}

</script>

<style scoped>

.btn-space{
    margin-right: 5px;
}

</style>
