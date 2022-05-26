require('./bootstrap');
require('./util.js');
require('./charts.js');

getStatistics();

$("#filters select").on("change", function (e){
    getStatistics();
})

function getStatistics() {

    let catsSelect = $("select[name=categories]");

    if(catsSelect.val().length === 0) {
        catsSelect.find("option:not([disabled]):first").prop('selected', true);
    }

    window.chartsSendAjax({
        rang: $("select[name=rang]").val(),
        unit: $("select[name=unit]").val(),
        points: $("select[name=points]").val(),
        categories: catsSelect.val(),
    });
}
