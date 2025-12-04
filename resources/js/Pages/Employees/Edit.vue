<template>
  <div>
    <h1>Edit Employee</h1>
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
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    employee: Object,
  },
  data() {
    return {
      form: Object.assign({}, this.employee),
    };
  },
  methods: {
    submit() {
      Inertia.put(route('employees.update', this.employee.id), this.form);
    },
  },
};
</script>
