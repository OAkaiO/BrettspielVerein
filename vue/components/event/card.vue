<script setup lang="ts">

const props = defineProps<{ data: EventData }>()
</script>

<template>
    <VCard class="rounded-xl">
        <div class="d-flex flex-wrap">
            <VChip color="footer" variant="flat" class="ma-4" size="x-large" style="width: 100px;">
                {{ data.date }}
            </VChip>
            <VAvatar class="ma-3" rounded="0" size="250">
                <VImg src="../../public/Logo1.png"></VImg>
            </VAvatar>
            <div>
                <VCardTitle class="text-h5" style="white-space: normal;">
                    {{ data.title }}
                </VCardTitle>
                <EventDetails :data>
                </EventDetails>
            </div>
        </div>
    </VCard>
</template>