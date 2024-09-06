<template>
    <Head title="Edit"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="container mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-12 px-32">
                    <Suspense>
                        <EditEventForm :event="event"/>
                    </Suspense>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import LocationIcon from "@/components/Icons/LocationIcon.vue";
import BasketIcon from "@/components/Icons/BasketIcon.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import UpdateProfileInformationForm from "@/pages/Profile/Partials/UpdateProfileInformationForm.vue";
import EditEventForm from "@/pages/Events/Partials/EditEventForm.vue";
import EventModel from "@/contracts/events/EventModel";

export default defineComponent({
    components: {
        EditEventForm,
        UpdateProfileInformationForm,
        AuthenticatedLayout,
        LocationIcon,
        BasketIcon,
        PrimaryButton,
        Head
    },
    props: {
        event: {
            type: Object as EventModel
        }
    }
});
</script>
