<template>
  <div class="profile-container">
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

    <div class="container mt-4">
      <h3>User Profile</h3>
      <div v-if="user">
        <div class="card mb-3">
          <div class="card-body">
            <div v-if="editMode">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" v-model="user.name">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" v-model="user.email">
              </div>
              <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumber" v-model="user.phoneNumber">
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" v-model="user.address">
              </div>
              <button class="btn btn-success mr-2" @click="updateProfile">Save</button>
              <button class="btn btn-secondary" @click="editMode = false">Cancel</button>
            </div>
            <div v-else>
              <h5 class="card-title">Name: {{ user.name }}</h5>
              <p class="card-text">Email: {{ user.email }}</p>
              <p class="card-text">Phone Number: {{ user.phoneNumber }}</p>
              <p class="card-text">Address: {{ user.address }}</p>
              <button class="btn btn-primary mr-2" @click="editMode = true">Update</button>
              <button class="btn btn-danger" @click="deleteProfile">Delete</button>
            </div>
          </div>
        </div>
      </div>
      <div v-else>
        <p>No user profile found.</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'UpdateProfile',
  data() {
    return {
      user: {},
      editMode: false,
    };
  },
  created() {
    this.fetchProfile();
  },
  methods: {
    fetchProfile() {
      axios.get('http://localhost:8088/user/profile')
        .then(response => {
          this.user = response.data.data;
        })
        .catch(error => {
          console.error('Error fetching profile:', error);
        });
    },
    updateProfile() {
      axios.put(`http://localhost:8088/user/profile`, this.user)
        .then(() => {
          alert('Profile updated successfully!');
          this.editMode = false;
        })
        .catch(error => {
          console.error('Error updating profile:', error);
        });
    },
    async deleteProfile() {
      if (confirm('Are you sure you want to delete your profile? This action cannot be undone.')) {
        try {
          const response = await axios.delete(`http://localhost:8088/user/profile`);
          if (response.data.status === 'success') {
            alert('Profile deleted successfully!');
            this.logout();
          } else {
            alert(`Error: ${response.data.message}`);
          }
        } catch (error) {
          console.error('Error deleting profile:', error);
          alert('An error occurred while deleting your profile.');
        }
      }
    },
    logout() {
      this.$router.push({ name: 'HomePage' });
    },
    
  }
};
</script>

<style scoped>
.profile-container {
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