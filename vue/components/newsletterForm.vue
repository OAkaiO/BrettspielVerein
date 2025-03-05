<script setup lang="ts">
const isFormValid = ref(false);
const email = ref("");
function submit(event: SubmitEvent) {
  if (isFormValid.value) {
    alert(`This needs to be implemented! | Email=${email.value}`);
  }
}
</script>

<template>
  <VForm @submit.prevent v-model="isFormValid">
    <VTextField
      label="Email"
      elevation="0"
      rounded="xl"
      :rules="[required, validEmail]"
      type="email"
      variant="solo"
      v-model="email"
    >
      <template #append-inner>
        <VBtn
          @click="submit"
          class="text-onPrimary"
          elevation="0"
          rounded="pill"
          type="submit"
          color="primary"
          >Abonnieren</VBtn
        >
      </template>
    </VTextField>
  </VForm>
</template>

<style lang="scss" scoped></style>
