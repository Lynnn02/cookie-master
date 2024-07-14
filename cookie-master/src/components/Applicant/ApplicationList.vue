<template>
  <div class="application-list-container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <router-link class="navbar-brand mx-auto" to="/">JOBPORTAL</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link to="/joblist" class="nav-link">Job List</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/applicationlist" class="nav-link">Application List</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/updateprofile" class="nav-link">Profile</router-link>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="/" @click.prevent="logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Application List -->
    <div class="container mt-4">
      <h3>Your Applications</h3>
      <div v-if="filteredApplications.length">
        <div class="card mb-3" v-for="application in filteredApplications" :key="application.id">
          <div class="card-body">
            <h5 class="card-title">Job ID: {{ application.jobId }}</h5>
            <p class="card-text">Applicant Name: {{ application.applicantName }}</p>
            <p class="card-text">Applicant Email: {{ application.applicantEmail }}</p>
            <p class="card-text">Introduction: {{ application.introduction }}</p>
            <p class="card-text">Resume: {{ application.resume }}</p>
            <p class="card-text">Status: {{ application.status }}</p>
            <button class="btn btn-danger" @click="cancelApplication(application.id)">Cancel Application</button>
            <button class="btn btn-success" @click="updateApplication(application.id)">Edit Application</button>
          </div>
        </div>
      </div>
      <div v-else>
        <p>No applications found.</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ApplicationList',
  data() {
    return {
      applications: [],
      currentUser: null,
    };
  },
  computed: {
    filteredApplications() {
      return this.applications.filter(app => app.userId === this.currentUser.id);
    },
  },
  async created() {
    this.fetchCurrentUser();
    await this.fetchApplications();
  },
  methods: {
    fetchCurrentUser() {
      const user = localStorage.getItem('currentUser');
      if (user) {
        this.currentUser = JSON.parse(user);
        console.log('Current user:', this.currentUser); // Debugging statement
      } else {
        console.error('User not found in local storage');
        alert('User not found. Please log in.');
        //this.$router.push({ name: 'HomePage' });
      }
    },
    async fetchApplications() {
      if (!this.currentUser) {
        return;
      }
      try {
        const response = await axios.get('http://localhost:8088/applications', { params: { userId: this.currentUser.id } });
        console.log('Response data:', response.data); // Debugging statement
        this.applications = response.data.applications;
        console.log('Applications:', this.applications); // Debugging statement
      } catch (error) {
        console.error('Error fetching applications:', error);
      }
    },
    async cancelApplication(applicationId) {
      try {
        await axios.delete(`http://localhost:8088/applications/${applicationId}`);
        this.applications = this.applications.filter(app => app.id !== applicationId);
        alert('Application canceled.');
      } catch (error) {
        console.error('Error canceling application:', error);
        alert('Failed to cancel application.');
      }
    },
    updateApplication(applicationId) {
      this.$router.push({ name: 'UpdateApplication', params: { id: applicationId } });
    },
    logout() {
      localStorage.removeItem('currentUser');
      this.$router.push({ name: 'HomePage' });
    },
  },
};
</script>

<style scoped>
.application-list-container {
  text-align: left;
}
.card {
  margin-bottom: 1rem;
}
.navbar-nav .nav-link {
  transition: color 0.3s ease-in-out;
}
.navbar-nav .nav-link:hover {
  color: #007bff; /* Bootstrap primary color */
}
</style>
