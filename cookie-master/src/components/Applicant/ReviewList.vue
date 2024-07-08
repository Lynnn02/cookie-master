<template>
  <div class="review-list-container">
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

    <!-- Review List -->
    <div class="container mt-4">
      <h3>Reviews for {{ jobTitle }}</h3>
      <div v-if="userReview">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">{{ userReview.category }}</h5>
            <p class="card-text">
              Rating:
              <span v-for="star in 5" :key="star" class="fa fa-star" :class="{'checked': star <= userReview.rating}"></span>
            </p>
            <p class="card-text">{{ userReview.comment }}</p>
            <!-- Update and Delete Buttons for User Review -->
            <div>
              <button class="btn btn-primary mr-2" @click="editReview(userReview.id)">Update</button>
              <button class="btn btn-danger" @click="deleteReview(userReview.id)">Delete</button>
            </div>
          </div>
        </div>
      </div>
      <div v-if="otherReviews.length">
        <div class="card mb-3" v-for="review in otherReviews" :key="review.id">
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
import axios from 'axios';

export default {
  name: 'ReviewList',
  props: ['id'],
  data() {
    return {
      jobId: parseInt(this.id),
      reviews: [],
      userReview: null,
      otherReviews: [],
      jobTitle: '',
    };
  },
  inject: ['currentUser', 'setCurrentUser'],
  created() {
    this.fetchJobAndReviews();
  },
  methods: {
    fetchJobAndReviews() {
      axios.get(`http://localhost:8088/jobs/${this.jobId}`)
        .then(response => {
          const job = response.data.job;
          this.jobTitle = `${job.title} at ${job.company}`;
          return axios.get(`http://localhost:8088/reviews/job/${this.jobId}`);
        })
        .then(response => {
          console.log('Fetched reviews:', response.data.reviews);
          this.reviews = response.data.reviews;
          this.sortReviews();
        })
        .catch(error => {
          console.error('Error fetching job or reviews:', error);
        });
    },
    sortReviews() {
      this.userReview = this.reviews.find(review => review.userId === this.currentUser.id) || null;
      this.otherReviews = this.reviews.filter(review => review.userId !== this.currentUser.id);
    },
    editReview(reviewId) {
      this.$router.push({ name: 'EditReview', params: { id: reviewId } });
    },
    deleteReview(reviewId) {
      axios.delete(`http://localhost:8088/reviews/${reviewId}`)
        .then(() => {
          this.reviews = this.reviews.filter(review => review.id !== reviewId);
          this.sortReviews();
        })
        .catch(error => {
          console.error('Error deleting review:', error);
        });
    },
    logout() {
      this.$router.push({ name: 'HomePage' });
    },
  },
};
</script>

<style scoped>
.review-list-container {
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
  color: #007bff;
}
.fa-star {
  color: #d3d3d3;
}
.fa-star.checked {
  color: #ffcc00;
}
</style>
