var NewPost = {
    timer: null,
    xhr: new XMLHttpRequest(),
    
    getCities: function (city_name) {

        if (city_name == '') {
            $('#city_response').slideUp('fast',function (obj) {
                $('#city_response').html('');
            });
            return;
        }

        var req = {
            "apiKey": "854bca8ae06ea099dae26d31a22e92e0",
            "modelName": "Address",
            "calledMethod": "getCities",
            "methodProperties": {
                "FindByString": city_name,
            }
        };

        this.xhr.open("POST", "https://api.novaposhta.ua/v2.0/json/", false);
        this.xhr.send(JSON.stringify(req));

        var res = JSON.parse(this.xhr.responseText);

        if (res.data.length > 0) {
            var html = res.data.map(function (d) {
                // return '<div onclick="NewPost.selectCity(\''+ d.DescriptionRu +'\')">' + d.DescriptionRu + '</div>'
                return d.DescriptionRu
            });
            // $('#city_response').html(html);
            console.log(html);
            return html;
        } else if (res.data.length <= 0) {
            // $('#city_response').html('').slideUp();
            return;
        }
        if (!$('#city_response').is(':visible')) {
            // $('#city_response').slideDown();
        }
    },

    selectCity: function (cityName) {
        $('#city_name').val(cityName);
        $('#city_response').html('').slideUp(function () {
            $('#n_post_office').html('');
            NewPost.getPostOffice(cityName);
        });
    },

    getPostOffice: function (cityName) {
        console.log(cityName);
        var req = {
            "apiKey": "854bca8ae06ea099dae26d31a22e92e0",
            "modelName": "AddressGeneral",
            "calledMethod": "getWarehouses",
            "methodProperties": {
                "CityName": cityName,
                "Language": "ru"
            },
        };

        this.xhr.open("POST", "https://api.novaposhta.ua/v2.0/json/", false);
        this.xhr.send(JSON.stringify(req));

        var res = JSON.parse(this.xhr.responseText);
        if (res.data.length > 0) {
            var html = res.data.map(function (d) {
                return '<option value="'+d.Number+'">' + d.DescriptionRu + '</option>'
            });
            $('#n_post_office').html(html);
        }

    },

    callCities: function () {
        if (this.timer) clearTimeout(this.timer);
        this.timer = setTimeout(function () {
            NewPost.getCities($('#city_name').val());
        }, 300);

    },

};
