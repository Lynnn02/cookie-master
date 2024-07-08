// state.js
export const state = {
    applications: [],
  };
  
  export const mutations = {
    addApplication(application) {
      state.applications.push(application);
    },
    removeApplication(jobId) {
      state.applications = state.applications.filter(app => app.jobId !== jobId);
    },
  };
  