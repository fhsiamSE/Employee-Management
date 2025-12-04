<template>
  <div>
    <h1>Apply</h1>
    <div v-if="successMessage" style="color: green; margin-bottom: 1rem;">
      {{ successMessage }}
    </div>
    <div v-if="errorMessage" style="color: red; margin-bottom: 1rem;">
      {{ errorMessage }}
    </div>
    <form @submit.prevent="submit" enctype="multipart/form-data">
      <div>
        <label>Name</label>
        <input v-model="form.name" type="text" required />
      </div>
      <div>
        <label>Email</label>
        <input v-model="form.email" type="email" required />
      </div>
      <div>
        <label>Phone</label>
        <input v-model="form.phone" type="text" />
      </div>
      <div>
        <label>CV (pdf/doc)</label>
        <input ref="cv" type="file" @change="handleFile" required />
      </div>
      <button type="submit" :disabled="loading">
        {{ loading ? 'Submitting...' : 'Submit Application' }}
      </button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        cv: null,
      },
      loading: false,
      successMessage: '',
      errorMessage: '',
    };
  },
  methods: {
    handleFile(e) {
      this.form.cv = e.target.files[0];
    },
    submit() {
      this.errorMessage = '';
      this.successMessage = '';
      this.loading = true;

      const payload = new FormData();
      payload.append('name', this.form.name);
      payload.append('email', this.form.email);
      payload.append('phone', this.form.phone || '');
      if (this.form.cv) payload.append('cv', this.form.cv);

      window.axios
        .post('/apply', payload)
        .then((response) => {
          this.successMessage = 'Application submitted successfully!';
          // Reset form
          this.form = { name: '', email: '', phone: '', cv: null };
          this.$refs.cv.value = '';
          this.loading = false;
        })
        .catch((error) => {
          this.loading = false;
          if (error.response && error.response.data.errors) {
            this.errorMessage = Object.values(error.response.data.errors)
              .flat()
              .join(', ');
          } else if (error.response && error.response.data.message) {
            this.errorMessage = error.response.data.message;
          } else {
            this.errorMessage = error.message || 'An error occurred';
          }
          console.error('Form error:', error);
        });
    },
  },
};
</script>
