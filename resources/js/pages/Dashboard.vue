<script setup lang="ts">
import { workspace } from '@/routes';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Form, Head, Link, usePage, usePoll } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import FormDialog from '@/pages/dashboard/FormDialog.vue';

import { AccordionContent, AccordionHeader, AccordionItem, AccordionRoot, AccordionTrigger } from 'reka-ui';
import { computed, getCurrentInstance, Ref, VueElement } from 'vue';
import { updateSourceFile } from 'typescript';
import { reactify } from '@vueuse/core';
import { List, ReplaceAll } from 'lucide-vue-next';
import { ref } from 'vue';
import Label from '@/components/ui/label/Label.vue';
import Button from '@/components/ui/button/Button.vue';



const { proxy } = getCurrentInstance();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Workspace',
        href: workspace().url,
    },

];

const rendered = ref(true)

const user_id = usePage().props.auth.user.id;

const owned_workspaces = computed(() => usePage().props.owned_workspaces);

const unowned_workspaces = computed(() => usePage().props.unowned_workspaces);


</script>
<template>
    <template v-if="rendered">
        <Head title="Workspace" />
        <AppLayout :breadcrumbs="breadcrumbs">
            <div
                class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
            >
            <Heading title='My Workspaces' />
                <div class="grid auto-rows-min gap-1 md:grid-cols-1 " >
                    <div
                        class="relative flex w-full aspect-auto justify-center rounded-xl overflow-y-visible max-h-lvh border border-sidebar-border/70 dark:border-sidebar-border">
                        <div class="flow w-full rounded-xl border border-sidebar-border/70 dark:border-sidebar-border my-auto min-h-[150px]" >
                            <Heading class="absolute justify-self-center text-lg top-3 line-clamp-1" title="No workspaces yet! Create one to get started." />
                            <AccordionRoot collapsible class="flow inset-x-0 top-0 pb-[100px]">
                                <template v-for="(w, key) in owned_workspaces" :key="owned_workspaces" >
                                    <AccordionItem class="relative bg-blue-650 rounded-xl shadow-[0_2px_10px] shadow-black/5 border"
                                    :value=String(key)>
                                            <AccordionHeader class="flex">
                                                    <AccordionTrigger class="flow bold text-grass11 shadow-blue-950 hover:bg-blue-650 flex h-[50px] flex-1 cursor-default items-center justify-between bg-blue-600 px-5 text-2xl leading-none shadow-[0_1px_0] group">
                                                        <span>{{ w['title'] }}</span>
                                                    </AccordionTrigger>
                                            </AccordionHeader>
                                                <AccordionContent class="text-white flex-row h-[60px] relative aspect-auto w-full place-items-stretch bg-blue-950 data-[state=open]:animate-slideDown data-[state=closed]:animate-slideUp overflow-hidden text-sm">
                                                    <div>
                                                        <Link class="absolute bg-green-600  rounded-lg px-5 py-4 left-1 bottom-0.5 hover:bg-green-800"
                                                            preserve-state
                                                            preserve-scroll
                                                            href="/this-workspace"
                                                            method="get"
                                                            :data="{'user_id':user_id,'workspace_id':w['id']}"
                                                            @click="rendered = false"> Enter Workspace
                                                        </Link>
                                                    </div>
                                                    <div>
                                                        <Link class="absolute bg-indigo-600 rounded-lg px-5 py-4 left-40 bottom-0.5 hover:bg-indigo-800"
                                                            preserve-state
                                                            preserve-scroll
                                                            preserve-url
                                                            href="/workspace"
                                                            method="get"
                                                            :data="{'user_id':user_id, 'workspace_id':w['id']}"
                                                            > Invite
                                                        </Link>
                                                    </div>
                                                    <div>
                                                        <Link class="absolute bg-red-600 hover:bg-red-800 rounded-lg px-5 py-4 right-1 bottom-0.5 bg:text-red-800"
                                                            preserve-state
                                                            preserve-scroll
                                                            preserve-url
                                                            href="/workspace"
                                                            method="delete"
                                                            :data="{'user_id':user_id, 'workspace_id':w['id']}"
                                                            > Delete
                                                        </Link>
                                                    </div>
                                                </AccordionContent>
                                    </AccordionItem>
                                </template>
                            </AccordionRoot>
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
</template>



