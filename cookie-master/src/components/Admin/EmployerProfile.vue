<template>
    <div class="employer-profile">
      <!-- Navbar -->
      <EmployerNavbar />
  
      <!-- Main Content -->
      <div class="container mt-4">
        <h2>Profile</h2>
  
        <!-- Profile Display -->
        <div v-if="!editMode" class="container mt-4">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">Profile</h3>
              <div>
                <p><strong>Full Name:</strong> {{ user.fullName }}</p>
                <p><strong>Email:</strong> {{ user.email }}</p>
                <p><strong>Phone Number:</strong> {{ user.phone }}</p>
                <p><strong>Company:</strong> {{ user.company }}</p>
                <p><strong>Address:</strong> {{ user.address }}</p>
              </div>
              <button @click="editMode = true" class="btn btn-primary">Edit Profile</button>
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
                  <input type="text" id="full-name" v-model="user.fullName" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" v-model="user.email" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="text" id="phone" v-model="user.phone" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="company">Company</label>
                  <input type="text" id="company" v-model="user.company" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <textarea id="address" v-model="user.address" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <button @click="editMode = false" class="btn btn-secondary ml-2">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import EmployerNavbar from './EmployerNavbar.vue';
  import { currentUser, setCurrentUser } from '@/dummyData';
  
  export default {
    name: 'EmployerProfile',
    components: {
      EmployerNavbar,
    },
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
        alert('Profile updated successfully!');
      },
    },
  };
  </script>
  
  <style scoped>
  .employer-profile {
    text-align: left;
  }
  .section-header {
    padding: 20px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 5px;
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
  