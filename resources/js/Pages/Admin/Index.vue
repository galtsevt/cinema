<template>
    <DashboardLayout>
        <Card>
            <template #header>
                Заголовок
            </template>
            Welcome
        </Card>
    </DashboardLayout>
</template>

<script>
import DashboardLayout from "@/Layouts/Admin/DashboardLayout.vue";
import Card from "@/Components/Card.vue";

export default {
    name: "Index",
    components: {Card, DashboardLayout}
}
</script>

<style scoped>

</style>
