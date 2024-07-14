<template>
  <div class="job-list-container">
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

    <!-- Job Listings -->
    <div class="container mt-4">
      <div class="row mb-4">
        <div class="col-md-6">
          <div class="input-group">
            <input type="text" v-model="searchTitle" class="form-control" placeholder="Search by title" />
            <div class="input-group-append">
              <span class="input-group-text"><i class="fa fa-search"></i></span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group">
            <input type="text" v-model="searchLocation" class="form-control" placeholder="Search by location" />
            <div class="input-group-append">
              <span class="input-group-text"><i class="fa fa-search"></i></span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h3>{{ filteredJobs.length }} jobs found</h3>
          <div class="card-columns">
            <div class="card mb-4" v-for="job in filteredJobs" :key="job.id">
              <div class="card-body">
                <h5 class="card-title">{{ job.title }}</h5>
                <p class="card-text">{{ job.description }}</p>
                <p class="card-text"><small class="text-muted">{{ job.location }}</small></p>
                <div class="d-flex">
                  <button class="btn btn-primary mr-2" @click="viewJobDetails(job.id)">
                    <i class="fa fa-info-circle"></i> View Details
                  </button>
                  <button class="btn btn-secondary" @click="applyJob(job.id)">
                    <i class="fa fa-paper-plane"></i> Apply
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'JobList',
  data() {
    return {
      jobs: [],
      searchTitle: '',
      searchLocation: '',
    };
  },
  computed: {
    filteredJobs() {
      return this.jobs.filter(job => {
        const titleMatch = job.title.toLowerCase().includes(this.searchTitle.toLowerCase());
        const locationMatch = job.location.toLowerCase().includes(this.searchLocation.toLowerCase());
        return titleMatch && locationMatch;
      });
    },
  },
  created() {
    this.fetchJobs();
  },
  methods: {
    async fetchJobs() {
      try {
        const response = await axios.get('http://localhost:8088/jobs');
        this.jobs = response.data.jobs;
      } catch (error) {
        console.error('Error fetching jobs:', error);
      }
    },
    viewJobDetails(jobId) {
      this.$router.push({ name: 'JobDetails', params: { id: jobId } });
    },
    applyJob(jobId) {
      this.$router.push({ name: 'ApplyJob', params: { id: jobId } });
    },
    logout() {
      // Perform any logout logic here (like clearing tokens, etc.)
      localStorage.removeItem('currentUser');
      this.$router.push({ name: 'HomePage' });
    },
  },
};
</script>

<style scoped>
.job-list-container {
  text-align: left;
}
.card-columns {
  column-count: 3;
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
.btn {
  display: flex;
  align-items: center;
}
.btn i {
  margin-right: 5px;
}
.navbar-nav .nav-link {
  transition: color 0.3s ease-in-out;
}
.navbar-nav .nav-link:hover {
  color: #007bff; /* Bootstrap primary color */
}
</style>
