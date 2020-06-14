<div class="modal fade" id="balanceHistoryModal" tabindex="-1" role="dialog" aria-labelledby="balanceHistoryModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="balanceHistoryModalTitle">История баланса</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Тип</th>
                            <th scope="col">Сумма</th>
                            <th scope="col">Дата</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in history">
                            <td>{{item.type}}</td>
                            <td>{{item.sum}}$</td>
                            <td>{{item.time_created}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>