<template>
  <div id="about">
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

    <!-- About Us Content -->
    <header class="bg-primary text-white text-center py-5">
      <div class="container">
        <h1 class="display-4 animate__animated animate__fadeInDown">About JOBPORTAL</h1>
        <p class="lead animate__animated animate__fadeInUp">Your trusted platform for finding the best job opportunities and career services.</p>
      </div>
    </header>

    <!-- Our Mission Section -->
    <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6 animate__animated animate__fadeInLeft">
            <h2>Our Mission</h2>
            <p>At JOBPORTAL, our mission is to bridge the gap between job seekers and employers by providing a comprehensive platform for job listings, career services, and professional development.</p>
          </div>
          <div class="col-md-6 text-center animate__animated animate__fadeInRight">
            <i class="fas fa-bullseye fa-5x text-primary"></i>
          </div>
        </div>
      </div>
    </section>

    <!-- Our Values Section -->
    <section class="bg-light py-5">
      <div class="container">
        <h2 class="text-center animate__animated animate__fadeInUp">Our Values</h2>
        <div class="row mt-4">
          <div class="col-md-4 text-center animate__animated animate__zoomIn">
            <i class="fas fa-handshake fa-3x mb-3 text-primary"></i>
            <h4>Integrity</h4>
            <p>We uphold the highest standards of integrity in all of our actions.</p>
          </div>
          <div class="col-md-4 text-center animate__animated animate__zoomIn">
            <i class="fas fa-users fa-3x mb-3 text-primary"></i>
            <h4>Community</h4>
            <p>We work together, across boundaries, to meet the needs of our customers.</p>
          </div>
          <div class="col-md-4 text-center animate__animated animate__zoomIn">
            <i class="fas fa-lightbulb fa-3x mb-3 text-primary"></i>
            <h4>Innovation</h4>
            <p>We foster innovation to make a difference in the lives of job seekers and employers.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Our Team Section -->
    <section class="py-5">
      <div class="container">
        <h2 class="text-center animate__animated animate__fadeInUp">Meet Our Team</h2>
        <div class="row mt-4">
          <div class="col-md-3 text-center animate__animated animate__zoomIn">
            <img src="path/to/team1.jpg" class="rounded-circle mb-3" alt="Team Member 1">
            <h5>John Doe</h5>
            <p>CEO</p>
          </div>
          <div class="col-md-3 text-center animate__animated animate__zoomIn">
            <img src="path/to/team2.jpg" class="rounded-circle mb-3" alt="Team Member 2">
            <h5>Jane Smith</h5>
            <p>CTO</p>
          </div>
          <div class="col-md-3 text-center animate__animated animate__zoomIn">
            <img src="path/to/team3.jpg" class="rounded-circle mb-3" alt="Team Member 3">
            <h5>Sam Wilson</h5>
            <p>COO</p>
          </div>
          <div class="col-md-3 text-center animate__animated animate__zoomIn">
            <img src="path/to/team4.jpg" class="rounded-circle mb-3" alt="Team Member 4">
            <h5>Anna Brown</h5>
            <p>CFO</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="bg-light py-5">
      <div class="container">
        <h2 class="text-center animate__animated animate__fadeInUp">Contact Us</h2>
        <div class="row mt-4">
          <div class="col-md-6 animate__animated animate__fadeInLeft">
            <h5>Get in Touch</h5>
            <p>If you have any questions or need assistance, feel free to contact us.</p>
            <ul class="list-unstyled">
              <li><i class="fas fa-phone"></i> 1300 22 8000</li>
              <li><i class="fas fa-envelope"></i> JobPortal@.gov.my</li>
              <li><i class="fas fa-map-marker-alt"></i> Find a Satellite Centre</li>
            </ul>
          </div>
          <div class="col-md-6 animate__animated animate__fadeInRight">
            <h5>Follow Us</h5>
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
  name: 'AboutUs',
};
</script>

<style scoped>
@import 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css';
@import '@fortawesome/fontawesome-free/css/all.css';

#about {
  text-align: center;
}
header {
  background: #007bff;
  color: white;
}
header .lead {
  font-size: 1.25rem;
}
section {
  padding: 4rem 0;
}
.section-heading {
  margin-bottom: 3rem;
}
i {
  color: #007bff;
}
.rounded-circle {
  width: 150px;
  height: 150px;
  object-fit: cover;
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
