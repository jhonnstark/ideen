<template>

    <form
        @submit.prevent="register"
        action="#" method="POST" novalidate>
        <input type="hidden" name="_token" :value="csrf">

        <div class="form-group row">
            <label for="types" class="col-md-4 col-form-label text-md-right">Generar reporte</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="types">
                            <svg width="18" height="16" viewBox="0 0 2048 1792" xmlns="http://www.w3.org/2000/svg"><path d="M640 896v512h-256v-512h256zm384-512v1024h-256v-1024h256zm1024 1152v128h-2048v-1536h128v1408h1920zm-640-896v768h-256v-768h256zm384-384v1152h-256v-1152h256z"/></svg>
                        </label>
                    </div>
                    <v-select v-model="type"
                              :options="types"
                              id="types"
                              name="types"
                              :dropdown-should-open=true
                    >
                    </v-select>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="needsDate">
            <label for="orderBy" class="col-md-4 col-form-label text-md-right">Orden del reporte</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="orderBy">
                            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1595 295q17 41-14 70l-493 493v742q0 42-39 59-13 5-25 5-27 0-45-19l-256-256q-19-19-19-45v-486l-493-493q-31-29-14-70 17-39 59-39h1280q42 0 59 39z"/></svg>
                        </label>
                    </div>
                    <v-select v-model="ordered"
                              :options="orderBy"
                              id="orderBy"
                              name="orderBy"
                              :dropdown-should-open=true
                    >
                    </v-select>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="needsDate">
            <label class="col-md-4 col-form-label text-md-right">Duración</label>
            <div class="col-md-6">
                <v-date-picker
                                    v-model="range"
                    is-range
                    mode="date"
                    is-required
                    :attributes="attrs"
                    :select-attribute="selectDragAttribute"
                    :drag-attribute="selectDragAttribute"
                    :model-config="modelConfig"
                    @drag="dragValue = $event"
                    :max-date="new Date()"
                    show-weeknumbers
                    :first-day-of-week="0"
                >
                    <template v-slot:day-popover="{ format }">
                        <div>
                            {{ format(dragValue ? dragValue.start : range.start, 'MMM D') }}
                            -
                            {{ format(dragValue ? dragValue.end : range.end, 'MMM D') }}
                        </div>
                    </template>
                    <template v-slot="{ inputValue, inputEvents, updateValue }">
                        <div class="date-picker">
                            <div class="date-picker-wrap">
                                <svg class="mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <input
                                    name="active_at"
                                    :value="inputValue.start"
                                    v-on="inputEvents.start"
                                    class="form-control date-picker-input border w-32 rounded"
                                />
                            </div>
                            <div class="date-picker-wrap">
                                <svg class="mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <input
                                    name="close_at"
                                    :value="inputValue.end"
                                    v-on="inputEvents.end"
                                    class="form-control date-picker-input border w-32 rounded"
                                />
                            </div>
                        </div>
                    </template>
                </v-date-picker>
            </div>
        </div>

        <div class="form-group row" v-if="needsUser">
            <label for="orderBy" class="col-md-4 col-form-label text-md-right">Busqueda de alumno</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="user">
                            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1536 1399q0 109-62.5 187t-150.5 78h-854q-88 0-150.5-78t-62.5-187q0-85 8.5-160.5t31.5-152 58.5-131 94-89 134.5-34.5q131 128 313 128t313-128q76 0 134.5 34.5t94 89 58.5 131 31.5 152 8.5 160.5zm-256-887q0 159-112.5 271.5t-271.5 112.5-271.5-112.5-112.5-271.5 112.5-271.5 271.5-112.5 271.5 112.5 112.5 271.5z"/></svg>
                        </label>
                    </div>
                    <v-select v-model="user_id"
                              :reduce="user => user.id"
                              label="name"
                              :options="users"
                              id="user"
                              name="user"
                              :dropdown-should-open=true
                    >
                    </v-select>

                    <span
                        v-if="!$v.user_id.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-3 offset-md-4">
                <button type="submit"
                        :class="[ !$v.$invalid? 'btn-primary': 'btn-secondary']"
                        class="btn">

                    <svg
                        v-if="isLoading"
                        class="spin btn-loading"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>

                    Generar
                </button>
                <span
                    v-if="$v.$invalid && errors"
                    class="text-danger" role="alert">
                        <strong>Completa el formulario</strong>
                    </span>
            </div>
            <div class="col-md-3" v-show="ready2Download">
                <a href="" id="download" download="reports.xlsx" class="btn btn-primary" target="_blank">
                    <svg width="16" height="16" viewBox="0 0 2048 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1344 928q0-14-9-23t-23-9h-224v-352q0-13-9.5-22.5t-22.5-9.5h-192q-13 0-22.5 9.5t-9.5 22.5v352h-224q-13 0-22.5 9.5t-9.5 22.5q0 14 9 23l352 352q9 9 23 9t23-9l351-351q10-12 10-24zm640 224q0 159-112.5 271.5t-271.5 112.5h-1088q-185 0-316.5-131.5t-131.5-316.5q0-130 70-240t188-165q-2-30-2-43 0-212 150-362t362-150q156 0 285.5 87t188.5 231q71-62 166-62 106 0 181 75t75 181q0 76-41 138 130 31 213.5 135.5t83.5 238.5z"/></svg>
                    Descargar
                </a>
            </div>
        </div>
    </form>

</template>

<script>

import {required, requiredIf} from 'vuelidate/lib/validators';

export default {
    name: "ReportsForm",
    props: ['role'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            types: ['Por alumno', 'Por fecha'],
            orderBy: [
                'Por alumno',
                // 'Por grupo',
                'General'
            ],
            users: [],
            user_id: null,
            ordered: null,
            type: null,
            isLoading:false,
            ready2Download:false,
            attrs: [
                {
                    key: 'today',
                    dates: this.$moment().day(-16).toDate(),
                },
            ],
            dragValue: null,
            range: {
                end: this.$moment().day(-6).toDate(),
                start: this.$moment().day(-2).toDate(),
            },
            modelConfig: {
                start: {
                    timeAdjust: '00:00:00',
                },
                end: {
                    timeAdjust: '23:59:59',
                },
            },
        }
    },
    validations: {
        type: {
            required,
        },
        ordered: {
            required : requiredIf('needsDate'),
        },
        range: {
            start: {
                required : requiredIf('needsDate'),
            },
            end: {
                required : requiredIf('needsDate'),
            }
        },
        user_id: {
            required : requiredIf('needsUser'),
        },
    },
    created() {
        axios.get('/' + this.role + '/user/list/')
            .then(response => {
                this.users = response.data.data;
            })
    },
    computed: {
        selectDragAttribute () {
            return {
                popover: {
                    visibility: 'hover',
                    isInteractive: false,
                },
            };
        },
        needsUser() {
            return this.type === 'Por alumno' || this.ordered === 'Por alumno'
        },
        needsDate() {
            return this.type !== 'Por alumno'
        },
    },
    watch: {
        range: function (val) {
            this.$v.$touch()
        }
    },
    methods:{
        register() {
            if (this.isLoading) {
                return;
            }
            if (this.$v.$invalid) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;
                this.isLoading = true;
                const data = {
                    type: this.type,
                    ordered: this.ordered,
                    user_id: this.user_id,
                    range: this.range,
                }
                axios({
                    method: 'post',
                    url:  window.location.href,
                    data,
                    headers: {'X-CSRF-TOKEN': this.csrf},
                })
                    .then(resp => {
                        this.ready2Download = true;
                        const a = document.getElementById('download');
                        a.href = resp.data.meta.link;
                        a.click();
                        this.$swal('Guardado', 'Creado exitosamente.', 'success');
                    })
                    .catch(error => console.log(error))
                    .finally(() => this.isLoading = false);
            }
        },
    },
}
</script>

<style scoped>

</style>
