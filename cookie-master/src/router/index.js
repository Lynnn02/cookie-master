import { createRouter, createWebHistory } from "vue-router";

// Applicant views and components
import HomePage from "../views/HomePage.vue";
import LoginSelection from "../components/Auth/LoginSelection.vue";
import ApplicantLogin from "../components/Auth/ApplicantLogin.vue";
import EmployerLogin from "../components/Auth/EmployerLogin.vue";
import SignUp from "../components/Auth/SignUp.vue";
import JobList from "../components/Job/JobList.vue";
import JobDetails from "../components/Job/JobDetails.vue";
import ApplyJob from "../components/Job/ApplyJob.vue";
import AddReview from "../components/Applicant/AddReview.vue";
import ReviewList from "../components/Applicant/ReviewList.vue";
import ApplicationList from "../components/Applicant/ApplicationList.vue";
import UpdateApplication from "@/components/Job/UpdateApplication.vue";
import UpdateProfile from "../components/Applicant/UpdateProfile.vue";
import AboutUs from "../views/AboutUs.vue";
import Contact from "../views/Contact.vue";
import InterviewTips from "../views/InterviewTips.vue";
import EditReview from "../components/Applicant/EditReview.vue";

// Employer views and components
import EmployerHome from "../components/Admin/EmployerHome.vue";
import EmployerCreateJob from "../components/Admin/EmployerCreateJob.vue";
import EmployerManageApplications from "../components/Admin/EmployerManageApplications.vue";
import EmployerManageJobs from "../components/Admin/EmployerManageJobs.vue";
import EmployerProfile from "../components/Admin/EmployerProfile.vue";
import EmployerReviewList from "../components/Admin/EmployerReviewList.vue";
import EmployerEditJobs from "../components/Admin/EmployerEditJobs.vue";

// Define routes
// Define routes
const routes = [
  // Applicant routes
  { path: "/", name: "HomePage", component: HomePage },
  { path: "/login", name: "LoginSelection", component: LoginSelection },
  { path: "/applicant-login", name: "ApplicantLogin", component: ApplicantLogin },
  { path: "/employer-login", name: "EmployerLogin", component: EmployerLogin },
  { path: "/signup", name: "SignUp", component: SignUp },
  { path: "/joblist", name: "JobList", component: JobList },
  { path: "/jobdetails/:id", name: "JobDetails", component: JobDetails, props: true },
  { path: "/applyjob/:id", name: "ApplyJob", component: ApplyJob, props: true },
  { path: "/addreview/:id", name: "AddReview", component: AddReview, props: true },
  { path: "/editreview/:id", name: "EditReview", component: EditReview, props: true },
  { path: "/reviewlist/:id", name: "ReviewList", component: ReviewList, props: true },
  { path: "/applicationlist", name: "ApplicationList", component: ApplicationList },
  { path: "/updateapplication/:id", name: "UpdateApplication", component: UpdateApplication, props: true },
  { path: "/updateprofile", name: "UpdateProfile", component: UpdateProfile },
  { path: "/about", name: "AboutUs", component: AboutUs },
  { path: "/contact", name: "Contact", component: Contact },
  { path: "/interviewtips", name: "InterviewTips", component: InterviewTips },

  // Employer routes
  { path: "/admin/home", name: "EmployerHome", component: EmployerHome },
  { path: "/admin/createjob", name: "EmployerCreateJob", component: EmployerCreateJob },
  { path: "/admin/manageapplications", name: "EmployerManageApplications", component: EmployerManageApplications },
  { path: "/admin/managejobs", name: "EmployerManageJobs", component: EmployerManageJobs },
  { path: "/admin/profile", name: "EmployerProfile", component: EmployerProfile },
  { path: "/admin/reviewlist", name: "EmployerReviewList", component: EmployerReviewList },
  { path: "/admin/editjobs/:jobId", name: "EmployerEditJobs", component: EmployerEditJobs, props: true },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
