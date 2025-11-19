<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { AccordionContent, AccordionHeader, AccordionItem, AccordionRoot, AccordionTrigger } from 'reka-ui';
import { computed } from 'vue';
// import Participants from './Participants.vue';

const page = usePage()

const tasks = computed(() => page.props.workspace_data[0].task)
</script>

<template v-if="tasks">
    <AccordionRoot collapsible class="absolute inset-x-0 top-0 pb-[100px]">
        <template v-for="(t, key) in tasks" :key="key" >
            <AccordionItem class="relative bg-blue-650 rounded-xl shadow-[0_2px_10px] shadow-black/5 border"
            :value=String(key)>
                    <AccordionHeader class="flex">
                            <AccordionTrigger class="flow bold text-grass11 shadow-blue-950 hover:bg-blue-650 flex h-[50px] flex-1 cursor-default items-center justify-between bg-blue-600 px-5 text-2xl leading-none shadow-[0_1px_0] group">
                                <span>{{ t['title'] }}</span>
                            </AccordionTrigger>
                    </AccordionHeader>
                        <AccordionContent :key="t" class="text-white flex-row h-[60px] relative aspect-auto w-full place-items-stretch bg-blue-950 data-[state=open]:animate-slideDown data-[state=closed]:animate-slideUp overflow-hidden text-sm">
                                <h1>Description</h1>
                                <p>{{ t['description'] }}</p>

                                <h1>Completion Date</h1>
                                <p>{{ t['deadline'] }}</p>
                            <!-- <div>
                                <Participants/> -->
                            <!-- </div> -->
                        </AccordionContent>
            </AccordionItem>
        </template>
    </AccordionRoot>
</template>
