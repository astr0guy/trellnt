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
import { ReplaceAll } from 'lucide-vue-next';
import { ref } from 'vue';
import Label from '@/components/ui/label/Label.vue';
import Button from '@/components/ui/button/Button.vue';
import Heading from '@/components/Heading.vue';
import Participants from './Participants.vue';
</script>

<template>
    <AccordionRoot collapsible class="flow inset-x-0 top-0 pb-[100px]">
        <template v-for="(t, key) in tasks" :key="tasks" >
            <AccordionItem class="relative bg-blue-650 rounded-xl shadow-[0_2px_10px] shadow-black/5 border"
            :value=String(key)>
                    <AccordionHeader class="flex">
                            <AccordionTrigger class="flow bold text-grass11 shadow-blue-950 hover:bg-blue-650 flex h-[50px] flex-1 cursor-default items-center justify-between bg-blue-600 px-5 text-2xl leading-none shadow-[0_1px_0] group">
                                <span>{{ t['title'] }}</span>
                            </AccordionTrigger>
                    </AccordionHeader>
                        <AccordionContent :key="t" class="text-white flex-row h-[60px] relative aspect-auto w-full place-items-stretch bg-blue-950 data-[state=open]:animate-slideDown data-[state=closed]:animate-slideUp overflow-hidden text-sm">
                            <div>
                                <Heading title="Description" />
                                <span>{{ t['description'] }}</span>
                            </div>
                            <div>
                                <Heading title="Completion Date" />
                                <span>{{ t['deadline'] }}</span>
                            </div>
                            <div>
                                <Participants/>
                            </div>
                        </AccordionContent>
            </AccordionItem>
        </template>
    </AccordionRoot>
</template>
