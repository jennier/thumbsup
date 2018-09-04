<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>ThumbsUp</h1>
                <form @submit.prevent="create">
                    <input type="text" id="name" v-model="name" required>
                    <button type="submit">Add Movie</button>
                </form>
                <div class="card card-default" v-for="movie in movies" v-bind="movie" :key="movie.id">
                    <div class="card-body">
                        <h1 class="card-header">{{ movie.name }}</h1>
                        <p>Some stuff here.</p>
                        {{ movie.up_votes }} people like this movie.
                        <button @click="up_vote(movie.id)">Vote Up</button>
                        {{ movie.down_votes }} people dislike this movie.
                        <button @click="down_vote(movie.id)">Vote Down</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                movie: {},
                movies: [],
                name: '',
            }
        },
        mounted() {
            this.read();
        },
        methods: {
            read(){
                axios.get('api/movies').then(response => {
                    this.movies = response.data.data;
                }); 
            },
            create(){
                axios.post('api/movies', {name: this.name}).then(response => {
                    this.read();
                    this.name = '';
                }).catch(e => {
                    console.log(e);
                });
            },
            up_vote(id){
                axios.put('api/movies/'+ id +'/up').then(response => {
                    this.read();
                }).catch(e => {
                    console.log(e);
                });
            },
            down_vote(id){
                axios.put('api/movies/'+ id +'/down').then(response => {
                    this.read();
                }).catch(e => {
                    console.log(e);
                });
            }
        }
    }
</script>
