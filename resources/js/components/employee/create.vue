<template>
    <div id="Create">
        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Employee</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="createEmployee">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputName" type="text" placeholder="Full Name" v-model="form.name" />
                                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                                <label for="inputName">Full Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" v-model="form.email" />
                                                <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                                <label for="inputEmail">Email address</label>
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
                                                <input class="form-control" id="inputSalary" type="text" placeholder="Salary" v-model="form.salary" />
                                                <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                                                <label for="inputSalary">Salary</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputNid" type="text" placeholder="NID Number" v-model="form.nid" />
                                                <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
                                                <label for="inputNid">NID</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputJoiningDate" type="text" placeholder="Joining Date" v-model="form.joining_date" />
                                                <small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0] }}</small>
                                                <label for="inputJoiningDate">Joining Date</label>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary btn-block" type="submit">Create Employee</button>
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
            form:{

                name: '',
                email: '',
                phone: '',
                address: '',
                salary: '',
                nid: '',
                joining_date: ''
            },
            errors: {}
        };
    },

    methods:{

        createEmployee()
        {
            const toast = useToast();

            axios.post('/api/employee',this.form)
            .then((response) => {
                this.$router.push('/employee-list');
                toast.success(response.data.message);
                console.log(response.data);
            })
            .catch((error) => {
                if (error.response && error.response.data && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                    toast.error('Employee Create Failed!');
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
