var app = new Vue({
    el: '#app',
    data: {
        authError: false,
        login: '',
        pass: '',
        post: false,
        comment: false,
        invalidLogin: false,
        invalidPass: false,
        invalidSum: false,
        posts: [],
        addSum: 0,
        amount: 0,
        likes: 0,
        postCommentText: '',
        commentCommentText: '',
        packs: [
            {
                id: 1,
                price: 5
            },
            {
                id: 2,
                price: 20
            },
            {
                id: 3,
                price: 50
            },
        ],
    },
    computed: {
        test: function () {
            var data = [];
            return data;
        }
    },
    created() {
        var self = this
        axios
            .get('/main_page/get_all_posts')
            .then(function (response) {
                self.posts = response.data.posts;
            })
    },
    methods: {
        logout: function () {
            console.log('logout');
        },
        logIn: function () {
            var self = this;

            self.invalidLogin = self.login === ''
            self.invalidPass = self.pass === ''

            if (!self.invalidLogin && !self.invalidPass) {
                axios.post('/main_page/login', {
                    login: self.login,
                    password: self.pass
                }).then(function (response) {
                    if (response.data && response.data.status === 'error') {
                        self.authError = true
                    } else if (response.data && response.data.status === 'success') {
                        window.location.replace('/')
                    }
                })
            }
        },
        fiilIn: function () {
            var self = this;

            self.invalidSum = self.addSum === 0;

            if (!self.invalidSum) {
                self.invalidSum = false;

                axios.post('/main_page/add_money', {
                    sum: self.addSum,
                }).then(function (response) {
                    setTimeout(function () {
                        $('#addModal').modal('hide');
                    }, 500);
                });
            }
        },
        openPost: function (id) {
            var self = this;
            axios.get('/main_page/get_post/' + id).then(function (response) {
                self.post = response.data.post;
                self.likes = response.data.post.likes;
                if (self.post) {
                    setTimeout(function () {
                        $('#postModal').modal('show');
                    }, 500);
                }
            });
        },
        openComment: function (id) {
            var self = this;
            axios.get('/main_page/get_comment/' + id).then(function (response) {
                self.comment = response.data.comment;
                if (self.comment) {
                    setTimeout(function () {
                        $('#commentModal').modal('show');
                    }, 500);
                }
            });
        },
        addLike: function (id) {
            var self = this;

            axios.post('/main_page/like', {
                assign_id: id,
            }).then(function (response) {
                if (response.data && response.data.status === 'success') {
                    self.likes = response.data.likes;
                }
            });
        },
        buyPack: function (id) {
            var self = this;
            axios.post('/main_page/buy_boosterpack', {
                id: id,
            }).then(function (response) {
                if (response.data && response.data.status === 'success') {
                    self.amount = response.data.amount;
                    if (self.amount !== 0) {
                        setTimeout(function () {
                            $('#amountModalSuccess').modal('show');
                        }, 500);
                    }
                }
                else if (response.data && response.data.status === 'error') {
                    setTimeout(function () {
                        $('#amountModalError').modal('show');
                    }, 500);
                }
            });
        },
        commentUnderPost: function (id) {
            var self = this;

            axios.post('/main_page/comment_post', {
                post_id: id,
                message: self.postCommentText
            }).then(function (response) {
                if (response.data && response.data.status === 'success') {
                    self.post = response.data.post;
                    self.postCommentText = '';
                }
            });
        },
        commentUnderComment: function (id) {
            var self = this;

            axios.post('/main_page/comment_comment', {
                comment_id: id,
                message: self.commentCommentText
            }).then(function (response) {
                if (response.data && response.data.status === 'success') {
                    self.comment = response.data.comment;
                    self.commentCommentText = '';
                }
            });
        },
        addLikeToPostComment: function (id) {
            var self = this;

            axios.post('/main_page/like_comment', {
                comment_id: id,
            }).then(function (response) {
                if (response.data && response.data.status === 'success') {
                    self.post.comments = self.post.comments.map(function (comment) {
                        if (comment.id === id) {
                            comment.likes = response.data.likes;
                            comment.liked = true;
                        }

                        return comment;
                    });
                }
            });
        },
        addLikeToCommentComment: function (id) {
            var self = this;

            axios.post('/main_page/like_comment', {
                comment_id: id,
            }).then(function (response) {
                if (response.data && response.data.status === 'success') {
                    self.comment.comments = self.comment.comments.map(function (comment) {
                        if (comment.id === id) {
                            comment.likes = response.data.likes;
                            comment.liked = true;
                        }

                        return comment;
                    });
                }
            });
        },
    }
});

