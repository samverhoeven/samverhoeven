$(function () {
    var ikoontjes = {
        header: "ui-icon-circle-arrow-e",
        activeHeader: "ui-icon-circle-arrow-s"
    };

    $("#keuzes").accordion({
        active: false,
        icons: ikoontjes,
        heightStyle: "content",
        collapsible: true,
        animate: "easeOutBack"
    });
});//einde doc ready




