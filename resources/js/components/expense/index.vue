<template>
    <div id="Index">
        <div class="container mt-5">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center my-4">Expense List</h3>
                    <div class="form-outline small-search-box" data-mdb-input-init>
                        <!-- <label class="form-label" for="form1">Search</label> -->
                        <div class="input-group">
                            <!-- <input type="search" id="form1" class="form-control small-input" v-model="searchTerm" placeholder="search category"/> -->
                            <!-- <div class="input-group-append">
                                <button type="button" class="btn btn-success" data-mdb-ripple-init>
                                    <i class="fas fa-search"></i>
                                </button>
                            </div> -->
                        </div><br>
                        <div>
                            <router-link to="/expense-create"><button class="btn btn-success">Add New</button></router-link>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="expense in expenses" :key="expense.id">
                                        <td>{{ expense.details }}</td>
                                        <td>{{ expense.amount }}</td>
                                        <td>{{ expense.date }}</td>
                                        <td>
                                            <router-link class="btn btn-sm btn-primary btn-space" v-bind:to="`/expense-edit/${expense.id}`">Edit</router-link>
                                            <button class="btn btn-sm btn-danger" v-on:click="expenseDelete(expense.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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

    name: "Index",

    data()
    {
        return {

            expenses: [],

        }
    },

    methods:{

        expenseList()
        {
            axios.get('/api/expense')
            .then((response) => {
                this.expenses = response.data.data;
                console.log(response.data.data);
            })
            .catch((error) => {
                console.log(error);
            });
        },

        expenseDelete(id)
        {
            const toast = useToast();

            axios.delete(`api/expense/${id}`)
            .then((response) => {
                this.expenseList();
                toast.success(response.data.message);
                console.log(response.data.data);
            })
            .catch((error) => {
                console.error(error);
                toast.error(response.data.message);
            });
        }

    },

    mounted()
    {
        this.expenseList();
    }

}

</script>

<style scoped>

.table-responsive {
    overflow-x: auto;
}
.table {
    background-color: #fff;
}
.table-hover tbody tr:hover {
    background-color: #f1f1f1;
}
.btn-space {
    margin-right: 5px;
}
.card {
    border-radius: 10px;
}
.card-header {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.img-thumbnail {
    object-fit: cover;
    border-radius: 5px;
}

.small-search-box {
    max-width: 330px; /* Adjust this value as needed */
    margin: auto;
}

.small-input {
    height: 40px; /* Adjust the height as needed */
    font-size: 14px; /* Adjust the font size as needed */
    padding: 5px 10px; /* Adjust the padding as needed */
}

.input-group-append .btn {
    margin-left: 5px; /* Adjust the space between the input and the button */
}

</style>
