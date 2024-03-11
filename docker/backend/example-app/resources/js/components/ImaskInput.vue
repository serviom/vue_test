<template>
    <imask-input
        v-model="numberModel"
        :mask="Number"
        radix="."
        :unmask="true"

    <!-- depending on prop above first argument of 'accept' callback is
    `value` if `unmask=false`,
    `unmaskedValue` if `unmask=true`,
    `typedValue` if `unmask='typed'` -->
    @accept="onAccept"

    <!-- ...see more mask props in a guide -->

    <!-- other input props -->
    placeholder='Enter number here'
    />

</template>

<script>
import { IMaskComponent } from 'vue-imask';

export default {
    data () {
        return {
            numberModel: '',
            onAccept (value) {
                console.log(value);
            }
        }
    },
    components: {
        'imask-input': IMaskComponent
    }
}
</script>
