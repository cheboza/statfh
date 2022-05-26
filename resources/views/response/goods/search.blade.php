@if($goods->count())
    @foreach($goods as $good)
        <div class="searchedUnit" data-goods-id="{{$good->id}}">
            <div class="searchedUnit_image">
                @if($good->images->count())
                    <img src="https://fh-mebel.ru/userfiles/shop/preview/{{!empty($good->images->get(0)->folder_num) ? $good->images->get(0)->folder_num.'/' : ''}}{{$good->images->get(0)->name}}">
                @endif
            </div>
            <div class="searchedUnit_name">{{$good->name1}}</div>
            <div class="searchedUnit_button">
                <button type="button" class="btn btn-outline-secondary js_addGoods_forStat" data-goods-id="{{$good->id}}">+</button>
            </div>
        </div>
    @endforeach
    <div>{!! $goods->links('vendor.pagination.search') !!}</div>
@else
    <div>Ничего не найдено!</div>
@endif