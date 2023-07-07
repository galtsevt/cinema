<template>
    <div
        class="bg-white dark:bg-gray-800 dark:text-white shadow rounded-lg transition-all ease-linear duration-300">
        <div v-if="$slots.header"
             class="p-2 px-4 text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
            <slot name="header"/>
        </div>
        <slot name="image"/>
        <div class="p-2 sm:px-4 sm:py-5">
            <slot/>
        </div>
        <slot name="footer"/>
    </div>
</template>

<script>
export default {
    name: "Card"
}
</script>

<style scoped>

</style>
