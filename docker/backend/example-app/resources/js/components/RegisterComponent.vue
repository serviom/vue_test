<template>
    <v-app>
        <v-main>
            <v-container fluid>
                <form>
                    <v-text-field
                        v-model="state.name"
                        :counter="10"
                        :error-messages="v$.name.$errors.map(e => e.$message)"
                        label="Full name"
                        required
                        @blur="v$.name.$touch"
                        @input="v$.name.$touch"
                        outlined
                    ></v-text-field>

                    <v-select
                        v-model="state.country"
                        :error-messages="v$.country.$errors.map(e => e.$message)"
                        :items="state.countries"
                        :item-text="item => item.flag + '  ' + item.name"
                        item-value="code"
                        label="Country"
                        required
                        @blur="v$.country.$touch"
                        @change="setCountry"
                        outlined
                    ></v-select>

                    <v-text-field
                        v-mask="DEFAULT_PHONE_PREFIX_PHONE"
                        v-model="state.phone"
                        :error-messages="v$.phone.$errors.map(e => e.$message)"
                        require
                        outlined
                        label="Phone number"
                        :prefix="state.prefix"
                    >
                    </v-text-field>

                    <v-text-field
                        v-model="state.email"
                        :error-messages="v$.email.$errors.map(e => e.$message)"
                        label="E-mail"
                        required
                        @blur="v$.email.$touch"
                        @input="v$.email.$touch"
                        outlined
                    ></v-text-field>

                    <v-btn
                        class="me-4"
                        @click="send"
                        outlined
                    >
                        submit
                    </v-btn>

                    <v-btn
                        outlined
                        @click="clear">
                        clear
                    </v-btn>

                </form>
            </v-container>
        </v-main>
    </v-app>
</template>

<script setup>
import { reactive, onMounted } from 'vue'
import { useVuelidate } from '@vuelidate/core'
import { email, required, helpers, minLength } from '@vuelidate/validators'
import axios from "axios";


const DEFAULT_PHONE_PREFIX_MASK = '+###';
const DEFAULT_PHONE_PREFIX_PHONE = '## ###-##-##';

const initialState = {
    prefix: DEFAULT_PHONE_PREFIX_MASK,
    name: '',
    email: '',
    country: null,
    phone: '',
    countries: [],
}

const state = reactive({
    ...initialState,
})

const phoneRegex = /^\d{2} \d{3}-\d{2}-\d{2}$/;
const phoneValidator = helpers.regex(phoneRegex);

const rules = {
    name: {
        required,
        minLengthValue: minLength(3),
    },
    email: { required, email },
    country: { required },
    phone: {
        phoneValidator: helpers.withMessage('Phone must be correct', phoneValidator),
        required
    },
    prefix: {required},
}

const v$ = useVuelidate(rules, state)

function setCountry (val) {
    state.country = state.countries.find((el) => el.code === val );
    state.prefix = state.country?.dial_code ?? DEFAULT_PHONE_PREFIX_MASK;
}


function clear () {
    v$.value.$reset()
    for (const [key, value] of Object.entries(initialState)) {
        if (key === 'countries') {
            return
        }
        state[key] = value
    }
}


const send = async () => {
    const result = await v$.value.$validate()
    if (!result) {
        return
    }

    await axios.post('http://localhost/register',
        {
            phone: state.prefix + ' ' + state.phone,
            name: state.name,
            country: state.country,
            email: state.email
        }
    )
}

onMounted(() => {
    axios.get('https://gist.githubusercontent.com/DmytroLisitsyn/1c31186e5b66f1d6c52da6b5c70b12ad/raw/2bc71083a77106afec2ec37cf49d05ee54be1a22/country_dial_info.json')
        .then(res => state.countries = res.data);
})

</script>
