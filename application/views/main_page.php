<? App::get_ci()->load->view('base/header'); ?>

<div class="main">
    <? App::get_ci()->load->view('components/posts'); ?>
</div>

<!-- Modals -->

<? App::get_ci()->load->view('components/modals/auth'); ?>
<? App::get_ci()->load->view('components/modals/post'); ?>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add money</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter sum</label>
                        <input type="text" class="form-control" id="addBalance" v-model="addSum" required>
                        <div class="invalid-feedback" v-if="invalidSum">
                            Please write a sum.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" @click="fiilIn">Add</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="amountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Amount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2 class="text-center">Likes: {{amount}}</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<? App::get_ci()->load->view('base/footer'); ?>


