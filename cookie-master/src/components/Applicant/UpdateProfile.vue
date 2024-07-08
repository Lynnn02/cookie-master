<template>
  <div class="update-profile-container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <router-link class="navbar-brand mx-auto" to="/">JOBPORTAL</router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link to="/joblist" class="nav-link">Job List</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/applicationlist" class="nav-link"
                >Application List</router-link
              >
            </li>
            <li class="nav-item">
              <router-link to="/updateprofile" class="nav-link"
                >Profile</router-link
              >
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

    <!-- Profile Display -->
    <div v-if="!editMode" class="container mt-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Profile</h3>
          <div>
            <p><strong>Full Name:</strong> {{ user.fullName }}</p>
            <p><strong>Email:</strong> {{ user.email }}</p>
            <p><strong>Phone Number:</strong> {{ user.phone }}</p>
            <p><strong>Address:</strong> {{ user.address }}</p>
          </div>
          <button @click="editMode = true" class="btn btn-primary">
            Edit Profile
          </button>
          <button @click="deleteProfile" class="btn btn-danger ml-2">
            Delete Profile
          </button>
        </div>
      </div>
    </div>

    <!-- Update Profile Form -->
    <div v-if="editMode" class="container mt-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Update Profile</h3>
          <form @submit.prevent="updateProfile">
            <div class="form-group">
              <label for="full-name">Full Name</label>
              <input
                type="text"
                id="full-name"
                v-model="user.fullName"
                class="form-control"
                required
              />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                id="email"
                v-model="user.email"
                class="form-control"
                required
              />
            </div>
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input
                type="text"
                id="phone"
                v-model="user.phone"
                class="form-control"
                required
              />
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <textarea
                id="address"
                v-model="user.address"
                class="form-control"
                required
              ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
              Update Profile
            </button>
            <button @click="editMode = false" class="btn btn-secondary ml-2">
              Cancel
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { currentUser, setCurrentUser } from "@/dummyData";

export default {
  name: "UpdateProfile",
  data() {
    return {
      user: { ...currentUser },
      editMode: false,
    };
  },
  methods: {
    updateProfile() {
      setCurrentUser(this.user);
      this.editMode = false; // Switch back to display mode
      alert("Profile updated successfully!");
    },
    logout() {
      // Perform any logout logic here (like clearing tokens, etc.)
      this.$router.push({ name: "HomePage" });
    },
    deleteProfile() {
      if (
        confirm(
          "Are you sure you want to delete your profile? This action cannot be undone."
        )
      ) {
        // Assuming deleteUser is a function that handles the profile deletion
        this.user = {}; // Clear user data or call the actual delete function
        alert("Profile deleted successfully!");
        this.logout(); // Redirect to HomePage after deletion
      }
    },
  },
};
</script>

<style scoped>
.update-profile-container {
  text-align: left;
}
.card {
  margin-bottom: 1rem;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  overflow: hidden;
}
.card-body {
  padding: 2rem;
}
.form-group {
  margin-bottom: 1.5rem;
}
.navbar-nav .nav-link {
  transition: color 0.3s ease-in-out;
}
.navbar-nav .nav-link:hover {
  color: #007bff; /* Bootstrap primary color */
}
</style>
