<template>
  <div>
    <h1>Applications</h1>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="app in applications.data" :key="app.id">
          <td>{{ app.name }}</td>
          <td>{{ app.email }}</td>
          <td>{{ app.status }}</td>
          <td>
            <a :href="`/admin/applications/${app.id}`" style="color: blue; cursor: pointer;">Review</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    applications: Object,
  },
};
</script>
