<template>
    <div id="Index">
        <div class="container mt-5">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center my-4">Employee List</h3>
                    <div class="form-outline small-search-box" data-mdb-input-init>
                        <label class="form-label" for="form1">Search</label>
                        <div class="input-group">
                            <input type="search" id="form1" class="form-control small-input" v-model="searchTerm" placeholder="search phone or email"/>
                            <!-- <div class="input-group-append">
                                <button type="button" class="btn btn-success" data-mdb-ripple-init>
                                    <i class="fas fa-search"></i>
                                </button>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Salary</th>
                                        <th>NID</th>
                                        <th>Joining Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="employee in searchEmployee" :key="employee.id">
                                        <td>{{ employee.name }}</td>
                                        <td>
                                            <div v-if="employee.photo">
                                                <img :src="employee.photo" alt="Photo" class="img-thumbnail" style=" width: 100px; height: 100px;"/>
                                            </div>
                                            <div v-else>
                                                <i class="fas fa-user-circle" style=" font-size: 100px; color: #ccc;"></i>
                                            </div>
                                        </td>
                                        <td>{{ employee.email }}</td>
                                        <td>{{ employee.phone }}</td>
                                        <td>{{ employee.address }}</td>
                                        <td>{{ employee.salary }}</td>
                                        <td>{{ employee.nid }}</td>
                                        <td>{{ employee.joining_date }}</td>
                                        <td>
                                            <router-link class="btn btn-sm btn-primary btn-space" v-bind:to="`/employee-edit/${employee.id}`">Edit</router-link>
                                            <button class="btn btn-sm btn-danger" v-on:click="employeeDelete(employee.id)">Delete</button>
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
import axios from "axios";
import { useToast } from "vue-toastification";

export default {
    name: "Index",

    data() {
        return {
            employees: [],
            searchTerm: ''
        };
    },

    computed: {

        searchEmployee()
        {
            return this.employees.filter(employee => {
                return employee.phone.match(this.searchTerm) || employee.email.match(this.searchTerm);
            });
        }
    },

    methods: {
        employeeList()
        {
            axios.get("/api/employee")
            .then((response) => {
                this.employees = response.data.data;
            })
            .catch((error) => {
                console.error(error);
            });
        },

        employeeDelete(id)
        {
            const toast = useToast();

            axios.delete(`/api/employee/${id}`)
            .then((response) => {
                this.employeeList();
                toast.success(response.data.message);
                console.log(response.data.data);
                })
            .catch((error) => {
                console.error(error);
                toast.error(response.data.message);
            });
        },
    },

    mounted() {
        this.employeeList();
    },
};
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
