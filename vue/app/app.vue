<script setup lang="ts">
const goToTargets = ref<HeaderSpec[]>([]);

function handleNavigation(event: HeaderSpec[]) {
  goToTargets.value = event;
}

const router = useRouter();
router.beforeResolve(() => {
  resetNavigation();
});
function resetNavigation() {
  goToTargets.value = [];
}
</script>

<template>
  <UApp>
    <UHeader
      class="bg-header border-0 z-1100"
      :toggle="false"
    >
      <template #title>
        <LogoTextWrapper
          light
          class="no-react-link grow-link"
        />
      </template>
      <div class="nav-container">
        <UButton
          v-for="target in goToTargets"
          :key="target.displayName"
          variant="link"
          color="neutral"
          @click="target.goTo()"
        >
          {{ target.displayName }}
        </UButton>
      </div>
    </UHeader>
    <UMain>
      <NuxtPage
        @provide-navigation="handleNavigation"
      />
    </UMain>
    <footer>
      <WaveVariant1
        lower
        color="--ui-footer"
        class="absolute w-full -z-1"
      />
      <UContainer class="pt-10">
        <FooterLinks />
      </UContainer>
    </footer>
  </UApp>
</template>

<style scoped lang="scss">
.footer {
  height: 100%;
  min-height: 240px;
  display: relative;
}

.no-react-link {
  &,
  &.visited,
  &:hover,
  &:active,
  &:link {
    color: black;
  }
}

.grow-link {
  transition: all 0.07s ease-in-out;

  &:hover {
    transform: scale(1.1);
  }
}

.nav-container :nth-last-child(1 of .scrolled-over) {
  color: rgb(var(--ui-primary));
}
</style>
