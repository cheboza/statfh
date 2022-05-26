var chartsData = {
    labels: [],
    datasets: [],

    setLabels: function(labels){
        this.labels = labels
    },
    pushDataset(dataset){
        this.datasets.push(dataset);
    },
    resetDataset(){
        this.datasets = [];
    }
};

const chartsDataset = {
    label: '',
    data: [],
    fill: false,
    borderColor: '#000',
    tension: 0.01,

    setBorderColor(index){
        this.borderColor = window.chartUtil.get_color(index)
    },
    setData(data){
        this.data = data;
    },
    setLabel(label){
        this.label = label;
    }
};

window.chartsSendAjax = function (data) {
    $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        success: function(response) {
            const shop_data = Object.create(chartsData);
            shop_data.setLabels(response['axis_x']);
            shop_data.resetDataset();
            for(i=0; i <  Object.keys(response['stat']).length; ++i)
            {
                const shop_dataset = Object.create(chartsDataset);
                shop_dataset.setLabel(response['axis_y'][i]['title']);
                shop_dataset.setBorderColor(i);
                shop_dataset.setData(response['stat'][i]);
                shop_data.pushDataset(shop_dataset);
            }
            render_chart(shop_data);
        }
    });
}

function render_chart(data) {
    const options = {
        scales: {
            y: {
                min: 0
            }
        }
    };

    const config = {
        type: 'line',
        data: data,
        options: options,
    };
    //fhCharts = null;
    new Chart(
        find_or_create_chart(),
        config
    );
}

let count_charts = 0;
function find_or_create_chart() {
    count_charts++;
    $('#content_statChart').empty().append("<canvas id='stat_chart"+count_charts+"'></canvas>");
    return document.getElementById('stat_chart' + count_charts);
}

window.chartsEmpty = function() {
    $('#content_statChart').empty();
}
