<template>


    <div>


        <h2>Hello and Welcome In Vue</h2>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li  v-bind:class="[{disabled : !pagination.prev_page_url}]"
                     class="page-item"
                     @click="fetchArticles(pagination.prev_page_url)">
                    <a class="page-link" href="#">Previous</a>
                </li>

                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>

        <div class="card card-body mb-2"
             v-for="article in articles" v-bind:key="article.id">


            <h3> {{ article.title}} </h3>
            <p> {{ article.body}}</p>

        </div>



    </div>
    
</template>

<script>
    export default {
       data(){
           return {
               articles : [],
               article  :{
                   id : '',
                   title : '',
                   body   : ''
               },
               article_id: '',
               pagination:{},
               edit:false
           }
       },
        //that run auto when the page load
        created(){
           this.fetchArticles();
        },
        methods:{
            fetchArticles(page_url){
                let vm = this;
                page_url = page_url || '/api/articles';
                //get data from url in api
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        //console.log(res.data);
                        this.articles = res.data;
                        vm.makePagination(res.meta , res.links);
                    }).catch( err => console.log(err));
            },
            makePagination(meta , links){

                let pagination = {
                    current_page : meta.current_page,
                    last_page :meta.last_page,
                    next_page_url:links.next,
                    prev_page_url:links.prev,
                }

                this.pagination = pagination;

            }

        }
    }
</script>
