<template>
  <div class="employer-home">
    <!-- Navbar -->
    <EmployerNavbar />

 
    <!-- Main Content -->
    <div class="container mt-4">
      <h2 class="animate__animated animate__fadeInUp">Welcome, Employer!</h2>
      <div class="row mt-4">
        <div class="col-md-6 mb-4">
          <router-link to="/admin/createjob" class="card-link">
            <div class="card animate__animated animate__zoomIn">
              <div class="card-body">
                <h5 class="card-title"><i class="fa fa-plus"></i> Create Job Post</h5>
                <p class="card-text">Post a new job to find suitable candidates.</p>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-md-6 mb-4">
          <router-link to="/admin/managejobs" class="card-link">
            <div class="card animate__animated animate__zoomIn">
              <div class="card-body">
                <h5 class="card-title"><i class="fa fa-briefcase"></i> Manage Job Posts</h5>
                <p class="card-text">View and manage your job postings.</p>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-md-6 mb-4">
          <router-link to="/admin/manageapplications" class="card-link">
            <div class="card animate__animated animate__zoomIn">
              <div class="card-body">
                <h5 class="card-title"><i class="fa fa-users"></i> Manage Applications</h5>
                <p class="card-text">Review applications from potential candidates.</p>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-md-6 mb-4">
          <router-link to="/admin/profile" class="card-link">
            <div class="card animate__animated animate__zoomIn">
              <div class="card-body">
                <h5 class="card-title"><i class="fa fa-user"></i> Profile</h5>
                <p class="card-text">Update your profile information.</p>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-md-6 mb-4">
          <router-link to="/admin/reviewlist" class="card-link">
            <div class="card animate__animated animate__zoomIn">
              <div class="card-body">
                <h5 class="card-title"><i class="fa fa-star"></i> Review List</h5>
                <p class="card-text">View reviews on your company.</p>
              </div>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import EmployerNavbar from './EmployerNavbar.vue';

export default {
  name: 'EmployerHome',
  components: {
    EmployerNavbar,
  },
};
</script>

<style scoped>
.employer-home {
  text-align: center;
}
.card {
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
  margin-bottom: 1rem; /* Add margin between cards */
}
.card:hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
.card-link {
  text-decoration: none;
  color: inherit;
}
.animate__animated {
  animation-duration: 0.5s;
}
</style>