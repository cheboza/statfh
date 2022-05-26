require('./bootstrap');
require('./util.js');
require('./charts.js');

getStatistics();

function getStatistics() {
    window.chartsSendAjax({
        rang: $("select[name=rang]").val(),
        unit: $("select[name=unit]").val(),
        points: $("select[name=points]").val(),
    });
}

$("#filters select").on("change", function (e) {
    getStatistics();
})
