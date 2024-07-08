<template>
  <div id="interview-tips">
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

    <!-- Interview Tips Content -->
    <header class="bg-primary text-white text-center py-5">
      <div class="container">
        <h1 class="display-4 animate__animated animate__fadeInDown">Interview Tips</h1>
        <p class="lead animate__animated animate__fadeInUp">Ace your next interview with our expert tips and advice.</p>
      </div>
    </header>

    <section class="py-5">
      <div class="container">
        <h2 class="text-center animate__animated animate__fadeInUp">Top Tips for Interview Success</h2>
        <div class="row mt-4">
          <div class="col-md-6 animate__animated animate__fadeInLeft">
            <h3>1. Research the Company</h3>
            <p>Learn about the company's history, mission, values, and culture. This will help you tailor your answers and show that you're genuinely interested in the position.</p>
          </div>
          <div class="col-md-6 text-center animate__animated animate__fadeInRight">
            <i class="fas fa-search fa-3x text-primary"></i>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-6 text-center animate__animated animate__fadeInLeft">
            <i class="fas fa-user-tie fa-3x text-primary"></i>
          </div>
          <div class="col-md-6 animate__animated animate__fadeInRight">
            <h3>2. Dress Appropriately</h3>
            <p>First impressions matter. Choose an outfit that's professional and appropriate for the company's culture. When in doubt, it's better to be slightly overdressed than underdressed.</p>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-6 animate__animated animate__fadeInLeft">
            <h3>3. Practice Common Interview Questions</h3>
            <p>Prepare answers to common interview questions such as "Tell me about yourself," "What are your strengths and weaknesses," and "Why do you want to work here?" Practice with a friend or in front of a mirror.</p>
          </div>
          <div class="col-md-6 text-center animate__animated animate__fadeInRight">
            <i class="fas fa-comments fa-3x text-primary"></i>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-6 text-center animate__animated animate__fadeInLeft">
            <i class="fas fa-clock fa-3x text-primary"></i>
          </div>
          <div class="col-md-6 animate__animated animate__fadeInRight">
            <h3>4. Be Punctual</h3>
            <p>Arrive at least 10-15 minutes early. This shows that you're organized, reliable, and respectful of the interviewer's time.</p>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-6 animate__animated animate__fadeInLeft">
            <h3>5. Follow Up</h3>
            <p>Send a thank-you email within 24 hours of your interview. Express your gratitude for the opportunity and reiterate your interest in the position.</p>
          </div>
          <div class="col-md-6 text-center animate__animated animate__fadeInRight">
            <i class="fas fa-envelope fa-3x text-primary"></i>
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
  name: 'InterviewTips',
};
</script>

<style scoped>
@import 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css';
@import '@fortawesome/fontawesome-free/css/all.css';

#interview-tips {
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
