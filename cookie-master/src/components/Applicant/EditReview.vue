<template>
  <div class="edit-review-container">
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

    <!-- Edit Review -->
    <div class="container mt-4">
      <h3>Edit Review for {{ jobTitle }}</h3>
      <form @submit.prevent="updateReview">
        <div class="form-group">
          <label for="category">Category</label>
          <select id="category" v-model="category" class="form-control" required>
            <option value="Salary">Salary</option>
            <option value="Work Environment">Work Environment</option>
            <option value="Management">Management</option>
            <option value="Career Growth">Career Growth</option>
          </select>
        </div>
        <div class="form-group">
          <label for="rating">Rating</label>
          <div id="rating" class="star-rating">
            <span v-for="star in 5" :key="star" class="fa fa-star" :class="{'checked': star <= rating}" @click="setRating(star)"></span>
          </div>
        </div>
        <div class="form-group">
          <label for="comment">Comment</label>
          <textarea id="comment" v-model="comment" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Review</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'EditReview',
  props: ['id'],
  data() {
    return {
      reviewId: parseInt(this.id),
      jobId: null,
      jobTitle: '',
      category: '',
      rating: 0,
      comment: '',
      review: null,
    };
  },
  created() {
    this.fetchReview();
  },
  methods: {
    setRating(star) {
      this.rating = star;
    },
    fetchReview() {
      axios.get(`http://localhost:8088/reviews/${this.reviewId}`)
        .then(response => {
          this.review = response.data.review;
          this.jobId = this.review.jobId;
          this.category = this.review.category;
          this.rating = this.review.rating;
          this.comment = this.review.comment;
          return axios.get(`http://localhost:8088/jobs/${this.jobId}`);
        })
        .then(response => {
          const job = response.data.job;
          this.jobTitle = `${job.title} at ${job.company}`;
        })
        .catch(error => {
          console.error('Error fetching review or job:', error);
        });
    },
    updateReview() {
      const updatedReview = {
        category: this.category,
        rating: this.rating,
        comment: this.comment,
      };
      axios.put(`http://localhost:8088/reviews/${this.reviewId}`, updatedReview)
        .then(() => {
          alert('Review updated successfully!');
          this.$router.push({ name: 'ReviewList', params: { id: this.jobId } });
        })
        .catch(error => {
          console.error('Error updating review:', error);
        });
    },
    logout() {
      this.$router.push({ name: 'HomePage' });
    },
  },
};
</script>

<style scoped>
.edit-review-container {
  text-align: left;
}
.navbar-nav .nav-link {
  transition: color 0.3s ease-in-out;
}
.navbar-nav .nav-link:hover {
  color: #007bff;
}
.star-rating .fa {
  font-size: 24px;
  color: #d3d3d3;
  cursor: pointer;
  transition: color 0.3s ease;
}
.star-rating .fa.checked {
  color: #ffcc00;
}
.star-rating .fa:hover {
  color: #ffcc00;
}
</style>
