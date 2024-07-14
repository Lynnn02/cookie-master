<template>
  <div class="apply-job-container">
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

    <!-- Apply Job -->
    <div class="container mt-4" v-if="job">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Apply for {{ job.title }}</h3>
          <p class="card-text">{{ job.description }}</p>
          <form @submit.prevent="submitApplication">
            <div class="form-group">
              <label for="applicantName">Name</label>
              <input type="text" id="applicantName" v-model="applicantName" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="applicantEmail">Email</label>
              <input type="email" id="applicantEmail" v-model="applicantEmail" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="introduction">Introduction</label>
              <textarea id="introduction" v-model="introduction" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
              <label for="resume">Upload Resume/CV</label>
              <input type="file" id="resume" @change="handleFileUpload" class="form-control" accept=".pdf,.doc,.docx" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
          </form>
        </div>
      </div>
    </div>
    <div class="container mt-4" v-else>
      <div class="alert alert-danger" role="alert">
        Job not found!
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ApplyJob',
  props: ['id'],
  data() {
    return {
      job: '',
      applicantName: '',
      applicantEmail: '',
      introduction: '',
      resume: null,
      currentUser: '',
      loading: true,
      error: null,
    };
  },
  created() {
    console.log('Job ID:', this.id);
    this.fetchJob();
    this.fetchCurrentUser();
  },
  methods: {
    async fetchJob() {
      try {
        const response = await axios.get(`http://localhost:8088/jobs/${this.id}`);
        console.log('Job Data:', response.data);
        this.job = response.data.job;
        this.loading = false;
      } catch (error) {
        this.error = 'Error fetching job';
        console.error('Error fetching job:', error);
        this.loading = false;
      }
    },
    fetchCurrentUser() {
      const user = JSON.parse(localStorage.getItem('currentUser'));
      if (user) {
        this.currentUser = user;
        this.applicantName = this.currentUser.name;
        this.applicantEmail = this.currentUser.email;
      } else {
        this.error = 'User not found in local storage';
        console.error('User not found in local storage');
      }
    },
    handleFileUpload(event) {
      this.resume = event.target.files[0];
    },
    async submitApplication() {
      if (!this.resume) {
        alert('Please upload your resume/CV.');
        return;
      }

      if (!this.job || !this.job.id) {
        alert('Job details are not loaded properly.');
        return;
      }

      const formData = new FormData();
      formData.append('jobId', this.job.id);
      formData.append('userId', this.currentUser.id); // Pass the correct user ID
      formData.append('applicantName', this.applicantName);
      formData.append('applicantEmail', this.applicantEmail);
      formData.append('introduction', this.introduction);
      formData.append('resume', this.resume);
      formData.append('status', 'pending');

      try {
        await axios.post('http://localhost:8088/applications', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        alert('Application submitted successfully!');
        this.$router.push({ name: 'ApplicationList' });
      } catch (error) {
        console.error('Error submitting application:', error);
        alert('Failed to submit application.');
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
.apply-job-container {
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
