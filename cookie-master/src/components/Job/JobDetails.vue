<template>
  <div class="job-details-container">
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

    <!-- Job Details -->
    <div class="container mt-4">
      <div class="card job-card">
        <div class="card-body">
          <h3 class="card-title">{{ job.title }}</h3>
          <p class="card-text">{{ job.description }}</p>
          <p><strong>Location:</strong> {{ job.location }}</p>
          <p><strong>Type:</strong> {{ job.type }}</p>
          <p><strong>Salary:</strong> {{ job.salary }}</p>
          <div class="d-flex mb-2">
            <button class="btn btn-primary mr-2" @click="applyJob(job.id)">
              <i class="fa fa-paper-plane"></i> Apply Now
            </button>
            <button class="btn btn-secondary mr-2" @click="viewReviewList(job.id)">
              <i class="fa fa-star"></i> See Reviews
            </button>
            <button class="btn btn-info" @click="addReview(job.id)">
              <i class="fa fa-pencil-alt"></i> Add Review
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { jobs } from '@/dummyData';

export default {
  name: 'JobDetails',
  props: ['id'],
  data() {
    return {
      job: null,
    };
  },
  created() {
    const jobId = parseInt(this.id);
    this.job = jobs.find(job => job.id === jobId);
  },
  methods: {
    applyJob(jobId) {
      this.$router.push({ name: 'ApplyJob', params: { id: jobId.toString() } });
    },
    viewReviewList(jobId) {
      this.$router.push({ name: 'ReviewList', params: { id: jobId.toString() } });
    },
    addReview(jobId) {
      this.$router.push({ name: 'AddReview', params: { id: jobId.toString() } });
    },
    logout() {
      this.$router.push({ name: 'HomePage' });
    },
  },
};
</script>

<style scoped>
.job-details-container {
  text-align: left;
}
.card {
  margin-bottom: 1rem;
  transition: all 0.3s ease;
}
.card:hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}
.navbar-nav .nav-link {
  transition: color 0.3s ease-in-out;
}
.navbar-nav .nav-link:hover {
  color: #007bff; /* Bootstrap primary color */
}
.btn i {
  margin-right: 5px;
}
</style>
