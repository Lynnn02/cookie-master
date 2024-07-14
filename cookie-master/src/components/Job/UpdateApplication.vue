<template>
  <div class="edit-application-container">
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

    <!-- Edit Application -->
    <div class="container mt-4">
      <h3>Edit Application</h3>
      <form @submit.prevent="updateApplication">
        <div class="form-group">
          <label for="applicantName">Applicant Name</label>
          <input type="text" id="applicantName" v-model="applicantName" class="form-control" required />
        </div>
        <div class="form-group">
          <label for="applicantEmail">Applicant Email</label>
          <input type="email" id="applicantEmail" v-model="applicantEmail" class="form-control" required />
        </div>
        <div class="form-group">
          <label for="introduction">Introduction</label>
          <textarea id="introduction" v-model="introduction" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Application</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'EditApplication',
  props: ['id'],
  data() {
    return {
      applicationId: parseInt(this.id),
      applicantName: '',
      applicantEmail: '',
      introduction: '',
      application: null,
    };
  },
  created() {
    this.fetchApplication();
  },
  methods: {
    fetchApplication() {
      axios.get(`http://localhost:8088/applications/${this.applicationId}`)
        .then(response => {
          this.application = response.data.application;
          this.applicantName = this.application.applicantName;
          this.applicantEmail = this.application.applicantEmail;
          this.introduction = this.application.introduction;
        })
        .catch(error => {
          console.error('Error fetching application:', error);
        });
    },
    updateApplication() {
      const updatedApplication = {
        applicantName: this.applicantName,
        applicantEmail: this.applicantEmail,
        introduction: this.introduction,
      };
      axios.put(`http://localhost:8088/applications/${this.applicationId}`, updatedApplication)
        .then(() => {
          alert('Application updated successfully!');
          this.$router.push({ name: 'ApplicationList' });
        })
        .catch(error => {
          console.error('Error updating application:', error);
        });
    },
    logout() {
      this.$router.push({ name: 'HomePage' });
    },
  },
};
</script>

<style scoped>
.edit-application-container {
  text-align: left;
}
.navbar-nav .nav-link {
  transition: color 0.3s ease-in-out;
}
.navbar-nav .nav-link:hover {
  color: #007bff;
}
</style>
