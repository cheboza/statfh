require('./bootstrap');
require('./util.js');
require('./charts.js');

// максимальное количество товаров, выводимых в статистике
const MAX_COUNT_STAT_GOODS = 5;

/* запуск поиска товаров */
$(document).on('click', '.js_searchGoods_button', function() {
    getSearchContent(1);
});
$(document).on('keypress','input#stat-search', function(e) {
    if(e.which === 13) {
        getSearchContent(1);
    }
});
/* пагинация */
$(document).on('click', '.pagination .page-item:not(.active)', function () {
    let page = $(this).text();
    getSearchContent(page);
});
function getSearchContent(page) {
    let query = $('#searchModal input[name="search"]').val();
    $.ajax({
        url: window.location.pathname + '/search',
        type: "POST",
        dataType: "json",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            search: query,
            page: page
        },
        success: function(response) {
            $('#searchModal_content').html(response['view_search']);
        }
    });
}

/* добавить товар к статистике */
$(document).on('click', '.js_addGoods_forStat', function (e) {
    if($('#content_statGoods .searchedUnit').length < MAX_COUNT_STAT_GOODS) {
        let button = $(this);
        button.addClass('js_removeGoods_forStat').removeClass('js_addGoods_forStat').text("-");
        button.parents('.searchedUnit').clone().appendTo('#content_statGoods');
        // обновление данных на графике
        getStatistics();
    } else {
        alert('Максимальное количество исследуемых товаров может быть не более ' + MAX_COUNT_STAT_GOODS + '.');
    }
});

/* убрать товар из статистики */
$(document).on('click', '.js_removeGoods_forStat', function (e) {
    let id_goods = $(this).attr('data-goods-id');

    $('#content_statGoods').find('.searchedUnit[data-goods-id=' + id_goods +']').remove();
    $('#searchModal_content').find('button[data-goods-id=' + id_goods +']').addClass('js_addGoods_forStat').removeClass('js_removeGoods_forStat').text("+")
    // обновление данных на графике
    getStatistics();
});

$("#filters select").on("change", function (e){
    getStatistics();
})

function getStatistics() {

    let goods = $("#content_statGoods .searchedUnit").map(function () {
        return $(this).attr("data-goods-id");
    }).toArray();

    if(goods.length > 0){
        window.chartsSendAjax({
            rang: $("select[name=rang]").val(),
            unit: $("select[name=unit]").val(),
            points: $("select[name=points]").val(),
            goods: goods,
        });
    } else {
        window.chartsEmpty();
    }
}
