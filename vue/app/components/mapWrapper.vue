<template>
  <div class="gmap_canvas">
    <iframe
      class="w-100 h-100 rounded-xl"
      id="gmap_canvas"
      src="https://maps.google.com/maps?q=Strengelbacherstrasse29&t=&z=15&ie=UTF8&iwloc=&output=embed"
      frameborder="0"
      scrolling="no"
      marginheight="0"
      marginwidth="0"
    >
    </iframe>
  </div>
</template>

<style scoped>
.gmap_canvas {
  overflow: hidden;
  background: none !important;
  height: 300px;
  width: 100%;
}
</style>
