<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginTitle">Авторизация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="alert alert-danger" role="alert" v-if="authError">
                        Неправильный логин/пароль
                    </div>

                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" v-model="login" required>
                        <div class="invalid-feedback" v-if="invalidLogin">
                            Неверный Email
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Пароль</label>
                        <input type="password" class="form-control" id="inputPassword" v-model="pass" required>
                        <div class="invalid-feedback" v-show="invalidPass">
                            Неверный пароль
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button class="btn btn-primary" @click.prevent="logIn">Войти</button>
            </div>
        </div>
    </div>
</div>