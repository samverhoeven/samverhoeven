$(window).load(function () {
    console.log("test");

    //4 divs in #inhoud als tabs laten verschijnen
    $("#inhoud").tabs();

    //Ajax call om landenselectie op te vullen
    var landselect = $("#countries");
    $.getJSON("php/ajax_json_countries.php")
    .done(function (jeeson) {
        console.log("Request succes");
        landselect.append("<option value='' selected='selected'>-- kies een land --</option>");
        $.each(jeeson, function (index, data) {
            landselect.append("<option value=" + jeeson[index].country_code + ">" + jeeson[index].country_name + "</option>");
        });
    })
    .fail(function(jqxhr, textStatus, error){
        console.log("Request failed: " + textStatus + ", " + error);
    })
    ;
    //Ajax call naaar alle luchthavens van een bepaald geselecteerd land 
    landselect.change(function () {
        var luchtselect = $("#airports");
        $.getJSON(
                "php/ajax_json_airports.php",
                {country_code: landselect.val()},
        function (jeeson) {
            luchtselect.empty();
            luchtselect.append("<option value='' selected='selected'>-- kies een luchthaven --</option>");
            $.each(jeeson, function (index, data) {
                luchtselect.append("<option value=" + jeeson[index].airport_code + ">" + jeeson[index].airport_name + "</option>")
            });
        }
        );
    });

    //datepicker tonen bij alle inputvelden met de class datum
    $.datepicker.setDefaults($.datepicker.regional['nl-BE']);
    $(".datum").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0,
        maxDate: 365,
        changeMonth: true,
        changeYear: true
    });

    //retourdatum wel/niet laten zien als retour wel/niet aangevinkt is
    $("#terugdatum").parent().hide();
    $("#retour").change(function () {
        if (this.checked) {
            $("#terugdatum").parent().show();
        } else {
            $("#terugdatum").parent().hide();
        }
    });

    //pop up voor info boekingreferentie
    $("#dialoog").dialog({
        autoOpen: false,
        buttons: {
            "Ok": function () {
                $(this).dialog("close");
            }
        },
        modal: true,
        width: 500
    });
    $("#refinfo").click(function (e) {
        console.log($("#refinfo"));
        -
                e.preventDefault();
        $("#dialoog").dialog("open");
    });

    //frmVluht validatie
    $("#frmVlucht").submit(function (e) {
        e.preventDefault();
    });
    $("#frmVlucht").validate({
        rules: {
            vertrekdatum: {
                required: true,
                dateISO: true
            },
            terugdatum: {
                required: "#retour:checked",
                dateISO: true
            },
            "tickettype[]": {required: true}
        },
        messages: {
            vertrekdatum: {
                required: "Vul een vertrekdatum in",
                dateISO: "Dit is geen geldige datum (jj-mm-dd)"
            },
            terugdatum: {
                required: "Vul een aankomstdatum in",
                dateISO: "Dit is geen geldige datum (jj-mm-dd)"
            },
            "tickettype[]": "Selecteer minstens &eacute;&eacute;n optie"
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "tickettype[]") {
                error.insertAfter($("#ticketflexibel"));
            } else if (element.attr("name") == "vertrekdatum") {
                error.insertAfter($("#retour"));
            }
            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });


    //frmChecking validatie
    $.validator.addMethod("refcheck", function (value, element) {
        return value.match(/^[a-zA-Z0-9]+$/i);
    });

    $("#frmCheckin").submit(function (e) {
        e.preventDefault();
    });
    $("#frmCheckin").validate({
        rules: {
            boekingreferentie: {
                minlength: 6,
                maxlength: 6,
                refcheck: true
            },
            kredietkaartnummer: "creditcard",
            familienaam: "required"
        },
        messages: {
            boekingreferentie: {
                minlength: "De boekingreferentie moet exact 6 karakters zijn",
                maxlength: "De boekingreferentie moet exact 6 karakters zijn",
                refcheck: "De boekingreferentie mag enkel letter en cijfers bevatten"
            },
            kredietkaartnummer: "Het kredietkaartnummer is niet geldig",
            familienaam: "Vul een familienaam in"
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    //slideshow via jQuery-slideshow-plugin
    $('img').slideShow({
        timeOut: 2000,
        showNavigation: true,
        pauseOnHover: true,
        swipeNavigation: true
    });
});

