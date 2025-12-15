<script setup lang="ts">

</script>

<template>
  <div class="flex justify-between items-end">
    <div>
      <LogoTextWrapper />
      <NuxtLink
        class="hover-link"
        href="/privacy"
      >Datenschutzerklärung
      </NuxtLink>
    </div>
    <UButton
      icon="mdi-instagram"
      color="header"
      size="xl"
      to="https://www.instagram.com/BrettspielZofingen"
      class="rounded-full"
    />
  </div>
</template>
