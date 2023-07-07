<template>
    <div>
        <label :for="name" class="block mb-2 text-sm font-medium font-bold" :class="labelClass">{{ label }}:</label>

        <select :id="name"
                :class="inputClass"
                :value="modelValue"
                @input="updateInput"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option v-if="data" v-for="item in data" :value="item.key">{{ item.value }}</option>
        </select>
        <p v-if="errors" v-for="error in errors"
           class="mt-1 mb-0 text-xs text-red-600 dark:text-red-500">
            {{ error }} </p>
    </div>
</template>

<script>
export default {
    name: "SelectUi",
    props: {
        data: null,
        type: 'text',
        name: null,
        label: null,
        errors: null,
        modelValue: null,
        placeholder: null,
    },
    computed: {
        inputClass() {
            if (this.errors) {
                return 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
            } else {
                return 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
            }
        },
        labelClass() {
            if (this.errors) {
                return 'text-red-700 dark:text-red-500'
            } else {
                return 'text-gray-900 dark:text-white'
            }
        }
    },
    methods: {
        updateInput(event) {
            this.$emit('update:modelValue', event.target.value);
        }
    }
}
</script>

<style scoped>

</style>
