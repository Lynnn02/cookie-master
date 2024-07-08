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
import { jobs, applications, currentUser } from '@/dummyData';

export default {
  name: 'ApplyJob',
  props: ['id'],
  data() {
    return {
      job: null,
      applicantName: '',
      applicantEmail: '',
      introduction: '',
      resume: null,
    };
  },
  created() {
    const jobId = parseInt(this.id);
    this.job = jobs.find(job => job.id === jobId);
    if (!this.job) {
      console.error('Job not found for id:', jobId);
    }
  },
  methods: {
    handleFileUpload(event) {
      this.resume = event.target.files[0];
    },
    submitApplication() {
      if (!this.resume) {
        alert('Please upload your resume/CV.');
        return;
      }

      // Store the application details with status 'pending'
      const newApplication = {
        id: applications.length + 1,
        jobId: this.job.id,
        userId: currentUser.id, // Add userId to the application
        applicantName: this.applicantName,
        applicantEmail: this.applicantEmail,
        introduction: this.introduction,
        resume: this.resume.name,
        status: 'pending', // Add status field
      };

      applications.push(newApplication);

      // Log the application details
      console.log('Application submitted:', newApplication);

      // Clear form fields
      this.applicantName = '';
      this.applicantEmail = '';
      this.introduction = '';
      this.resume = null;

      alert('Application submitted successfully!');
    },
    logout() {
      // Perform any logout logic here (like clearing tokens, etc.)
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
