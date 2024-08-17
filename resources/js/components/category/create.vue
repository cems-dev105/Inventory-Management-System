<template>
    <div id="Create">
        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Category</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="createCategory">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputName" type="text" placeholder="Category Name" v-model="form.category_name" />
                                                <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
                                                <label for="inputName">Category Name</label>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary btn-block" type="submit">Create Category</button>
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
        return{
            form: {
                category_name: ''
            },
            errors: {}
        }
    },

    methods:{

        createCategory()
        {
            const toast = useToast();
            const formData = new FormData();

            for(const key in this.form)
            {
                formData.append(key, this.form[key])
            }

            axios.post('/api/category', formData)
            .then((response) => {
                this.$router.push('/category-list');
                toast.success(response.data.message);
                console.log(response.data);
            })
            .catch((error) => {
                if (error.response && error.response.data && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                    toast.error('Category Create Failed!');
                } else {
                    console.error(error);
                }
            });
        }
    }
}

</script>

<style scoped>

</style>
