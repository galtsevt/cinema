<template>
    <DashboardLayout>
        <Card>
            <template #header>TEST</template>
            <InputUi class="mb-5" v-model="input" name="input" label="Название" :errors="errors['name']"/>
            <CheckboxUi class="mb-5" v-model="check" name="check" label="Активно?" :errors="errors['name']"/>
            <TextareaUi class="mb-5" v-model="input" name="input" label="Описание" :errors="errors['text']"/>
            <SelectUi class="mb-5" v-model="input" name="input" label="Страна" :data="selectData"
                     />
            <template #footer>
                <div class="flex justify-between">
                    <div class="flex">
                        <PrimaryButton>Создать</PrimaryButton>
                        <SuccessButton>Отмена</SuccessButton>
                    </div>

                    <DangerButton>Удалить</DangerButton>
                </div>

            </template>
        </Card>
    </DashboardLayout>
</template>

<script>
import DashboardLayout from "@/Layouts/Dashboard/DashboardLayout.vue";
import Card from "@/Components/Card.vue";
import InputUi from "@/Components/Form/InputUi.vue";
import TextareaUi from "@/Components/Form/TextareaUi.vue";
import SelectUi from "@/Components/Form/SelectUi.vue";
import CheckboxUi from "@/Components/Form/CheckboxUi.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import SuccessButton from "@/Components/Buttons/SuccessButton.vue";
import DangerButton from "@/Components/Buttons/DangerButton.vue";

export default {
    name: "Index",
    components: {
        DangerButton,
        SuccessButton, PrimaryButton, CheckboxUi, SelectUi, TextareaUi, InputUi, Card, DashboardLayout},
    data() {
        return {
            input: '',
            check: false,
            selectData: [
                {key: 1, value: 'Россия'},
                {key: 2, value: 'США'},
                {key: 3, value: 'Франция'},
            ],
            errors: [

            ]
        }
    }
}
</script>

<style scoped>

</style>
