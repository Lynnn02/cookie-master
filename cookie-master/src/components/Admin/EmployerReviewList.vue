<template>
    <div class="employer-review-list-container">
      <!-- Navbar -->
      <EmployerNavbar />
  
      <!-- Main Content -->
      <div class="container mt-4">
        <h2>Reviews for {{ currentUser.company }}</h2>
        <div v-if="reviews.length">
          <div class="card mb-3" v-for="review in reviews" :key="review.id">
            <div class="card-body">
              <h5 class="card-title">{{ review.category }}</h5>
              <p class="card-text">
                Rating:
                <span v-for="star in 5" :key="star" class="fa fa-star" :class="{'checked': star <= review.rating}"></span>
              </p>
              <p class="card-text">{{ review.comment }}</p>
            </div>
          </div>
        </div>
        <div v-else>
          <p>No reviews found.</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { reviews, currentUser } from '@/dummyData';
  import EmployerNavbar from './EmployerNavbar.vue';
  
  export default {
    name: 'EmployerReviewList',
    components: {
      EmployerNavbar,
    },
    data() {
      return {
        reviews: [],
        currentUser: currentUser, // Add this to use currentUser in the template
      };
    },
    created() {
      this.reviews = reviews.filter(review => review.company === this.currentUser.company);
    },
  };
  </script>
  
  <style scoped>
  .employer-review-list-container {
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
  .fa-star {
    color: #d3d3d3;
  }
  .fa-star.checked {
    color: #ffcc00;
  }
  </style>
  