<script setup lang="ts">

const props = defineProps<{data: EventData}>()
</script>

<template>
    <VContainer>
        <table>
            <tbody>
                <tr>
                    <td>Ort:</td>
                    <td>{{ data.location }}</td>
                </tr>
                <tr>
                    <td>Zeit:</td>
                    <td>{{ data.time }}</td>
                </tr>
                <tr>
                    <td>Eintritt:</td>
                    <td>{{ data.price }}</td>
                </tr>
            </tbody>
        </table>
    </VContainer>
</template>

<style scoped>
tr td:nth-child(1) {
    font-weight: bold;
}

tr td:nth-child(2) {
    padding-left: 12px;
}
</style>