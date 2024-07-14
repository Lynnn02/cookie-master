<template>
  <div class="update-application-container">
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

    <!-- Update Application -->
    <div class="container mt-4" v-if="loading">
      <div class="alert alert-info" role="alert">
        Loading application details...
      </div>
    </div>

    <div class="container mt-4" v-if="!loading && application">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Update Application for Job ID: {{ application.jobId }}</h3>
          <form @submit.prevent="updateApplication">
            <div class="form-group">
              <label for="applicantName">Name</label>
              <input
                type="text"
                id="applicantName"
                v-model="applicantName"
                class="form-control"
                required
              />
            </div>
            <div class="form-group">
              <label for="applicantEmail">Email</label>
              <input
                type="email"
                id="applicantEmail"
                v-model="applicantEmail"
                class="form-control"
                required
              />
            </div>
            <div class="form-group">
              <label for="introduction">Introduction</label>
              <textarea
                id="introduction"
                v-model="introduction"
                class="form-control"
                rows="5"
                required
              ></textarea>
            </div>
            <div class="form-group">
              <label for="resume">Upload Resume/CV</label>
              <input
                type="file"
                id="resume"
                @change="handleFileUpload"
                class="form-control"
                accept=".pdf,.doc,.docx"
              />
            </div>
            <button type="submit" class="btn btn-primary">Update Application</button>
          </form>
        </div>
      </div>
    </div>

    <div class="container mt-4" v-if="!loading && !application">
      <div class="alert alert-danger" role="alert">
        Application not found!
      </div>
    </div>

    <div class="container mt-4" v-if="error">
      <div class="alert alert-danger" role="alert">
        {{ error }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'UpdateApplication',
  props: ['id'],
  data() {
    return {
      applicationId: parseInt(this.id),
      application: '',
      applicantName: '',
      applicantEmail: '',
      introduction: '',
      resume: '',
      currentUser: '',
      loading: true,
      error: null,
    };
  },
  created() {
    this.fetchCurrentUser();
  },
  methods: {
    fetchCurrentUser() {
      const user = localStorage.getItem('currentUser');
      if (user) {
        this.currentUser = JSON.parse(user);
        this.fetchApplication();
      } else {
        this.error = 'User not found in local storage';
        console.error('User not found in local storage');
        this.loading = false;
      }
    },
    async fetchApplication() {
      try {
        const response = await axios.get(`http://localhost:8088/applications/${this.applicationId}`);
        this.application = response.data.application;
        if (this.application) {
          this.applicantName = this.application.applicantName;
          this.applicantEmail = this.application.applicantEmail;
          this.introduction = this.application.introduction;
        }
        this.loading = false;
      } catch (error) {
        this.error = 'Error fetching application';
        console.error('Error fetching application:', error);
        this.loading = false;
      }
    },
    handleFileUpload(event) {
      this.resume = event.target.files[0];
    },
    async updateApplication() {
      if (!this.application || !this.applicationId) {
        alert('Application details are not loaded properly.');
        return;
      }

      const formData = new FormData();
      formData.append('applicantName', this.applicantName);
      formData.append('applicantEmail', this.applicantEmail);
      formData.append('introduction', this.introduction);
      if (this.resume) {
        formData.append('resume', this.resume);
      }
      formData.append('status', 'pending');

      try {
        await axios.put(`http://localhost:8088/applications/${this.applicationId}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        alert('Application updated successfully!');
        this.$router.push({ name: 'ApplicationList' });
      } catch (error) {
        console.error('Error updating application:', error);
        alert('Failed to update application.');
      }
    },
    logout() {
      localStorage.removeItem('currentUser');
      this.$router.push({ name: 'HomePage' });
    },
  },
};
</script>

<style scoped>
.update-application-container {
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
