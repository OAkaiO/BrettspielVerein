<script setup lang="ts">
import type { VNodeArrayChildren } from "vue";

const { title } = defineProps<{
  title: string;
}>();

const emit = defineEmits<{
  provideNavigation: [navInfo: HeaderSpec];
}>();

onMounted(() => {
  const instance = getCurrentInstance();
  emit("provideNavigation", { displayName: title, goTo: () => {
    const slot = (instance?.subTree.children as VNodeArrayChildren)?.at(0) as VNode;
    slot.el!.scrollIntoView({ behavior: "smooth" });
  } });
});
</script>

<template>
  <slot />
</template>

<style scoped>
/* This seems to be the only way to actually apply the margin style to the slot without having to define a wrapping div */
:slotted(*) {
  scroll-margin: var(--ui-header-height);
}
</style>
