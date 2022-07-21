<template>
    <div>
        <h1>heloo</h1>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'Notification',
    computed: {
        ...mapGetters([ 'user' ])
    },
    mounted () {

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('23cd1e650d4c3cd9c892', {
      cluster: 'eu'
    });

    // var channel = pusher.subscribe('App.Models.User.1');
    // channel.bind('.message',data => {
    //   alert(JSON.stringify(data));
    // });

    // Echo.private(`App.Models.User.${this.user.id}`)
    //     .listen('.message', (data) => {
    //         alert(JSON.stringify(data));
    //         console.log(data)
    //     })
    }

}
</script>

<style lang="scss" scoped>

</style>
