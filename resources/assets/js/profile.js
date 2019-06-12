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
        msg: '',
        content: '',
        privateMsgs: [],
        singleMsgs: [],
        msgFrom: '',
        conID: '',
        friend_id: '',
        seen: false,
        newMsgFrom: '',
        baseUrl: 'http://larabook.me',
        qry: '',
        results: [],
        user_from_pic_loc: '',
    },

    ready: function () {


        this.created();
    },

    created() {

        axios.get(this.baseUrl + '/getMessages')
            .then(response => {
                console.log(response);
                app.privateMsgs = response.data;
            })
            .catch(function (error) {
                console.log(error.message);
            })


    },




    methods: {

        messages: function (id) {
            axios.get(this.baseUrl + '/getMessages/' + id)
                .then(response => {
                    console.log(response.data);
                    app.singleMsgs = response.data;
                    app.conID = response.data[0].conversation_id
                })
                .catch(function (error) {
                    console.log(error.message);
                })

        },

        inputHandler(e) {
            if (e.keyCode === 13 && !e.shiftKey) {
                e.preventDefault();
                // console.log('Hello');
                this.sendMsg();
            }
        },
        sendMsg() {
            if (this.msgFrom) {
                axios.post(this.baseUrl + '/sendMessage', {
                        conID: this.conID,
                        msg: this.msgFrom
                    })
                    .then((response) => {
                        console.log(response.data); // show if success
                        if (response.status === 200) {
                            app.singleMsgs = response.data;
                            this.msgFrom = '';
                        }

                    })
                    .catch(function (error) {
                        console.log(error); // run if we have error
                    });

            }
        },

        friendID: function (id) {
            app.friend_id = id;
        },

        sendNewMsg() {
            axios.post(this.baseUrl + '/sendNewMessage', {
                    friend_id: this.friend_id,
                    msg: this.newMsgFrom,
                })
                .then(function (response) {
                    console.log(response.data); // show if success
                    if (response.status === 200) {
                        window.location.replace('http://larabook.me/messages');
                        app.msg = 'your message has been sent successfully';
                    }

                })
                .catch(function (error) {
                    console.log(error); // run if we have error
                });
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

    }

});
