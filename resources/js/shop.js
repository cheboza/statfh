require('./bootstrap');
require('./util.js');
require('./charts.js');

window.chartsSendAjax({
    rang: $("select[name=rang]").val(),
});

$('.custom-select').on('change', function () {
    window.chartsSendAjax({
        rang: $("select[name=rang]").val(),
    });
});
