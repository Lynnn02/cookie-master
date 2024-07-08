const initialApplications = [
  {
    id: 1,
    jobId: 1,
    userId: 1,
    applicantName: 'John Doe',
    applicantEmail: 'john@example.com',
    introduction: 'My introduction',
    resume: 'resume.pdf',
    status: 'pending',
  },
  {
    id: 2,
    jobId: 2,
    userId: 2,
    applicantName: 'Jane Smith',
    applicantEmail: 'jane@example.com',
    introduction: 'My introduction',
    resume: 'resume.pdf',
    status: 'pending',
  },
];

export const applications = JSON.parse(localStorage.getItem('applications')) || initialApplications;

export const jobs = [
  {
    id: 1,
    title: 'Software Developer',
    description: 'Develop and maintain software applications.',
    details: 'As a Software Developer, you will be responsible for developing and maintaining our software applications. You should have strong experience in JavaScript and familiarity with frameworks like React or Vue.js. A good understanding of RESTful APIs is also required.',
    location: 'Kuala Lumpur',
    type: 'Full-time',
    salaryMin: 5000,
    salaryMax: 7000,
    company: 'Tech Innovators Inc.',
  },
  {
    id: 2,
    title: 'Graphic Designer',
    description: 'Create visual concepts to communicate ideas.',
    details: 'We are looking for a creative Graphic Designer to create visual concepts that inspire, inform, and captivate consumers. Proficiency in Adobe Creative Suite (Photoshop, Illustrator, InDesign) is required.',
    location: 'Penang',
    type: 'Part-time',
    salaryMin: 3000,
    salaryMax: 4000,
    company: 'Creative Studio',
  },
  {
    id: 3,
    title: 'Data Scientist',
    description: 'Analyze data and provide insights.',
    details: 'As a Data Scientist, you will be responsible for analyzing large amounts of raw information to find patterns and insights. You should have a strong background in mathematics, statistics, and programming (Python/R). Experience with machine learning is a plus.',
    location: 'Johor Bahru',
    type: 'Contract',
    salaryMin: 8000,
    salaryMax: 10000,
    company: 'Data Analytics Co.',
  },
];

export const reviews = [
  {
    id: 1,
    userId: 1,
    jobId: 1,
    company: 'Tech Innovators Inc.',
    category: 'Salary',
    rating: 4,
    comment: 'Good salary package.',
  },
  {
    id: 2,
    userId: 2,
    jobId: 1,
    company: 'Tech Innovators Inc.',
    category: 'Work Environment',
    rating: 5,
    comment: 'Excellent work environment.',
  },
  {
    id: 3,
    userId: 3,
    jobId: 2,
    company: 'Creative Studio',
    category: 'Management',
    rating: 3,
    comment: 'Average management.',
  },
];


export const users = [
  {
    id: 1,
    name: 'John Doe',
    email: 'john@example.com',
    password: 'password123',
    role: 'applicant',
    company: 'Tech Innovators Inc.',
  },
  {
    id: 2,
    name: 'Jane Smith',
    email: 'jane@example.com',
    password: 'password123',
    role: 'applicant',
    company: 'Creative Studio',
  },
  {
    id: 3,
    name: 'Admin User',
    email: 'admin@example.com',
    password: 'admin123',
    role: 'employer',
    company: 'Tech Innovators Inc.',
  },
];

// Simulate the current logged-in user
export let currentUser = users[2]; // Default to the employer user

export function setCurrentUser(user) {
  currentUser = user;
}
