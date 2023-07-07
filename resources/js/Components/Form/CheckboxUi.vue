<template>
    <div>
        <div class="flex items-center mb-1">
            <input :id="name" type="checkbox" value="" :class="inputClass" class="" :value="modelValue"
                   :checked="modelValue" @input="updateInput">
            <label :for="name" class="ml-2 text-sm font-medium" :class="labelClass">{{ label }}</label>
        </div>
        <p v-if="errors" v-for="error in errors"
           class="mt-1 mb-0 text-xs text-red-600 dark:text-red-500">
            {{ error }} </p>
    </div>
</template>

<script>
export default {
    name: "CheckboxUi",
    props: {
        name: null,
        label: null,
        errors: null,
        modelValue: false,
        placeholder: null,
    },
    computed: {
        inputClass() {
            if (this.errors) {
                return 'w-4 h-4 text-red-600 bg-red-200 border-red-400 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-red-600 dark:border-red-700'
            } else {
                return 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'
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
            let isChecked = event.target.checked
            this.$emit('update:modelValue', !!isChecked);
        }
    }
}
</script>

<style scoped>

</style>
