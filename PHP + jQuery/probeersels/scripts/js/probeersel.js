$(window).load(function () {
    //$("#inhoud").rss("https://queryfeed.net/tw?q=%40sam_verhoeven").show();

    $.when(getJSONResult("https://graph.facebook.com/Coca-Cola/feed?since=2015-12-01&access_token=CAACEdEose0cBANQcjxoyOP3czxPxMiDz9gNlBqjnDWZAvbM5Nj6ZC2JFBlAeRUP4tWt5JU8DdLMNNBhz9Ke2lj081FGmtKGQiqfzy9GrPxAFx6T8mBBJjDFfm0KvaXLsXfgsQEmMhhajmeb3UqOD8XGxQ1JIrwZBHAxqFJvYZAoWWGyGpILCYQkKjN3L1uhCxnS5bXfJZCXoimjAX0u3o"),
            getJSONResult("https://graph.facebook.com/lipton/feed?since=2015-12-01&access_token=CAACEdEose0cBANQcjxoyOP3czxPxMiDz9gNlBqjnDWZAvbM5Nj6ZC2JFBlAeRUP4tWt5JU8DdLMNNBhz9Ke2lj081FGmtKGQiqfzy9GrPxAFx6T8mBBJjDFfm0KvaXLsXfgsQEmMhhajmeb3UqOD8XGxQ1JIrwZBHAxqFJvYZAoWWGyGpILCYQkKjN3L1uhCxnS5bXfJZCXoimjAX0u3o"))
            .done(function (json1, json2) {
                json1 = json1[0].data;
                json2 = json2[0].data;
                var json = json1.concat(json2);
                console.log(json);

                json.sort(custom_sort);

                $.each(json, function (i, value) {
                    var time = value.created_time;
                    var inhoud = "";
                    inhoud += i+1 + ": " + value.created_time;
                    if (value.message != null) {
                        inhoud += " " + value.message;
                    } else {
                        inhoud += " no message";
                    }
                    inhoud += "</br></br>";
                    $("#inhoud").append(inhoud);
                });
            });
});
function getJSONResult(url) {
    return $.ajax({
        url: url,
        type: 'get',
        dataType: 'jsonp',
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Problem with call to get list of articles\n', errorThrown);
        },
        success: function (json) {
            console.log('call success, data is\n', json.data);
        }
    });
}

function custom_sort(a, b) {
    return new Date(b.created_time).getTime() - new Date(a.created_time).getTime();
}