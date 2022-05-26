<!-- Modal Search -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Поиск товаров</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body search-modal-body">
                <div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="stat-search" autocomplete="off" name="search" placeholder="Введите название товара" aria-label="" aria-describedby="basic-addon1">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary js_searchGoods_button" type="button">Найти</button>
                        </div>
                    </div>
                </div>

                <div id="searchModal_content">

                </div>
            </div>
        </div>
    </div>
</div>