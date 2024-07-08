<template>
  <div id="home">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand mx-auto" href="#">JOBPORTAL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link to="/" class="nav-link">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/login" class="nav-link">JobList</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/about" class="nav-link">About Us</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/contact" class="nav-link">Contact</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/interviewtips" class="nav-link">Interview Tips</router-link>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <router-link to="/login" class="nav-link">Sign In</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/signup" class="nav-link">Sign Up</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <div class="container mt-5">
      <div class="jumbotron animate__animated animate__fadeIn">
        <h1 class="display-4">Welcome to JOBPORTAL</h1>
        <p class="lead">Your gateway to finding the best jobs and career opportunities.</p>
        <hr class="my-4">
        <p>Explore thousands of job listings, attend career fairs, and access career services to boost your professional journey.</p>
        <router-link to="/login" class="btn btn-primary btn-lg" role="button">Find Jobs</router-link>
      </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="container mt-5">
      <h2 class="animate__animated animate__fadeInUp">Why Choose Us?</h2>
      <div class="row mt-4">
        <div
          class="col-md-4 mb-4"
          v-for="(info, index) in infoSections"
          :key="index"
          @mouseover="info.hover = true"
          @mouseleave="info.hover = false"
        >
          <div class="card h-100 animate__animated animate__zoomIn" :class="{ 'card-hover': info.hover }">
            <div class="card-body">
              <div class="card-icon mb-3" v-if="!info.hover">
                <i :class="info.icon" style="font-size: 2rem;"></i>
              </div>
              <p class="card-text" v-if="!info.hover">{{ info.title }}</p>
              <p class="card-hover-text" v-if="info.hover">{{ info.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Featured Jobs Section -->
    <div class="container mt-5">
      <h2 class="animate__animated animate__fadeInUp">Featured Jobs</h2>
      <div class="row mt-4">
        <div
          class="col-md-4"
          v-for="(job, index) in featuredJobs"
          :key="index"
          @mouseover="job.hover = true"
          @mouseleave="job.hover = false"
        >
          <div class="card h-100 animate__animated animate__zoomIn" :class="{ 'card-hover': job.hover }">
            <div class="card-body">
              <h5 class="card-title">{{ job.title }}</h5>
              <p class="card-text" v-if="!job.hover">{{ job.description }}</p>
              <router-link v-if="job.hover" :to="'/login'" class="btn btn-primary">Apply Now</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Testimonials Section -->
    <div class="container mt-5">
      <h2 class="animate__animated animate__fadeInUp">Testimonials</h2>
      <div class="row mt-4">
        <div
          class="col-md-4"
          v-for="(testimonial, index) in testimonials"
          :key="index"
          @mouseover="testimonial.hover = true"
          @mouseleave="testimonial.hover = false"
        >
          <div class="card h-100 animate__animated animate__zoomIn" :class="{ 'card-hover': testimonial.hover }">
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>{{ testimonial.quote }}</p>
                <footer class="blockquote-footer">{{ testimonial.author }}</footer>
                <router-link v-if="testimonial.hover" :to="'/testimonial/' + testimonial.id" class="btn btn-primary">Read More</router-link>
              </blockquote>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Statistics Section -->
    <div class="container mt-5">
      <h2 class="animate__animated animate__fadeInUp">Our Impact</h2>
      <div class="row text-center mt-4">
        <div class="col-md-3" v-for="(stat, index) in statistics" :key="index">
          <div class="stat-box animate__animated animate__zoomIn">
            <h3>{{ stat.value }}</h3>
            <p>{{ stat.label }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-dark mt-5">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-4">
            <h5>CONTACT US</h5>
            <p>1300 22 8000<br>JobPortal@.gov.my<br>Find a Satellite Centre</p>
          </div>
          <div class="col-md-4">
            <h5>JOBSEEKER SERVICES</h5>
            <ul class="list-unstyled">
              <li><router-link to="/">Home</router-link></li>
              <li><router-link to="/login">JobList</router-link></li>
              <li><router-link to="/about">About Us</router-link></li>
              <li><router-link to="/interviewtips">Interview Tips</router-link></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5>EMPLOYER SERVICES</h5>
            <ul class="list-unstyled">
              <li>Hire Local</li>
              <li>Highskilled Talent+ Programme</li>
              <li>MYMidCareer40</li>
              <li>Orang Asli</li>
              <li>Persons with Disabilities (PWD)</li>
              <li>Second Chance</li>
              <li>Hiring Outcome Report</li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import { jobs } from '@/dummyData';

export default {
  name: 'HomePage',
  data() {
    return {
      featuredJobs: jobs.map(job => ({ ...job, hover: false })),
      infoSections: [
        { icon: 'fas fa-hand-holding-heart', title: 'Free support services for all jobseekers.', description: 'We offer free counseling and support for all jobseekers.', hover: false },
        { icon: 'fas fa-map-marker-alt', title: 'Job opportunities will be matched based on proximity.', description: 'Find jobs close to your location easily.', hover: false },
        { icon: 'fas fa-robot', title: 'AI-driven skill-based job matching.', description: 'Our AI matches jobs based on your skills.', hover: false },
        { icon: 'fas fa-briefcase', title: 'Candidates will be matched with relevant jobs.', description: 'Get matched with jobs that suit your profile.', hover: false },
        { icon: 'fas fa-comments', title: 'Career counseling and support.', description: 'Receive professional career counseling.', hover: false },
      ],
      testimonials: [
        { quote: 'JobPortal helped me find my dream job!', author: 'John Doe', id: 1, hover: false },
        { quote: 'Great service and support throughout the job search process.', author: 'Jane Smith', id: 2, hover: false },
        { quote: 'I highly recommend JobPortal to all jobseekers.', author: 'Sam Wilson', id: 3, hover: false },
      ],
      statistics: [
        { value: '1M+', label: 'Job Listings' },
        { value: '500K+', label: 'Successful Hires' },
        { value: '100K+', label: 'Companies' },
        { value: '50+', label: 'Countries' },
      ],
    };
  },
};
</script>

<style scoped>
#home {
  text-align: center;
}
.jumbotron {
  padding: 2rem 1rem;
  background-color: #f8f9fa;
  border-radius: 0.3rem;
}
.card {
  margin-bottom: 20px;
  transition: transform 0.3s, box-shadow 0.3s;
}
.card-hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
.card-hover-text {
  font-size: 0.9rem;
  color: #555;
}
.stat-box {
  background-color: #f8f9fa;
  padding: 20px;
  border-radius: 5px;
  margin-bottom: 20px;
}
footer {
  text-align: left;
}
.nav-link:hover {
  font-weight: bold;
  color: #007bff !important;
}
.card-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 10px;
}
.navbar-brand {
  flex-grow: 1;
  text-align: center;
}
.container .navbar-nav {
  flex-direction: row;
}

/* Animation classes from Animate.css */
@import 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css';
</style>
