<script setup lang="ts">
const formData = reactive({
  name: "",
  email: "",
  message: "",
});
const isFormValid = ref(false);

function submit(event: SubmitEvent) {
  if (isFormValid.value) {
    alert(`This needs to be implemented!\n${JSON.stringify(formData)}`);
  }
}
</script>

<template>
  <VForm v-model="isFormValid" @submit.prevent="submit">
    <VContainer>
      <VRow class="ga-4">
        <VTextField bg-color="background" label="Name" v-model="formData.name" rounded="xl" :rules="[required]"
          validate-on="blur" variant="solo"></VTextField>
        <VTextField bg-color="background" type="email" label="Email" v-model="formData.email" rounded="xl"
          :rules="[required, validEmail]" validate-on="blur" variant="solo"></VTextField>
      </VRow>
      <VRow>
        <VTextarea bg-color="background" label="Nachricht" v-model="formData.message" rounded="xl" :rules="[required]"
          variant="solo">
        </VTextarea>
      </VRow>
      <VRow>
        <VBtn type="submit" class="w-100 text-onPrimary" color="primary" rounded="pill">Anmelden</VBtn>
      </VRow>
    </VContainer>
  </VForm>
</template>

<style scoped></style>
