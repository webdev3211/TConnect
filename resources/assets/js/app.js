/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        msg: 'Update New Post: ',
        content: '',
        comment: '',
        posts: [],
        likes: [],
        postId: '',
        successMsg: '',
        commentData: {},
        commentSeen: false,
        image: '',
        baseUrl: 'http://larabook.me',
        updatedContent: '',
        qry: '',
        results: [],
    },

    ready: function () {
        this.created();
    },

    created() {

        axios.get(this.baseUrl + '/posts')
            .then(response => {
                console.log(response);
                this.posts = response.data;

                Vue.filter('myOwnTime', function (value) {
                    return moment(value).fromNow();
                });
            })
            .catch(function (error) {
                console.log(error.message);
            })

        axios.get(this.baseUrl + '/likes')
            .then(response => {
                console.log(response);
                this.posts = response.data;


            })
            .catch(function (error) {
                console.log(error.message);
            })


    },


    methods: {

        addPost() {
            vm = this;
            axios.post(this.baseUrl + '/addPost', {
                    content: this.content
                })
                .then(function (response) {
                    vm.content = "";
                    console.log('saved successfully');
                    if (response.status === 200) {
                        // alert('Your post has been added');
                        app.posts = response.data;

                    }
                })
                .catch(function (error) {
                    console.log(error.message);
                })
        },

        openModal(id) {
            console.log(id);
            axios.get(this.baseUrl + '/posts/' + id)
                .then(response => {
                    console.log(response); // show if success
                    this.updatedContent = response.data; //we are putting data into our posts array
                })
                .catch(function (error) {
                    console.log(error); // run if we have error
                });
        },


        deletePost(id) {

            axios.get(this.baseUrl + '/deletePost/' + id)
                .then(response => {
                    console.log(response);
                    this.posts = response.data;

                })
                .catch(function (error) {
                    console.log(error.message);
                })


        },

        likePost(id) {

            axios.get(this.baseUrl + '/likePost/' + id)
                .then(response => {
                    console.log(response);
                    this.posts = response.data;

                })
                .catch(function (error) {
                    console.log(error.message);
                })


        },



        addComment(post, key) {
            if (this.commentData) {
                axios.post(this.baseUrl + '/addComment', {
                        comment: this.commentData[key],
                        id: post.id
                    })
                    .then(function (response) {
                        console.log('saved successfully');
                        if (response.status === 200) {
                            // alert('Your post has been added');
                            app.posts = response.data;

                        }
                    })
                    .catch(function (error) {
                        console.log(error.message);

                    })
            }
        },



        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            this.createImg(files[0]); // files the image/ file value to our function

        },
        createImg(file) {
            // we will preview our image before upload
            var image = new Image;
            var reader = new FileReader;

            reader.onload = (e) => {
                this.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },

        uploadImg() {
            axios.post(this.baseUrl + '/saveImg', {
                    image: this.image,
                    content: this.content
                })
                .then((response) => {
                    console.log('saved successfully'); // show if success
                    this.image = "";
                    this.content = "";
                    if (response.status === 200) {
                        app.posts = response.data;
                    }
                })
                .catch(function (error) {
                    console.log(error); // run if we have error
                });
        },

        removeImg() {
            this.image = "";
        },

        autoComplete() {
            this.results = [];
            axios.post(this.baseUrl + '/search', {
                    qry: this.qry
                })
                .then((response) => {
                    console.log(response.data);
                    app.results = response.data;
                })
        }

    },


});
