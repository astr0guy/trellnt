<script setup lang="ts">
import DialogContent from '@/components/ui/dialog/DialogContent.vue';
import DialogOverlay from '@/components/ui/dialog/DialogOverlay.vue';
import DialogTrigger from '@/components/ui/dialog/DialogTrigger.vue';
import { DialogRoot } from 'reka-ui';
import { ref } from 'vue';

const open = ref(false)

function triggerDialog(){
    open.value = !open.value
}
</script>


<template>
  <div>
    <DialogRoot>
      <DialogTrigger @click="open=true"
        class="absolute inset-x-0 bottom-0 font-semibold shadow-black hover:bg-blue-600 inline-flex h-[75px] w-full justify-self-center items-center justify-center rounded-[4px] bg-blue-500 px-[15px] leading-none shadow-[0_2px_10px] focus:shadow-[0_0_0_2px] focus:shadow-black focus:outline-none"
      >
        Create New Workspace
      </DialogTrigger>

        <DialogOverlay v-if="open" class="bg-blackA9 data-[state=open]:animate-overlayShow fixed inset-0 z-30" />
        <DialogContent v-if="open"
          class="data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] max-h-[85vh] w-[90vw] max-w-[450px] translate-x-[-50%] translate-y-[-50%] rounded-[6px] blue-50 p-[25px] shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] focus:outline-none z-[100]"
        >
         <slot :open=triggerDialog />
        </DialogContent>
    </DialogRoot>
  </div>
</template>

