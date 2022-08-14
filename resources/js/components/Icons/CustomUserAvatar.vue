<template>
    <div class="flex justify-center items-center">
        <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" :width="`${size}px`" :height="`${size}px`" viewBox="0 0 256 256" xml:space="preserve">
            <g style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                <path d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 24.813 0 45 20.187 45 45 C 90 69.813 69.813 90 45 90 z M 45 2 C 21.29 2 2 21.29 2 45 c 0 23.71 19.29 43 43 43 c 23.71 0 43 -19.29 43 -43 C 88 21.29 68.71 2 45 2 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                <path d="M 45 51.117 c -8.632 0 -15.655 -7.023 -15.655 -15.655 S 36.368 19.808 45 19.808 s 15.654 7.023 15.654 15.655 S 53.632 51.117 45 51.117 z M 45 21.808 c -7.529 0 -13.655 6.125 -13.655 13.655 S 37.471 49.117 45 49.117 s 13.654 -6.125 13.654 -13.655 S 52.529 21.808 45 21.808 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                <path d="M 45 90 c -7.53 0 -14.986 -1.9 -21.56 -5.495 l -0.521 -0.284 V 71.197 c 0 -12.175 9.905 -22.08 22.081 -22.08 c 12.176 0 22.081 9.905 22.081 22.08 v 13.023 l -0.521 0.284 C 59.985 88.1 52.53 90 45 90 z M 24.919 83.03 C 31.072 86.283 38.002 88 45 88 s 13.928 -1.717 20.081 -4.97 V 71.197 c 0 -11.072 -9.009 -20.08 -20.081 -20.08 s -20.081 9.008 -20.081 20.08 V 83.03 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
            </g>
        </svg> -->

         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" :width="`${size}px`" :height="`${size}px`" viewBox="0 0 256 256" xml:space="preserve">
            <g>
                <g>
                    <path style="fill:#010002;" d="M9.954,241.305h228.441c3.051,0,5.896-1.246,7.805-3.416c1.659-1.882,2.393-4.27,2.078-6.723
                        c-5.357-41.734-31.019-76.511-66.15-95.053c-14.849,14.849-35.348,24.046-57.953,24.046s-43.105-9.197-57.953-24.046
                        C31.09,154.65,5.423,189.432,0.071,231.166c-0.315,2.453,0.424,4.846,2.078,6.723C4.058,240.059,6.903,241.305,9.954,241.305z"/>
                    <path style="fill:#010002;" d="M72.699,127.09c1.333,1.398,2.725,2.73,4.166,4.019c12.586,11.259,29.137,18.166,47.309,18.166
                        s34.723-6.913,47.309-18.166c1.441-1.289,2.834-2.622,4.166-4.019c1.327-1.398,2.622-2.828,3.84-4.329
                        c9.861-12.211,15.8-27.717,15.8-44.6c0-39.216-31.906-71.116-71.116-71.116S53.059,38.95,53.059,78.16
                        c0,16.883,5.939,32.39,15.8,44.6C70.072,124.262,71.366,125.687,72.699,127.09z"/>
                </g>
            </g>
        </svg>
    </div>
</template>

<script>
export default {
    name : 'CustomUserAvatar',
    props: [ 'size' ],

}
</script>

<style lang="scss" scoped>

</style>
