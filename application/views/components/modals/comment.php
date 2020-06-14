<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalTitle">Комментарии</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <? App::get_ci()->load->view('components/comment_comments') ?>
            </div>
            <div class="modal-footer">
                <form class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control" id="addCommentModal" v-model="commentCommentText">
                    </div>
                    <button type="submit" class="btn btn-primary" @click.prevent="commentUnderComment(post.id)">
                        Оставить комментарий
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>