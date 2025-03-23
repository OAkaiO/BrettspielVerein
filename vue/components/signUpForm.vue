<script setup lang="ts">
const formData = reactive({
  firstName: "",
  lastName: "",
  address: "",
  city: "",
  email: "",
  comment: "",
});
const isFormValid = ref(false);

function submit(event: SubmitEvent) {
  if (isFormValid.value) {
    alert(`This needs to be implemented!\n${JSON.stringify(formData)}`);
  }
}
</script>

<template>
  <VSheet class="pa-5 bg-header rounded-xl">
    <h3 class="mb-3">Werde Mitglied</h3>
    <VForm v-model="isFormValid" @submit.prevent="submit">
      <VTextField
        bg-color="background"
        label="Vorname"
        v-model="formData.firstName"
        rounded="xl"
        :rules="[required]"
        validate-on="blur"
        variant="solo"
      ></VTextField>
      <VTextField
        bg-color="background"
        label="Nachname"
        v-model="formData.lastName"
        rounded="xl"
        :rules="[required]"
        validate-on="blur"
        variant="solo"
      ></VTextField>
      <VTextField
        bg-color="background"
        label="Adresse"
        v-model="formData.address"
        rounded="xl"
        :rules="[required]"
        validate-on="blur"
        variant="solo"
      ></VTextField>
      <VTextField
        bg-color="background"
        label="PLZ + Wohnort"
        v-model="formData.city"
        rounded="xl"
        :rules="[required]"
        validate-on="blur"
        variant="solo"
      ></VTextField>
      <VTextField
        bg-color="background"
        type="email"
        label="Email"
        v-model="formData.email"
        rounded="xl"
        :rules="[required, validEmail]"
        validate-on="blur"
        variant="solo"
      ></VTextField>
      <VTextarea
        bg-color="background"
        label="Kommentar"
        v-model="formData.comment"
        rounded="xl"
        variant="solo"
      ></VTextarea>
      <VBtn
        type="submit"
        class="w-100 text-onPrimary"
        color="primary"
        rounded="pill"
        >Anmelden</VBtn
      >
    </VForm>
  </VSheet>
</template>

<style lang="scss" scoped></style>
