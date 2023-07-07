<template>
    <button @click="switchTheme"
            class="transition duration-450 bg-slate-100 active:scale-95 dark:bg-slate-900 inline-flex items-center px-3 py-2 border border-gray-200 dark:border-gray-800 text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
        <SunIcon v-if="theme === 'light'" class="h-4 w-4 text-gray-400"/>
        <MoonIcon v-else-if="theme === 'dark'" class="h-4 w-4 text-gray-400"/>
    </button>
</template>

<script>
import Dropdown from "@/Components/Dropdown.vue";
import {SunIcon} from "@heroicons/vue/24/solid/index.js";
import {MoonIcon} from "@heroicons/vue/24/solid/index.js";

export default {
    name: "ThemeSwitch",
    components: {Dropdown, SunIcon, MoonIcon},
    data() {
        return {
            theme: null,
        }
    },
    mounted() {
        this.updateTheme()
    },
    methods: {
        switchTheme() {
            if (this.theme === 'dark') {
                this.toLightMode()
            } else {
                this.toDarkMode()
            }
        },
        updateTheme() {
            if (!('theme' in localStorage)) {
                localStorage.theme = 'system';
            }
            switch (localStorage.theme) {
                case 'system':
                    if (window.matchMedia('(prefers-color-scheme: dark').matches) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                    document.documentElement.setAttribute('color-theme', 'system');
                    this.theme = 'system'
                    break;
                case 'dark':
                    document.documentElement.classList.add('dark');
                    document.documentElement.setAttribute('color-theme', 'dark');
                    this.theme = 'dark'
                    break;
                case 'light':
                    document.documentElement.classList.remove('dark');
                    document.documentElement.setAttribute('color-theme', 'light');
                    this.theme = 'light'
                    break;
            }
        },
        toDarkMode() {
            localStorage.theme = 'dark';
            this.updateTheme();
        },
        toLightMode() {
            localStorage.theme = 'light';
            this.updateTheme();
        },
        toSystemMode() {
            localStorage.theme = 'system';
            this.updateTheme();
        }
    }
}
</script>

<style scoped>

</style>
