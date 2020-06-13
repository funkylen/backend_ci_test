<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginTitle">Log in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="inputEmail">Please enter login</label>
                        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" v-model="login" required>
                        <div class="invalid-feedback" v-if="invalidLogin">
                            Please write a username.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Please enter password</label>
                        <input type="password" class="form-control" id="inputPassword" v-model="pass" required>
                        <div class="invalid-feedback" v-show="invalidPass">
                            Please write a password.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" @click.prevent="logIn">Login</button>
            </div>
        </div>
    </div>
</div>