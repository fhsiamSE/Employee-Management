<template>
  <div>
    <h1>Employees</h1>
    <inertia-link :href="route('employees.create')">Create Employee</inertia-link>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Position</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="employee in employees.data" :key="employee.id">
          <td>{{ employee.first_name }} {{ employee.last_name }}</td>
          <td>{{ employee.email }}</td>
          <td>{{ employee.position }}</td>
          <td>
            <inertia-link :href="route('employees.edit', employee.id)">Edit</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>

    <div>
      <!-- basic pagination links -->
      <button v-if="employees.prev_page_url" @click="$inertia.get(employees.prev_page_url)">Previous</button>
      <button v-if="employees.next_page_url" @click="$inertia.get(employees.next_page_url)">Next</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    employees: Object,
  },
};
</script>
