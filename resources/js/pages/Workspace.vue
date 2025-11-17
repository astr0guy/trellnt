<script setup lang="ts">
import { newTask, this_workspace } from '@/routes';
import AppLayout from '@/layouts/AppLayout.vue';
import { NavItem, type BreadcrumbItem } from '@/types';
import { Form, Head, Link, usePage, usePoll } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import FormDialog from '@/pages/dashboard/FormDialog.vue';

import { AccordionContent, AccordionHeader, AccordionItem, AccordionRoot, AccordionTrigger } from 'reka-ui';
import { computed, getCurrentInstance, Ref, VueElement } from 'vue';
import { updateSourceFile } from 'typescript';
import { reactify } from '@vueuse/core';
import { BadgePlusIcon, ReplaceAll } from 'lucide-vue-next';
import { ref } from 'vue';
import Label from '@/components/ui/label/Label.vue';
import Button from '@/components/ui/button/Button.vue';
import { categories } from '@vueuse/core/metadata.cjs';
import Task from './this_workspace/Task.vue';
import SidebarContent from '@/components/ui/sidebar/SidebarContent.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import NavMain from '@/components/NavMain.vue';
import Sidebar from '@/components/ui/sidebar/Sidebar.vue';
import WorkspaceSidebar from '@/components/WorkspaceSidebar.vue';

const { proxy } = getCurrentInstance();



const page = usePage()

const workspace_name = page.props.workspace_data.workspace[0].title

const workspace_id = page.props.workspace_data.workspace[0].id

const user_id = page.props.auth.user.id;

const tasks = page.props.workspace_data.tasks;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: workspace_name,
        href: this_workspace().url,
    },
]


const navItemActions = new Map<string, string>;
const navItemPayloads = new Map<string, any>;

navItemActions.set('New Task','post')
navItemPayloads.set('New Task', {"user_id": user_id, "workspace_id": workspace_id})




</script>

<template v-if="workspace_name != null">
    <Head :title=workspace_name />
    <AppLayout :breadcrumbs="breadcrumbs">
        <WorkspaceSidebar :methods="navItemActions" :payloads="navItemPayloads"></WorkspaceSidebar>

        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="grid auto-rows-min gap-1 md:grid-cols-1 ">
                    <Task />
                    <!-- <FormDialog v-slot="slotProps">
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
                    </FormDialog> -->

        </div>
    </div>
    </AppLayout>
</template>




