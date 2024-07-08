import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

const app = createApp(App);

// Set up the initial current user (replace with actual fetching logic if needed)
const currentUser = JSON.parse(localStorage.getItem('currentUser')) || {
  id: 1, // Default value for demo; replace with actual user fetching logic
};

// Provide the current user data globally
app.provide('currentUser', currentUser);

// Method to update the current user
app.provide('setCurrentUser', (user) => {
  currentUser.id = user.id;
  localStorage.setItem('currentUser', JSON.stringify(user));
});

app.use(router);
app.mount('#app');
