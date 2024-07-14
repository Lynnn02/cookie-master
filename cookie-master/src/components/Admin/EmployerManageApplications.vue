<template>
  <div class="employer-manage-applications">
    <!-- Navbar -->
    <EmployerNavbar />

    <!-- Main Content -->
    <div class="container mt-4">
      <div class="section-header">
        <h2>Manage Applications</h2>
      </div>

      <!-- Pending Applications -->
      <div class="applications-section mt-5">
        <h3 class="section-title">Pending Applications</h3>
        <div v-if="pendingApplications.length" class="applications-list">
          <div
            class="card mb-3"
            v-for="application in pendingApplications"
            :key="application.id"
            @mouseover="hoverApplication = application.id"
            @mouseleave="hoverApplication = null"
          >
            <div class="card-body">
              <h5 class="card-title">Job ID: {{ application.jobId }}</h5>
              <p class="card-text">Applicant Name: {{ application.applicantName }}</p>
              <p class="card-text">Applicant Email: {{ application.applicantEmail }}</p>
              <p class="card-text">Introduction: {{ application.introduction }}</p>
              <p class="card-text">Status: {{ application.status }}</p>
              <div class="actions" v-if="hoverApplication === application.id">
                <button
                  class="btn btn-success"
                  @click="updateStatus(application.id, 'accepted')"
                >
                  <i class="fa fa-check"></i> Accept
                </button>
                <button
                  class="btn btn-danger"
                  @click="updateStatus(application.id, 'rejected')"
                >
                  <i class="fa fa-times"></i> Reject
                </button>
              </div>
            </div>
          </div>
        </div>
        <div v-else>
          <p>No pending applications found.</p>
        </div>
      </div>

      <hr v-if="pendingApplications.length && processedApplications.length" class="section-divider">

      <!-- Processed Applications -->
      <div class="applications-section mt-5">
        <h3 class="section-title">Processed Applications</h3>
        <div v-if="processedApplications.length" class="applications-list">
          <div
            class="card mb-3"
            v-for="application in processedApplications"
            :key="application.id"
          >
            <div class="card-body">
              <h5 class="card-title">Job ID: {{ application.jobId }}</h5>
              <p class="card-text">Applicant Name: {{ application.applicantName }}</p>
              <p class="card-text">Applicant Email: {{ application.applicantEmail }}</p>
              <p class="card-text">Introduction: {{ application.introduction }}</p>
              <p class="card-text">Status: {{ application.status }}</p>
            </div>
          </div>
        </div>
        <div v-else>
          <p>No processed applications found.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import EmployerNavbar from './EmployerNavbar.vue';
import axios from 'axios';

export default {
  name: 'EmployerManageApplications',
  components: {
    EmployerNavbar,
  },
  data() {
    return {
      applications: [],
      hoverApplication: null,
    };
  },
  computed: {
    filteredApplications() {
      return this.applications;
    },
    pendingApplications() {
      return this.filteredApplications.filter(app => app.status === 'pending');
    },
    processedApplications() {
      return this.filteredApplications.filter(app => app.status !== 'pending');
    },
  },
  methods: {
    async fetchApplications() {
      try {
        const response = await axios.get('http://localhost:8088/admin/applications'); // Adjust the endpoint as needed
        this.applications = response.data.applications;
      } catch (error) {
        console.error('Error fetching applications:', error);
      }
    },
    async updateStatus(applicationId, status) {
      try {
        await axios.put(`http://localhost:8088/applications/${applicationId}`, { status });
        this.applications = this.applications.map(app => app.id === applicationId ? { ...app, status } : app);
        alert(`Application ${status}`);
      } catch (error) {
        console.error('Error updating application status:', error);
        alert('Failed to update application status.');
      }
    },
  },
  async created() {
    await this.fetchApplications();
  },
};
</script>

<style scoped>
.employer-manage-applications {
  text-align: left;
}
.section-header {
  padding: 20px;
  background: #f8f9fa;
  border: 1px solid #dee2e6;
  border-radius: 5px;
}
.applications-section {
  padding: 20px;
  background: #ffffff;
  border: 1px solid #dee2e6;
  border-radius: 5px;
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
.section-title {
  font-family: 'Arial', sans-serif;
  font-weight: bold;
}
.section-divider {
  margin: 2rem 0;
}
.navbar-nav .nav-link {
  transition: color 0.3s ease-in-out;
}
.navbar-nav .nav-link:hover {
  color: #007bff; /* Bootstrap primary color */
}
</style>
