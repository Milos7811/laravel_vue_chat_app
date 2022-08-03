<template>
    <div class="w-[130px] h-[50px] cursor-pointer rounded-xl flex justify-center items-center font-bold relative"
        :class="buttonStyle">

        <slot v-if="!loading"></slot>

        <LoaderIcon v-if="loading" class="animate-spin"/>
    </div>
</template>

<script>
import Spinner from '../Spinner';
import { LoaderIcon } from 'vue-feather-icons'

export default {
    name: "ButtonCustom",
    props: ["buttonStyle", "loading"],
    components: {
        Spinner,
        LoaderIcon
    }
}
</script>

<style lang="scss" scoped>

    .cancel {
        background: #fc4444;
    }

    .accept {
        background: #60d66a
    }

</style>
