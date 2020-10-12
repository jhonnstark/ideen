<template>

    <div class="container">
        <div v-if="isLoading" class="row justify-content-center">
            <div class="on-load">
                <div class="spinner"></div>
            </div>
        </div>

        <div class="row justify-content-center" v-if="file && file.ext === 'pdf'">

                <div class="controls col-12 justify-content-center row">
                    <button @click="previous" type="button" class="btn btn-primary col-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M9.78 12.78a.75.75 0 01-1.06 0L4.47 8.53a.75.75 0 010-1.06l4.25-4.25a.75.75 0 011.06 1.06L6.06 8l3.72 3.72a.75.75 0 010 1.06z"></path></svg>
                        Anterior
                    </button>

                    <label class="col-4 text-center">
                        <input v-model.number="currentPage" type="number" class="current-page">
                        <span> / {{pageCount}}</span>
                    </label>

                    <button @click="next" type="button" class="btn btn-primary">
                        Siguiente
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M6.22 3.22a.75.75 0 011.06 0l4.25 4.25a.75.75 0 010 1.06l-4.25 4.25a.75.75 0 01-1.06-1.06L9.94 8 6.22 4.28a.75.75 0 010-1.06z"></path></svg>
                    </button>
                </div>

                <pdf class="col-12"
                     :src="file.url"
                     @num-pages="pageCount = $event"
                     :page="currentPage"></pdf>
        </div>

        <div v-if="file && images.includes(file.ext)">
            <img :src="file.url" :alt="item.name" class="img-fluid mx-auto d-block">
        </div>

        <div v-if="file && audio.includes(file.ext)">
            <vue-plyr ref="plyr">
                <audio>
                    <source :src="file.url" :type="'audio/' + file.ext"/>
                </audio>
            </vue-plyr>
        </div>

        <div v-if="file && video.includes(file.ext)">
            <vue-plyr ref="plyr">
                <video>
                    <source :src="file.url" :type="'video/' + file.ext">
<!--                    <track kind="captions" label="English" srclang="en" src="captions-en.vtt" default>-->
                </video>
            </vue-plyr>
        </div>
    </div>

</template>

<script>
import pdf from 'vue-pdf'
import VuePlyr from 'vue-plyr'
// import Lingallery from 'lingallery';

export default {
    name: "Detail",
    props: ['id'],
    components: {
        pdf,
        VuePlyr
    },
    data: function () {
        return {
            isLoading: true,
            images: ['jpg', 'jpeg', 'jpe', 'bmp', 'gif', 'png', 'webp', 'tiff',],
            audio: ['mpga', 'mp2', 'mp2a', 'mp3', 'm2a', 'm3a', 'm4a', 'mp4a', 'wma', 'wav'],
            video: ['avi', 'qt', 'mov', 'mp4',  'mp4v',  'mpg4',  'mpeg',  'mpg',  'mpe',  'm1v',  'm2v', 'mkv', 'mk3d', 'mks',],
            currentPage: 1,
            pageCount: 0,
            item: JSON.parse(this.id),
            file: null
        }
    },
    created () {
        axios
            .get(window.location.pathname)
            .then(response => (this.file = response.data.data))
            .finally(() => this.isLoading = false)
    },
    methods: {
        next() {
            this.currentPage = this.currentPage === this.pageCount ? this.currentPage : this.currentPage + 1;
        },
        previous() {
            this.currentPage = this.currentPage === 1 ? this.currentPage : this.currentPage - 1;
        }
    }
}
</script>

<style scoped>

</style>

