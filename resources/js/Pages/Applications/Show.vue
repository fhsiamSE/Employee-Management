<template>
  <div>
    <h1>Application: {{ application.name }}</h1>
    <p><strong>Email:</strong> {{ application.email }}</p>
    <p><strong>Phone:</strong> {{ application.phone }}</p>
    <p><strong>Status:</strong> {{ application.status }}</p>

    <div v-if="successMessage" style="color: green; margin-bottom: 1rem;">
      {{ successMessage }}
    </div>
    <div v-if="errorMessage" style="color: red; margin-bottom: 1rem;">
      {{ errorMessage }}
    </div>

    <div>
      <a :href="`/storage/${application.cv_path}`" target="_blank">Download CV</a>
    </div>

    <div style="margin-top: 2rem;">
      <button @click="approve" :disabled="loading" style="margin-right: 1rem; padding: 0.5rem 1rem; background-color: green; color: white; border: none; cursor: pointer;">
        {{ loading ? 'Processing...' : 'Approve' }}
      </button>

      <button @click="reject" :disabled="loading" style="padding: 0.5rem 1rem; background-color: red; color: white; border: none; cursor: pointer;">
        {{ loading ? 'Processing...' : 'Reject' }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    application: Object,
  },
  data() {
    return {
      loading: false,
      successMessage: '',
      errorMessage: '',
    };
  },
  methods: {
    approve() {
      this.loading = true;
      this.errorMessage = '';
      this.successMessage = '';

      window.axios
        .post(`/admin/applications/${this.application.id}/approve`)
        .then((response) => {
          this.successMessage = 'Application approved! Redirecting...';
          setTimeout(() => {
            window.location.href = '/admin/applications';
          }, 1000);
        })
        .catch((error) => {
          this.loading = false;
          if (error.response && error.response.data.message) {
            this.errorMessage = error.response.data.message;
          } else {
            this.errorMessage = error.message || 'An error occurred';
          }
          console.error('Approve error:', error);
        });
    },
    reject() {
      this.loading = true;
      this.errorMessage = '';
      this.successMessage = '';

      window.axios
        .post(`/admin/applications/${this.application.id}/reject`)
        .then((response) => {
          this.successMessage = 'Application rejected! Redirecting...';
          setTimeout(() => {
            window.location.href = '/admin/applications';
          }, 1000);
        })
        .catch((error) => {
          this.loading = false;
          if (error.response && error.response.data.message) {
            this.errorMessage = error.response.data.message;
          } else {
            this.errorMessage = error.message || 'An error occurred';
          }
          console.error('Reject error:', error);
        });
    },
  },
};
</script>
