<script setup lang="ts">
import * as z from "zod";

const schema = z.object({
  fullName: zodRequiredString("Namen"),
  email: z.email("Ungültige E-Mail"),
  message: zodRequiredString("Nachricht"),
});
type Schema = z.output<typeof schema>;
const state = reactive<Partial<Schema>>({
  fullName: undefined,
  email: undefined,
  message: undefined,
});

const { post } = usePhpBackend("question");
const emit = defineEmits<{ onSubmission: [status: AlertStatus] }>();

function onSubmit() {
  post(state)
    .then(() => {
      emit("onSubmission", {
        message: "Deine Frage wurde geschickt. Wir melden uns bei dir!",
        type: "success",
      });
    })
    .catch((err) => {
      console.error(err);
      emit("onSubmission", {
        message: "Frage konnte nicht geschickt werden. Bitte versuche es später erneut",
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
    <div class="flex flex-col lg:flex-row justify-stretch gap-4">
      <UFormField
        name="fullName"
        class="grow"
        required
      >
        <UInput
          v-model="state.fullName"
          label="fullName"
          placeholder="Name"
          size="xl"
          class="w-full"
          :ui="{
            base: 'rounded-full',
          }"
        />
      </UFormField>
      <UFormField
        name="email"
        class="grow"
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
    </div>
    <UFormField
      name="message"
      required
    >
      <UTextarea
        v-model="state.message"
        label="message"
        placeholder="Nachricht"
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
      Absenden
    </UButton>
  </UForm>
</template>
