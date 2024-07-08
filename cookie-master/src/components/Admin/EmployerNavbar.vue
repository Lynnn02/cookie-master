<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <router-link class="navbar-brand mx-auto" to="/">JOBPORTAL</router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <router-link to="/admin/home" class="nav-link"><i class="fa fa-home"></i> Home</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/admin/createjob" class="nav-link"><i class="fa fa-plus-circle"></i> Create Job Posting</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/admin/managejobs" class="nav-link"><i class="fa fa-briefcase"></i> Manage Job Posts</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/admin/manageapplications" class="nav-link"><i class="fa fa-file"></i> Manage Applications</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/admin/profile" class="nav-link"><i class="fa fa-user"></i> Profile</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/admin/reviewlist" class="nav-link"><i class="fa fa-comments"></i> Review List</router-link>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/" @click.prevent="logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'EmployerNavbar',
  methods: {
    logout() {
      // Perform any logout logic here (like clearing tokens, etc.)
      localStorage.removeItem('user');
      this.$router.push({ name: 'HomePage' });
    },
  },
};
</script>

<style scoped>
.navbar-nav .nav-link {
  transition: color 0.3s ease-in-out, transform 0.3s;
}
.navbar-nav .nav-link:hover {
  color: #007bff; /* Bootstrap primary color */
  transform: translateY(-5px);
}
.navbar-brand {
  transition: transform 0.3s;
}
.navbar-brand:hover {
  transform: translateY(-5px);
}
</style>
