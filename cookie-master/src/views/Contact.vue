<template>
  <div id="contact">
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

    <!-- Contact Content -->
    <section class="bg-primary text-white text-center py-5">
      <div class="container">
        <h1 class="display-4 animate__animated animate__fadeInDown">Contact Us</h1>
        <p class="lead animate__animated animate__fadeInUp">We are here to assist you. Reach out to us through any of the following means.</p>
      </div>
    </section>

    <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6 animate__animated animate__fadeInLeft">
            <h2>Get in Touch</h2>
            <p>If you have any questions or need assistance, feel free to contact us.</p>
            <ul class="list-unstyled">
              <li><i class="fas fa-phone"></i> 1300 22 8000</li>
              <li><i class="fas fa-envelope"></i> JobPortal@.gov.my</li>
              <li><i class="fas fa-map-marker-alt"></i> Find a Satellite Centre</li>
            </ul>
          </div>
          <div class="col-md-6 animate__animated animate__fadeInRight">
            <h2>Follow Us</h2>
            <p>Stay connected with us through social media.</p>
            <div>
              <a href="#" class="text-primary mr-3"><i class="fab fa-facebook fa-2x"></i></a>
              <a href="#" class="text-primary mr-3"><i class="fab fa-twitter fa-2x"></i></a>
              <a href="#" class="text-primary mr-3"><i class="fab fa-linkedin fa-2x"></i></a>
              <a href="#" class="text-primary mr-3"><i class="fab fa-instagram fa-2x"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>

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
              <li><router-link to="/joblist">JobList</router-link></li>
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
export default {
  name: 'ContactJob',
};
</script>

<style scoped>
@import 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css';
@import '@fortawesome/fontawesome-free/css/all.css';

#contact {
  text-align: center;
}
.bg-primary {
  background-color: #007bff !important;
}
.text-primary {
  color: #007bff !important;
}
.navbar-brand {
  flex-grow: 1;
  text-align: center;
}
.container .navbar-nav {
  flex-direction: row;
}
.nav-link:hover {
  font-weight: bold;
  color: #007bff !important;
}
</style>
