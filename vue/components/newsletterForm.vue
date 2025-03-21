<script setup lang="ts">
const isFormValid = ref(false);
const data = ref({ email: "" });

const { post } = usePhpBackend("newsletter.php");

function submit(event: SubmitEvent) {
  if (isFormValid.value) {
    post(data.value).catch((err) => console.error(err));
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
      v-model="data.email"
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
