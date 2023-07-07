<template>
    <AuthenticatedLayout>
        <div class="my-8">
            <label for="default-search"
                   class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative z-10">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input v-model="searchValue" type="search" id="default-search"
                       class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Поиск" required>
                <button @click="search" type="submit"
                        class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <template v-if="loading">
                        <svg class="animate-spin -ml-1 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </template>
                    <template v-else>
                        Поиск
                    </template>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2" v-if="films">
            <Card v-for="film in films.data">
                <template #image>
                    <div class="rounded-t-lg relative aspect-[8/10]">
                        <img class="rounded-t-lg object-cover w-full h-full" :src="film.small_poster"
                             alt=""/>
                        <div class="absolute bottom-0 right-0 bg-blue-500 rounded-tl-lg p-1 text-gray-200 text-sm max-w-[90%] truncate overflow-hidden">
                            {{ film.genres_string }}
                        </div>
                        <div v-if="film.rating_kp"
                             class="absolute top-2 left-0 rounded-r-md px-2 py-1 text-gray-200 text-sm flex"
                             :class="{
                            'bg-red-600': parseFloat(film.rating_kp) < 5,
                            'bg-orange-600': parseFloat(film.rating_kp) >= 5 && parseFloat(film.rating_kp) < 7,
                            'bg-green-600': parseFloat(film.rating_kp) >= 7,
                        }">
                            {{ film.rating_kp }}
                        </div>
                    </div>
                </template>
                <div class="truncate text-sm">
                    {{ film.name }}
                </div>

            </Card>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Card from "@/Components/Card.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {router} from "@inertiajs/vue3";

export default {
    name: "Index",
    props: {
        films: null,
    },
    data() {
        return {
            loading: false,
            searchValue: '',
        }
    },
    components: {PrimaryButton, TextInput, Card, AuthenticatedLayout},
    methods: {
        search() {
            this.loading = true
            router.get(route('search'), {
                search: this.searchValue,
            }, {
                onFinish: () => {
                    this.loading = false
                }
            })
        }
    },
    mounted() {
        console.log(this.films);
    }
}
</script>

<style scoped>

</style>
