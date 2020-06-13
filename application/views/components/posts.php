<div class="posts">
    <h1 class="text-center">Posts</h1>
    <div class="container">
        <div class="row">
            <div class="col-4" v-for="post in posts" v-if="posts">
                <div class="card">
                    <img :src="post.img + '?v=<?= filemtime(FCPATH . '/js/app.js') ?>'" class="card-img-top"
                         alt="Photo">
                    <div class="card-body">
                        <h5 class="card-title">Post - {{post.id}}</h5>
                        <p class="card-text">{{post.text}}</p>
                        <button type="button" class="btn btn-outline-success my-2 my-sm-0" @click="openPost(post.id)">
                            Open post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <? App::get_ci()->load->view('components/boosterpacks'); ?>
    <? App::get_ci()->load->view('components/help'); ?>
</div>