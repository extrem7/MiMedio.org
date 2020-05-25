<template>
    <div>
        <swatches inline :colors="colors" v-model="color"></swatches>
        <input type="hidden" name="color" v-model="colorFormatted">
    </div>
</template>

<script>
    import Swatches from 'vue-swatches'

    import "vue-swatches/dist/vue-swatches.min.css"

    export default {
        components: {Swatches},
        props: {
            initial: {
                type: String,
                default: '2c95d8'
            },
            colors: {
                type: String,
                default: 'text-advanced'
            },
        },
        data() {
            return {
                color: null
            }
        },
        computed: {
            colorFormatted() {
                return this.color.replace('#', '')
            }
        },
        created() {
            this.color = '#' + this.initial
        }
    }
</script>
