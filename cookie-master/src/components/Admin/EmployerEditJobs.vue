<template>
  <div class="edit-job">
    <!-- Edit job form -->
    <h2>Edit Job</h2>
    <form @submit.prevent="saveChanges">
      <div class="form-group">
        <label for="title">Title</label>
        <input
          type="text"
          class="form-control"
          id="title"
          v-model="job.title"
        />
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          class="form-control"
          id="description"
          rows="4"
          v-model="job.description"
        ></textarea>
      </div>
      <div class="form-group">
        <label for="location">Location</label>
        <input
          type="text"
          class="form-control"
          id="location"
          v-model="job.location"
        />
      </div>
      <div class="form-group">
        <label for="salary">Salary</label>
        <input
          type="text"
          class="form-control"
          id="salary"
          v-model="job.salary"
        />
      </div>
      <!-- Add more input fields for other job details as needed -->
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
  </div>
</template>

<script>
import { jobs } from "@/dummyData"; // Import jobs data from dummyData.js

export default {
  name: "EmployerEditJobs",
  data() {
    return {
      jobId: null,
      job: {
        title: "",
        description: "",
        location: "",
        salary: "",
      },
    };
  },
  created() {
    // Fetch job details based on the jobId from route params
    const jobId = this.$route.params.jobId;
    // Find the job in the dummyData array using its ID
    const job = jobs.find((job) => job.id === jobId);
    // If the job is found, assign its details to the job object
    if (job) {
      this.jobId = jobId;
      this.job = { ...job };
    } else {
      // Handle case where job is not found (e.g., display error message)
      console.error(`Job with ID ${jobId} not found.`);
    }
  },
  methods: {
    saveChanges() {
      // Logic to save edited job details
      // For this example, we'll log the changes to the console
      console.log("Saved changes:", this.job);
      // After saving changes, you can navigate back to the manage jobs page
      this.$router.push({ name: "EmployerManageJobs" });
    },
  },
};
</script>
