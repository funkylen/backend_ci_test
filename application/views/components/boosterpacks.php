<div class="boosterpacks">
    <h1 class="text-center">Бустерпаки</h1>
    <div class="container">
        <div class="row">
            <div class="col-4" v-for="box in packs" v-if="packs">
                <div class="card">
                    <img :src="'/images/box.png' + '?v=<?= filemtime(FCPATH . '/js/app.js') ?>'"
                         class="card-img-top" alt="Photo">
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-success my-2 my-sm-0" @click="buyPack(box.id)">
                            Купить бустерпак {{box.price}}$
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>