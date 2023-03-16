<template>
    <div class="relative pt-1">
        <div class="flex mb-2 items-center justify-between">
            <div>
            </div>
            <div class="text-right">
                      <span class="text-xs font-semibold inline-block text-gray-800">
                        {{ size * step }}%
                      </span>
            </div>
        </div>
        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
            <div :style="{width:size*step+'%'}"
                 class="shadow-none  flex flex-col text-center whitespace-nowrap text-white justify-center bg-gray-800"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProgressBar",
    props: {
        size: Number,
        step: {
            type: Number,
            default: 10
        }
    }
}
</script>

<style scoped>

</style>
