<template>
  <div class="employer-create-job">
    <!-- Navbar -->
    <EmployerNavbar />

    <!-- Main Content -->
    <div class="container mt-4">
      <div class="section-header">
        <h2>Create Job Post</h2>
      </div>
      <div class="job-form-section mt-5">
        <form @submit.prevent="createJob">
          <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" id="title" v-model="job.title" class="form-control" required />
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" v-model="job.description" class="form-control" rows="5" required></textarea>
          </div>
          <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" v-model="job.location" class="form-control" required />
          </div>
          <div class="form-group">
            <label for="type">Type</label>
            <select id="type" v-model="job.type" class="form-control" required>
              <option disabled value="">Select job type</option>
              <option value="Part-time">Part-time</option>
              <option value="Full-time">Full-time</option>
              <option value="Internship">Internship</option>
            </select>
          </div>
          <div class="form-group">
            <label for="salary">Salary Range (RM)</label>
            <div class="d-flex align-items-center">
              <input type="number" id="salaryMin" v-model.number="job.salaryMin" class="form-control mr-2" placeholder="Min" required />
              <span class="mx-2">-</span>
              <input type="number" id="salaryMax" v-model.number="job.salaryMax" class="form-control ml-2" placeholder="Max" required />
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create Job</button>
            <button type="button" class="btn btn-secondary" @click="cancel"><i class="fa fa-times"></i> Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import EmployerNavbar from './EmployerNavbar.vue';
import axios from 'axios';

export default {
  name: 'EmployerCreateJob',
  components: {
    EmployerNavbar,
  },
  data() {
    return {
      job: {
        title: '',
        description: '',
        location: '',
        type: '',
        salaryMin: '',
        salaryMax: '',
      },
    };
  },
  methods: {
    async createJob() {
      try {
        const response = await axios.post('http://localhost:8088/createJob', this.job);
        if (response.data.status === 'success') {
          alert('Job created successfully');
          this.$router.push('/admin/managejobs');
        } else {
          alert('Failed to create job');
        }
      } catch (error) {
        console.error('There was an error creating the job:', error);
        alert('Failed to create job');
      }
    },
    cancel() {
      this.$router.push('/admin/managejobs');
    },
  },
};
</script>



  
  <style scoped>
  .employer-create-job {
    text-align: left;
  }
  .section-header {
    padding: 20px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 5px;
  }
  .job-form-section {
    padding: 20px;
    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 5px;
  }
  .form-group {
    margin-bottom: 1rem;
  }
  .form-group label {
    font-weight: bold;
  }
  .form-group input,
  .form-group textarea,
  .form-group select {
    transition: border-color 0.3s ease-in-out;
  }
  .form-group input:focus,
  .form-group textarea:focus,
  .form-group select:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }
  .button-group {
    margin-top: 1rem;
  }
  .button-group button {
    margin-right: 10px;
  }
  </style>
  