<template>
  <div class="signup-container">
    <!-- Navbar with only the system title -->
    <nav class="navbar navbar-light bg-light mb-4">
      <span class="navbar-brand mx-auto h1">JOBPORTAL</span>
    </nav>
    <div class="card shadow p-3 mb-5 bg-white rounded animate__animated animate__fadeIn animate__float">
      <h2 class="text-center">Sign Up</h2>
      <form @submit.prevent="register">
        <div class="form-group">
          <input type="text" id="name" v-model="name" class="form-control" placeholder="Full Name" required>
        </div>
        <div class="form-group">
          <input type="email" id="email" v-model="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group password-field">
          <input :type="passwordFieldType" id="password" v-model="password" class="form-control" placeholder="Password" required>
          <span class="toggle-password" @click="togglePasswordVisibility">
            <i :class="passwordFieldType === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
          </span>
        </div>
        <div class="form-group password-field">
          <input :type="confirmPasswordFieldType" id="confirmPassword" v-model="confirmPassword" class="form-control" placeholder="Confirm Password" required>
          <span class="toggle-password" @click="toggleConfirmPasswordVisibility">
            <i :class="confirmPasswordFieldType === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
          </span>
        </div>
        <div class="form-group">
          <input type="text" id="phone" v-model="phone" class="form-control" placeholder="Phone Number" required>
        </div>
        <div class="form-group">
          <textarea id="address" v-model="address" class="form-control" placeholder="Address" required></textarea>
        </div>
        <div class="form-group">
          <select id="userType" v-model="userType" class="form-control" required>
            <option value="applicant">Applicant</option>
            <option value="employer">Employer</option>
          </select>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
        </div>
      </form>
      <div class="text-center mt-3">
        <p>Already have an account? <router-link to="/login">Login</router-link></p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'SignUp',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      confirmPassword: '',
      phone: '',
      address: '',
      userType: 'applicant', // Default to applicant
      passwordFieldType: 'password',
      confirmPasswordFieldType: 'password',
    };
  },
  methods: {
    async register() {
      if (this.password !== this.confirmPassword) {
        alert('Passwords do not match');
        return;
      }
      const registerData = {
        name: this.name,
        email: this.email,
        password: this.password,
        phoneNumber: this.phone,
        address: this.address,
        userType: this.userType,
      };
      try {
        console.log('Sending request to backend', registerData);
        const response = await axios.post('http://localhost:8088/register', registerData); // Updated backend URL

        if (response.data.status === 'success') {
          alert('Registration successful');
          this.$router.push('/login');
        } else {
          alert('Registration failed: ' + response.data.message);
        }
      } catch (error) {
        console.error('There was an error!', error);
        alert('Registration failed: ' + (error.response.data.message || error.message));
      }
    },
    togglePasswordVisibility() {
      this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password';
    },
    toggleConfirmPasswordVisibility() {
      this.confirmPasswordFieldType = this.confirmPasswordFieldType === 'password' ? 'text' : 'password';
    },
  },
};
</script>

<style scoped>
@import 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css';
@import '@fortawesome/fontawesome-free/css/all.css';

.signup-container {
  max-width: 600px;
  margin: 50px auto;
  padding: 20px;
}
.card {
  padding: 20px;
  border: 1px solid #e0e0e0;
  border-radius: 10px;
  background-color: #ffffff;
  animation: float 3s ease-in-out infinite;
}
.form-group {
  position: relative;
  margin-bottom: 1.5rem;
}
.form-control {
  width: 100%;
  padding: 0.75rem;
  border-radius: 5px;
  border: 1px solid #ced4da;
  transition: all 0.3s ease-in-out;
}
.form-control:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}
.password-field {
  position: relative;
}
.toggle-password {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  cursor: pointer;
}
textarea.form-control {
  resize: none;
}
.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
  padding: 0.75rem;
  border-radius: 5px;
  width: 100%;
}
.text-center {
  text-align: center;
}
.mt-3 {
  margin-top: 1rem;
}
.navbar {
  border-bottom: 1px solid #e0e0e0;
  padding: 1rem 0;
}

@keyframes float {
  0% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
  100% {
    transform: translateY(0);
  }
}
</style>
