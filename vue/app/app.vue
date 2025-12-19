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
      :ui="{
        center: 'md:flex',
      }"
    >
      <template #right>
        <USlideover
          :close="{
            color: 'secondary',
            variant: 'ghost',
          }"
          :ui="{
            content: 'bg-header text-secondary max-w-3xs',
          }"
        >
          <UButton
            icon="mdi-menu"
            variant="ghost"
            color="secondary"
            class="md:hidden rounded-full"
          />
          <template #title>
            <h2 class="text-secondary">
              Sektionen
            </h2>
          </template>
          <template #body>
            <div class="nav-container flex flex-col">
              <UButton
                v-for="target in goToTargets"
                :key="target.displayName"
                variant="link"
                color="neutral"
                :class="{ 'scrolled-over': target.scrolledBeginningToTop }"
                @click="target.goTo()"
              >
                {{ target.displayName }}
              </UButton>
            </div>
          </template>
        </USlideover>
      </template>
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
          :class="{ 'scrolled-over': target.scrolledBeginningToTop }"
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

.nav-container {
  *:hover{
    color: var(--ui-bg);
  }
  & :nth-last-child(1 of .scrolled-over) {
    color: var(--ui-primary);
  }
}
</style>
