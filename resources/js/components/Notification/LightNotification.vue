<template>
    <transition name="slide" appear>
        <div v-if="isVisible" class="notification bottom-[40px] right-[35px] border-2 border-theme-second rounded-lg  bg-light absolute">
            <div class="max-w-[250px] min-h-[85px] flex justify-center items-center text-center p-2 flex-col">
                <div class="w-full font-bold border-b border-second-text">
                    {{ data.title}}
                </div>
                <div class="mt-2">
                    {{ data.description}}
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import { events } from '../../bus'

export default {
    name: 'LightNotification',
    data () {
        return {
            isVisible: false,
            data: undefined
        }
    },
    methods: {
        timer () {
            setTimeout(() => {
                this.isVisible = false
            }, 6000);
        }
    },
    mounted () {
        events.$on('light-notification:open', ((data) => {
            this.data = data
            this.isVisible = this.isVisible ? false : true
            this.timer()
        }))
    }
}
</script>

<style lang="scss" scoped>

    .notification {
        border: solid 2px transparent;
        border-radius: 10px;
        background-image: linear-gradient(white, white),
                    linear-gradient(to right,#29b9f0ff, #EE5007);
        background-origin: border-box;
        background-clip: content-box, border-box;
    }

    .slide-enter-active,
    .slide-leave-active {
        transition: all 0.3s ease-out;
    }

    .slide-enter-to,
    .slide-leave {
        transform: translateX(0px);
        opacity: 1;
    }

    .slide-enter,
    .slide-leave-to {
        transform: translateX(-100px);
        opacity: 0;
    }

</style>
