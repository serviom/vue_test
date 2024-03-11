<template>
    <span class="custom-prefix">{{ prefixText }}</span>
</template>

<script>
export default {
    props: {
        prefixText: String,
    },
};
</script>

<style scoped>
.custom-prefix {
}
</style>
