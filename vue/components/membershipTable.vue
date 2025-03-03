<script setup lang="ts"></script>

<template>
  <div class="">
    <VTable class="w-100 rounded-xl">
      <thead>
        <tr>
          <th>Jährlich</th>
          <th>50.-</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1 Jahr Gratiseintritt</td>
          <td><VIcon icon="mdi-check" size="small"></VIcon></td>
        </tr>
        <tr>
          <td>Verleih der Vereinsspiele</td>
          <td><VIcon icon="mdi-check" size="small"></VIcon></td>
        </tr>
      </tbody>
    </VTable>
  </div>
</template>

<style scoped lang="scss">
table {
  --table-padding: 15px;
  border-collapse: collapse;
  thead {
    tr {
      background-color: rgb(var(--v-theme-header));
      color: white;
    }
  }
  tbody {
    tr:nth-child(even) {
      background-color: rgb(var(--v-theme-secondary));
    }
  }
  td {
    padding: var(--table-padding);
    font-weight: bold;
  }
  th {
    padding: var(--table-padding);
    font-weight: bold !important;
    justify-self: center;
  }
}
</style>
