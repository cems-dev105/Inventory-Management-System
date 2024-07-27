<template>
    <div id="Register">
        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="register">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputName" type="text" placeholder="your full name" v-model="form.name" />
                                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                                <label for="inputName">Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" v-model="form.email" />
                                                <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" placeholder="Create a password" v-model="form.password" />
                                                        <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="password" placeholder="Confirm password" v-model="form.password_confirmation" />
                                                        <label for="">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><router-link to="/">Have an account? Go to login</router-link></div>
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


export default{

    name: 'Register',

    data()
    {
        return {
            form:{

                name: '',
                email: '',
                password: '',
                confirm_password: ''
            },
            errors: {}
        };
    },

    methods:{

        register()
        {
            const toast = useToast();
            
            axios.post('/api/auth/register',this.form)
            .then((response) => {
                this.$router.push('/');
                toast.success('Successfully registered!!');
                console.log(response.data);
            })
            .catch((error) => {
            if (error.response && error.response.data && error.response.data.errors) {
                this.errors = error.response.data.errors;
                toast.error('Registerd failed!');
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

