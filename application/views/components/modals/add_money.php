<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalTitle">Пополнить баланс</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Введите сумму пополнения</label>
                        <input type="text" class="form-control" id="addBalance" v-model.number="addSum" required>
                        <div class="invalid-feedback" v-if="invalidSum">
                            Введите сумму пополнения
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" @click="fiilIn">Пополнить</button>
            </div>
        </div>
    </div>
</div>