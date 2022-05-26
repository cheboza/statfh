window.chartUtil = (function () {
    var instance,
        months = [
        'Январь',
        'Феваль',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентябрь',
        'Октябрь',
        'Ноябрь',
        'Декабрь'
    ], colors = [
        '#4dc9f6',
        '#f67019',
        '#537bc4',
        '#acc236',
        '#166a8f',
        '#00a950',
        '#58595b',
        '#8549ba',
        '#f53794',
        ];

    /*var get_months = function(config) {
        var cfg = config || {};
        var count = cfg.count || 12;
        var section = cfg.section;
        var values = [];
        var i, value;

        for (i = 0; i < count; ++i) {
            value = months[Math.ceil(i) % 12];
            values.push(value.substring(0, section));
        }

        return values;
    };*/

    var get_months = function (config) {
        var cfg = config || {},
            start = cfg.rang[0] || 0,
            finish = cfg.rang[1] || 11,
            section = cfg.section,
            values = [],
            value, i;
        for (i=start; i <= finish; ++i)
        {
            value = months[Math.ceil(i) % 12];
            values.push(value.substring(0, section));
        }
        return values;
    }

    var get_color = function(index) {
        return colors[index % colors.length];
    };

    var createInstance = function () {
        return {
            get_months: get_months ,
            get_color: get_color,
        }
    };

    return instance || (instance = createInstance());
})();
