@if(Request::path() !== 'shop')
    <div id="filters" class="content_stat_goodsFilter">
    <!-- Button trigger modal -->
        <div>
            <div>Период наблюдений</div>
            <select class="custom-select" name="rang">
                <option selected value="6">6 месяцев</option>
                <option value="12">1 год</option>
                <option value="36">3 года</option>
            </select>
        </div>

        <div>
            <div>Единцы измерения</div>
            <select class="custom-select" name="unit">
                <option selected value="count">Поштучно</option>
                <option value="currency">Рубли</option>
            </select>
        </div>

        <div>
            <div>Точки продаж</div>
            <select class="custom-select" name="points" multiple="multiple">
                @foreach($salePoints as $point)
                    <option value="{{$point->id}}" selected>{{$point->title}}</option>
                @endforeach
            </select>
        </div>
    @if(Request::is(['goods', 'collections']))
        <div class="goodsFilter_buttonSearch">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#searchModal">Добавить товар</button>
        </div>
    @elseif(Request::is('brands'))
        <div>
            <div>Производители</div>
            <select class="custom-select" name="brands" multiple="multiple">
                @foreach($brands as  $key => $brand)
                    <option value="{{$brand->id}}" @if($key < 4) selected @endif >{{$brand->name1}}</option>
                @endforeach
            </select>
        </div>
    @elseif(Request::is('categories'))
        <div>
            <div>Категории</div>
            <select class="custom-select" name="categories" multiple="multiple">
                @foreach($categories as $category)
                    @include('layouts.content.filter.categories', ["category" => $category, "marker"=>""])
                @endforeach
            </select>
        </div>
    @endif
    </div>
@else
    <div class="content_stat">
        <div class="content_statFilter">
            <select class="custom-select" name="rang">
                <option selected value="6">6 месяцев</option>
                <option value="12">1 год</option>
                <option value="36">3 года</option>
            </select>
        </div>
    </div>
@endif
