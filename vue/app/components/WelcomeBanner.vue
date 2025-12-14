<template>
  <div>
    <h1>Willkommen beim Brettspielverein Zofingen</h1>
    <h2 class="flex gap-4">
      <div>Brettspiele</div>
      <TextScroller
        class="text-(--color-primary-600)"
        :items="['verbinden uns', 'machen Spass']"
      />
    </h2>
  </div>
</template>
