<template>
    <div id="Edit">
        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Expense</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="updateExpense">
                                            <div class="form-floating mb-3">
                                                <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Expense Details</label>
                                                <textarea class="form-control" rows="3" v-model="editData.details"></textarea>
                                                </div>
                                                <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                                                <div class="form-floating mb-3">
                                                <input class="form-control" type="text" placeholder="Amount" v-model="editData.amount" />
                                                <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                                                <label>Amount</label>
                                                </div>
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

            editData:{

                details: '',
                amount: ''
            },
            errors:{}

        }
    },

    methods:{

        editExpense()
        {
            axios.get(`/api/expense/${this.$route.params.id}`)
            .then((response) => {
                this.editData = response.data.data;
                console.log(response.data);
            })
            .catch((error) => {
                console.error(error);
            });
        },

        updateExpense()
        {
            const toast = useToast();

            axios.patch(`/api/expense/${this.$route.params.id}`,this.editData)
            .then((response) => {
                this.$router.push('/expense-list');
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
            this.$router.push('/expense-list');
        }
    },

    mounted()
    {
        this.editExpense();
    }

}

</script>

<style scoped>

.btn-space{
    margin-right: 5px;
}

</style>
