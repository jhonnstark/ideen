<template>

    <div class="col-12 col-md">
        <div v-if="isLoading" class="row justify-content-center">
            <div class="on-load">
                <div class="spinner"></div>
            </div>
        </div>

        <div v-if="type !== 'content' && file" class="row">
            <a :href="file.url" class="col-auto download" target="_blank">
                Descargar
                <svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M11.25 9.331V.75a.75.75 0 011.5 0v8.58l1.949-2.11A.75.75 0 1115.8 8.237l-3.25 3.52a.75.75 0 01-1.102 0l-3.25-3.52A.75.75 0 119.3 7.22l1.949 2.111z"></path><path fill-rule="evenodd" d="M2.5 3.75a.25.25 0 01.25-.25h5.5a.75.75 0 100-1.5h-5.5A1.75 1.75 0 001 3.75v11.5c0 .966.784 1.75 1.75 1.75h6.204c-.171 1.375-.805 2.652-1.77 3.757A.75.75 0 007.75 22h8.5a.75.75 0 00.565-1.243c-.964-1.105-1.598-2.382-1.769-3.757h6.204A1.75 1.75 0 0023 15.25V3.75A1.75 1.75 0 0021.25 2h-5.5a.75.75 0 000 1.5h5.5a.25.25 0 01.25.25v11.5a.25.25 0 01-.25.25H2.75a.25.25 0 01-.25-.25V3.75zM10.463 17c-.126 1.266-.564 2.445-1.223 3.5h5.52c-.66-1.055-1.098-2.234-1.223-3.5h-3.074z"></path></svg>
            </a>
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
                </video>
            </vue-plyr>
        </div>

        <div v-if="file && doc.includes(file.ext)">
            <iframe :src="'https://view.officeapps.live.com/op/embed.aspx?src=' + encodeURIComponent(file.url)"
                    width='100%'
                    height='900px'>
            </iframe>
        </div>
    </div>

</template>

<script>
import pdf from 'vue-pdf'
import VuePlyr from 'vue-plyr'
// import Lingallery from 'lingallery';

export default {
    name: "Detail",
    props: ['id', 'type', 'edit'],
    components: {
        pdf,
        VuePlyr
    },
    data: function () {
        return {
            isLoading: true,
            rute: window.location.pathname + (this.edit ? '/' + this.edit : '/material'),
            doc: ['xlsx', 'xls', 'xlm', 'xla', 'xlc', 'xlt', 'xlw','doc', 'dot', 'docx', 'pptx', 'ppt', 'pps', 'pot'],
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
            .get(this.rute)
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

