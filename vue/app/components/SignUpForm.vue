<script setup lang="ts">
import * as z from "zod";

const schema = z.object({
  firstName: zodRequiredString("Vornamen"),
  lastName: zodRequiredString("Nachnamen"),
  address: zodRequiredString("Strasse"),
  address2: zodRequiredString("Ort"),
  email: z.email("Ungültige E-Mail"),
  message: z.string().optional(),
});
type Schema = z.output<typeof schema>;
const state = reactive<Partial<Schema>>({
  firstName: undefined,
  lastName: undefined,
  address: undefined,
  address2: undefined,
  email: undefined,
  message: undefined,
});

const { post } = usePhpBackend("register.php");
const emit = defineEmits<{ onSubmission: [status: AlertStatus] }>();

function onSubmit() {
  post(state)
    .then(() => {
      emit("onSubmission", {
        message: "Erfolgreich Anmeldung als Mitglied eingereicht",
        type: "success",
      });
    })
    .catch((err) => {
      console.error(err);
      emit("onSubmission", {
        message: "Registrierung fehlgeschlagen. Bitte versuche es später erneut",
        type: "warning",
      });
    });
}
</script>

<template>
  <UForm
    class="flex gap-4 flex-col"
    :schema="schema"
    :state="state"
    @submit="onSubmit"
  >
    <UFormField
      name="firstName"
      required
    >
      <UInput
        v-model="state.firstName"
        label="firstName"
        placeholder="Vorname"
        size="xl"
        class="w-full"
        :ui="{
          base: 'rounded-full',
        }"
      />
    </UFormField>
    <UFormField
      name="lastName"
      required
    >
      <UInput
        v-model="state.lastName"
        label="lastName"
        placeholder="Nachname"
        size="xl"
        class="w-full"
        :ui="{
          base: 'rounded-full',
        }"
      />
    </UFormField>
    <UFormField
      name="address"
      required
    >
      <UInput
        v-model="state.address"
        label="address"
        placeholder="Adresse"
        size="xl"
        class="w-full"
        :ui="{
          base: 'rounded-full',
        }"
      />
    </UFormField>
    <UFormField
      name="address2"
      required
    >
      <UInput
        v-model="state.address2"
        label="address2"
        placeholder="PLZ + Wohnort"
        size="xl"
        class="w-full"
        :ui="{
          base: 'rounded-full',
        }"
      />
    </UFormField>
    <UFormField
      name="email"
      required
    >
      <UInput
        v-model="state.email"
        label="email"
        placeholder="Email"
        size="xl"
        class="w-full"
        :ui="{
          base: 'rounded-full',
        }"
      />
    </UFormField>
    <UFormField
      name="message"
    >
      <UTextarea
        v-model="state.message"
        label="message"
        placeholder="Kommentar"
        size="xl"
        class="w-full"
        :ui="{
          base: 'rounded-xl',
        }"
      />
    </UFormField>
    <UButton
      class="rounded-full uppercase justify-center"
      size="lg"
      type="submit"
    >
      Anmelden
    </UButton>
  </UForm>
</template>
