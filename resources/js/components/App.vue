<template>
  <div id="App">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" id="topbar" style="display: none;" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/password' ? false : true">
      <!-- Navbar Brand-->
      <router-link class="navbar-brand ps-3" to="/dashboard">Dashboard</router-link>
      <!-- Sidebar Toggle-->
      <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
      <!-- Navbar Search-->
      <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
          <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
          <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
      </form>
      <!-- Navbar-->
      <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#!">Settings</a></li>
            <li><a class="dropdown-item" href="#!">Activity Log</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><button class="dropdown-item" v-on:click="logout">Logout</button></li>
          </ul>
        </li>
      </ul>
    </nav>
    <div id="layoutSidenav">

      <div id="layoutSidenav_nav">

        <nav class="sb-sidenav accordion sb-sidenav-dark" id="leftbar" style="display: none;" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/password' ? false : true">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading">Core</div>
              <router-link class="nav-link" to="/dashboard">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
              </router-link>
              <div class="sb-sidenav-menu-heading">Interface</div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Employees
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <router-link class="nav-link" to="/employee-list">All Employee</router-link>
                  <router-link class="nav-link" to="/employee-create">Create Employee</router-link>
                  <!-- <router-link class="nav-link" to="/employee-edit">Edit Employee</router-link> -->
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#suppliercollapseLayouts" aria-expanded="false" aria-controls="suppliercollapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Suppliers
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="suppliercollapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <router-link class="nav-link" to="/supplier-list">All Supplier</router-link>
                  <router-link class="nav-link" to="/supplier-create">Create Supplier</router-link>
                  <!-- <router-link class="nav-link" to="/employee-edit">Edit Employee</router-link> -->
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#categorycollapseLayouts" aria-expanded="false" aria-controls="categorycollapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Categories
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="categorycollapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <router-link class="nav-link" to="/category-list">All Category</router-link>
                  <router-link class="nav-link" to="/category-create">Create Category</router-link>
                  <!-- <router-link class="nav-link" to="/employee-edit">Edit Employee</router-link> -->
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#productcollapseLayouts" aria-expanded="false" aria-controls="productcollapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Products
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="productcollapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <router-link class="nav-link" to="/product-list">All Product</router-link>
                  <router-link class="nav-link" to="/product-create">Create Product</router-link>
                  <!-- <router-link class="nav-link" to="/employee-edit">Edit Employee</router-link> -->
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Pages
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                    Authentication
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="login.html">Login</a>
                      <a class="nav-link" href="register.html">Register</a>
                      <a class="nav-link" href="password.html">Forgot Password</a>
                    </nav>
                  </div>
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                    Error
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="401.html">401 Page</a>
                      <a class="nav-link" href="404.html">404 Page</a>
                      <a class="nav-link" href="500.html">500 Page</a>
                    </nav>
                  </div>
                </nav>
              </div>
              <div class="sb-sidenav-menu-heading">Addons</div>
              <a class="nav-link" href="charts.html">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Charts
              </a>
              <a class="nav-link" href="tables.html">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tables
              </a>
            </div>
          </div>
          <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Saqlain
          </div>
        </nav>
      </div>
      <div id="layoutSidenav_content">

        <router-view></router-view>

      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import $ from 'jquery';
import { useToast } from 'vue-toastification';


export default {

  name: 'App',

  data()
  {
    return {};
  },

  methods:{

    logout()
    {
        const toast = useToast();

        axios.post('/api/auth/logout', {}, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
        })
        .then((response) => {
            localStorage.removeItem('token');
            this.$router.push('/');
            toast.success('Successfully logged out');
            console.log(response.data);
        })
        .catch(error => {
            console.error(error);
            toast.error('Error logging out');
        });
    },

    mounted() {
    this.$nextTick(() => {
      var token = localStorage.getItem('token');
      if (token) {
        $("#topbar").css("display", "block");
        $("#leftbar").css("display", "block");
      } else {
        this.$router.push('/');
      }
    });
  }
  }

};

</script>

<style scoped>
h1 {
  text-align: center;
  color: crimson;
}
</style>
