<script setup lang="ts">
import * as z from "zod";

const schema = z.object({
  email: z.email("Ungültige E-Mail"),
});
type Schema = z.output<typeof schema>;
const state = reactive<Partial<Schema>>({
  email: undefined,
});

const { post } = usePhpBackend("newsletter");
const emit = defineEmits<{ onSubmission: [status: AlertStatus] }>();

function onSubmit() {
  post({ email: state.email })
    .then(() => {
      emit("onSubmission", {
        message: "Erfolgreich für den Newsletter registriert",
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
    :schema="schema"
    :state="state"
    @submit="onSubmit"
  >
    <UFormField
      name="email"
    >
      <UInput
        v-model="state.email"
        placeholder="Email"
        size="xl"
        class="w-full"
        :ui="{
          base: 'rounded-full',
        }"
      >
        <template #trailing>
          <UButton
            class="rounded-full uppercase"
            size="lg"
            type="submit"
          >
            Abonnieren
          </UButton>
        </template>
      </UInput>
    </UFormField>
  </UForm>
</template>
