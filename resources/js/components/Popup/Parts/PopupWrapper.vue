<template>
    <div v-if="isVisible"
        @click.self="closePopup"
        class="bg-black absolute h-full w-full bg-opacity-50 flex justify-center items-center">
        <div class="w-[500px]  bg-white border-0 rounded-xl ">
            <slot></slot>
        </div>
    </div>
</template>

<script>
import { events } from '../../../bus'

export default {
    name: 'PopupWrapper',
    props: [ 'name' ],
    data () {
        return {
            isVisible: false
        }
    },
    methods: {
        closePopup () {
            this.isVisible = false
        }
    },
    mounted () {
        events.$on('popup:open', (data) => {
            if(data.name === this.name)
                this.isVisible = true
        })

        events.$on('popup:close', () => { this.isVisible = false})
    }

}
</script>

<style lang="scss" scoped>

</style>
