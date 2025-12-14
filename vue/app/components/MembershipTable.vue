<script setup lang="ts"></script>

<template>
  <div>
    <table class="w-full">
      <thead>
        <tr>
          <th>Jährlich</th>
          <th>50.-</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1 Jahr Gratiseintritt</td>
          <td>
            <UIcon
              name="mdi-check-circle"
              class="bg-success"
            />
          </td>
        </tr>
        <tr>
          <td>Verleih der Vereinsspiele</td>
          <td>
            <UIcon
              name="mdi-check-circle"
              class="bg-success"
            />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped lang="scss">
table {
  --table-padding: 15px;
  --table-radius: var(--radius-xl);
  border-collapse: separate;
  border-spacing: 0;

  thead {
    tr {
      th {
        background-color: var(--ui-header);
        color: white;
        &:first-child {
          border-top-left-radius: var(--table-radius);
        }
        &:last-child {
          border-top-right-radius: var(--table-radius);
        }
      }
    }
  }

  tbody {
    tr:nth-child(even) {
      td {
        background-color: var(--ui-secondary);
      }
    }
    tr:last-child {
      td:first-child {
        border-bottom-left-radius: var(--table-radius);
      }
      td:last-child {
        border-bottom-right-radius: var(--table-radius);
      }
    }
  }

  td,
  th {
    padding: var(--table-padding);
    font-weight: bold;
  }

  th {
    text-align: left;
  }
}
</style>
