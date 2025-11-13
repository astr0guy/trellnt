<script setup lang="ts">
import { this_workspace } from '@/routes';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Form, Head, Link, usePage, usePoll } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import FormDialog from '@/pages/dashboard/FormDialog.vue';

import { AccordionContent, AccordionHeader, AccordionItem, AccordionRoot, AccordionTrigger } from 'reka-ui';
import { computed, getCurrentInstance, Ref, VueElement } from 'vue';
import { updateSourceFile } from 'typescript';
import { reactify } from '@vueuse/core';
import { ReplaceAll } from 'lucide-vue-next';
import { ref } from 'vue';
import Label from '@/components/ui/label/Label.vue';
import Button from '@/components/ui/button/Button.vue';
import { categories } from '@vueuse/core/metadata.cjs';



const { proxy } = getCurrentInstance();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'This Workspace',
        href: this_workspace().url,
    },

];

const workspace_name = computed(() => usePage().props.workspace_data.workspace['title']);

const user_id = usePage().props.auth.user.id;


const tasks = computed(() => usePage().props.workspace_data.tasks);

const tasks = computed(() => usePage().props.workspace_data.tasks);

</script>

<template v-if="workspace_name != null">
    <Head title=workspace_name />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
        <Heading title={{ workspace_name }} />
            <div class="grid auto-rows-min gap-1 md:grid-cols-1 ">
                <div
                    class="relative flex w-full aspect-auto justify-center rounded-xl overflow-y-visible max-h-lvh border border-sidebar-border/70 dark:border-sidebar-border">

                    <div  >
                        <Heading class="absolute justify-self-center text-lg top-3 line-clamp-1" title="No workspaces yet! Create one to get started." />

                    </div>
                    <FormDialog v-slot="slotProps">
                        <Heading class="mb-auto space-y-auto" title="Create a New Workspace" />
                            <Form action="/workspace"
                                method="POST"
                                @submit-complete = "slotProps.open()"
                                >
                                <Label class="text-xl bold" for="title">
                                    Workspace Title:
                                </Label><br>
                                <input type="hidden" id="user_id" name="user_id" :value="user_id" /><br><br>
                                <input class="border rounded-s pl-1"type="text" id="title" name="title" value="New Workspace" /><br><br>
                                <Button class="relative left-50 bg-blue-400 hover:bg-blue-500" type="submit">
                                    Create
                                </Button>
                            </Form>
                    </FormDialog>
                </div>

        </div>
    </div>
    </AppLayout>
</template>




