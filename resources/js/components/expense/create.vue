<template>
    <div id="Create">
        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Expense</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="createExpense">
                                            <div class="form-floating mb-3">
                                                <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Expense Details</label>
                                                <textarea class="form-control" rows="3" v-model="form.details"></textarea>
                                                </div>
                                                <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                                                <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Amount" v-model="form.amount" />
                                                <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                                                <label>Amount</label>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary btn-block" type="submit">Create Expense</button>
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

                details: '',
                amount: ''
            },
            errors:{}
        }
    },

    methods:{

        createExpense()
        {
            let toast = useToast();

            axios.post('/api/expense', this.form)
            .then((response) => {
                this.$router.push('/expense-list');
                toast.success(response.data.message);
                console.log(response.data);
            })
            .catch((error) => {
                if (error.response && error.response.data && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                    toast.error('Expense Create Failed!');
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
