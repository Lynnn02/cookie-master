<template>
  <div class="manage-job-posts">
    <!-- Navbar -->
    <EmployerNavbar />

    <!-- Main Content -->
    <div class="container mt-4">
      <h2 class="mb-4">Manage Job Posts</h2>
      <button class="btn btn-primary mb-3" @click="showCreateJobModal = true"><i class="fa fa-plus"></i> Create Job</button>
      <div v-if="jobs.length">
        <div class="card mb-3" v-for="job in jobs" :key="job.id" @mouseover="hoverJob = job.id" @mouseleave="hoverJob = null">
          <div class="card-body">
            <h5 class="card-title">{{ job.title }}</h5>
            <p class="card-text">{{ job.description }}</p>
            <p class="card-text"><strong>Location:</strong> {{ job.location }}</p>
            <p class="card-text"><strong>Type:</strong> {{ job.type }}</p>
            <p class="card-text"><strong>Salary:</strong> RM{{ job.salaryMin }} - RM{{ job.salaryMax }}</p>
            <div class="actions" v-if="hoverJob === job.id">
              <button class="btn btn-warning" @click="editJob(job)"><i class="fa fa-edit"></i> Edit</button>
              <button class="btn btn-danger" @click="deleteJob(job.id)"><i class="fa fa-trash"></i> Delete</button>
            </div>
          </div>
        </div>
      </div>
      <div v-else>
        <p>No job posts found.</p>
      </div>
    </div>

    <!-- Edit Job Modal -->
    <transition name="modal">
      <div v-if="showEditModal" class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-container">
            <div class="modal-header">
              <h5 class="modal-title">Edit Job</h5>
              <button type="button" class="close" @click="closeEditModal">&times;</button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="saveJob">
                <div class="form-group">
                  <label for="title">Job Title</label>
                  <input type="text" id="title" v-model="currentJob.title" class="form-control" required />
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea id="description" v-model="currentJob.description" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                  <label for="location">Location</label>
                  <input type="text" id="location" v-model="currentJob.location" class="form-control" required />
                </div>
                <div class="form-group">
                  <label for="type">Type</label>
                  <select id="type" v-model="currentJob.type" class="form-control" required>
                    <option value="Part-time">Part-time</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Internship">Internship</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="salary">Salary Range (RM)</label>
                  <div class="d-flex align-items-center">
                    <input type="number" id="salaryMin" v-model.number="currentJob.salaryMin" class="form-control mr-2" placeholder="Min" required />
                    <span class="mx-2">-</span>
                    <input type="number" id="salaryMax" v-model.number="currentJob.salaryMax" class="form-control ml-2" placeholder="Max" required />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                  <button type="button" class="btn btn-secondary" @click="closeEditModal">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </transition>

    <!-- Create Job Modal -->
    <transition name="modal">
      <div v-if="showCreateJobModal" class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-container">
            <div class="modal-header">
              <h5 class="modal-title">Create Job</h5>
              <button type="button" class="close" @click="closeCreateJobModal">&times;</button>
            </div>
            <div class="modal-body">
              <EmployerCreateJob @job-created="addJob"></EmployerCreateJob>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import EmployerNavbar from './EmployerNavbar.vue';
import EmployerCreateJob from './EmployerCreateJob.vue';
import axios from 'axios';

export default {
  name: 'ManageJobPosts',
  components: {
    EmployerNavbar,
    EmployerCreateJob,
  },
  data() {
    return {
      jobs: [],
      showEditModal: false,
      showCreateJobModal: false,
      currentJob: null,
      hoverJob: null,
    };
  },
  async created() {
    await this.fetchJobs();
  },
  methods: {
    async fetchJobs() {
      try {
        const response = await axios.get('http://localhost:8088/jobs');
        if (response.data.status === 'success') {
          this.jobs = response.data.jobs;
        } else {
          alert('Failed to fetch jobs');
        }
      } catch (error) {
        console.error('There was an error fetching jobs:', error);
        alert('Failed to fetch jobs');
      }
    },
    createJob() {
      this.showCreateJobModal = true;
    },
    editJob(job) {
      this.currentJob = { ...job };
      this.showEditModal = true;
    },
    async saveJob() {
      try {
        const response = await axios.put(`http://localhost:8088/jobs/${this.currentJob.id}`, this.currentJob);
        if (response.data.status === 'success') {
          const index = this.jobs.findIndex(job => job.id === this.currentJob.id);
          if (index !== -1) {
            this.jobs.splice(index, 1, this.currentJob);
            alert('Job updated successfully');
          }
          this.closeEditModal();
        } else {
          alert('Failed to update job');
        }
      } catch (error) {
        console.error('There was an error updating the job:', error);
        alert('Failed to update job');
      }
    },
    async deleteJob(jobId) {
      try {
        const response = await axios.delete(`http://localhost:8088/jobs/${jobId}`);
        if (response.data.status === 'success') {
          const index = this.jobs.findIndex(job => job.id === jobId);
          if (index !== -1) {
            this.jobs.splice(index, 1);
            alert('Job deleted successfully');
          }
        } else {
          alert('Failed to delete job');
        }
      } catch (error) {
        console.error('There was an error deleting the job:', error);
        alert('Failed to delete job');
      }
    },
    closeEditModal() {
      this.showEditModal = false;
      this.currentJob = null;
    },
    closeCreateJobModal() {
      this.showCreateJobModal = false;
    },
    addJob(newJob) {
      this.jobs.push(newJob);
      this.closeCreateJobModal();
    },
  },
};
</script>

<style scoped>
.manage-job-posts {
  text-align: left;
}
.card {
  margin-bottom: 1rem;
  transition: all 0.3s ease;
  cursor: pointer;
}
.card:hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}
.actions {
  margin-top: 15px;
}
.actions button {
  margin-right: 5px;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}
.modal-wrapper {
  width: 100%;
  max-width: 600px;
  margin: 0 auto;
}
.modal-container {
  background: white;
  border-radius: 8px;
  overflow: hidden;
}
.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px;
  background: #007bff;
  color: white;
}
.modal-title {
  margin: 0;
}
.modal-body {
  padding: 20px;
}
.modal-footer {
  padding: 15px;
  display: flex;
  justify-content: flex-end;
  background: #f1f1f1;
}
.modal-footer button {
  margin-left: 10px;
}
.modal-enter-active, .modal-leave-active {
  transition: opacity 0.5s;
}
.modal-enter, .modal-leave-to {
  opacity: 0;
}
</style>
