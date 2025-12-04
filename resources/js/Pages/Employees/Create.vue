<template>
  <div>
    <h1>Create Employee</h1>
    <form @submit.prevent="submit">
      <div>
        <label>First name</label>
        <input v-model="form.first_name" />
      </div>
      <div>
        <label>Last name</label>
        <input v-model="form.last_name" />
      </div>
      <div>
        <label>Email</label>
        <input v-model="form.email" />
      </div>
      <div>
        <label>Phone</label>
        <input v-model="form.phone" />
      </div>
      <div>
        <label>Position</label>
        <input v-model="form.position" />
      </div>
      <button type="submit">Save</button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  data() {
    return {
      form: {
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        position: '',
        department: '',
        hired_at: '',
      },
    };
  },
  methods: {
    submit() {
      Inertia.post(route('employees.store'), this.form);
    },
  },
};
</script>
