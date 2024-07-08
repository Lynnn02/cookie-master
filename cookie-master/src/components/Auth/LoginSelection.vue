<template>
  <div class="login-selection-container">
    <!-- Navbar with only the system title -->
    <nav class="navbar navbar-light bg-light mb-4">
      <span class="navbar-brand mx-auto h1">JOBPORTAL</span>
    </nav>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card login-card animate__animated animate__fadeIn animate__float" @click="redirectTo('applicant')">
            <div class="card-body text-center">
              <i class="fas fa-user-graduate fa-3x mb-3"></i>
              <h5 class="card-title">Applicant</h5>
              <p class="card-text">Login as an applicant to find and apply for jobs.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card login-card animate__animated animate__fadeIn animate__float" @click="redirectTo('employer')">
            <div class="card-body text-center">
              <i class="fas fa-building fa-3x mb-3"></i>
              <h5 class="card-title">Employer</h5>
              <p class="card-text">Login as an employer to post jobs and manage applications.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LoginSelection',
  methods: {
    redirectTo(role) {
      if (role === 'applicant') {
        this.$router.push('/applicant-login');
      } else if (role === 'employer') {
        this.$router.push('/employer-login');
      }
    },
  },
};
</script>

<style scoped>
@import 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css';
@import '@fortawesome/fontawesome-free/css/all.css';

.login-selection-container {
  max-width: 800px;
  margin: 50px auto;
  padding: 20px;
}
.login-card {
  padding: 20px;
  border: 1px solid #e0e0e0;
  border-radius: 10px;
  background-color: #ffffff;
  cursor: pointer;
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}
.login-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.text-center {
  text-align: center;
}
.navbar {
  border-bottom: 1px solid #e0e0e0;
  padding: 1rem 0;
}

@keyframes float {
  0% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
  100% {
    transform: translateY(0);
  }
}
</style>
