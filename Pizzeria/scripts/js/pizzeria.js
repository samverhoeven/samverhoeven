$(window).load(function () {
    //slideshow plugin
    $("#slideshow").slideShow({
        timeOut: 5000,
        showNavigation: false,
        pauseOnHover: false,
        swipeNavigation: false
    });

    //url $_GET checken
    var $_GET = {};
    document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
        function decode(s) {
            return decodeURIComponent(s.split("+").join(" "));
        }

        $_GET[decode(arguments[1])] = decode(arguments[2]);
    });

    //ajax call voor bestelling adhv klant id
    if ($_GET["bestelcheck"]) {
        $.getJSON(
                "src/PizzeriaProject/business/ajax_json_bestelling.php",
                function (json) {
                    console.log(json);
                    //tabel opmaken
                    var $output = "<h3>Met AJAX:</h3>";
                    $output += "<table>";
                    $.each(json.Bestelregels, function (index, value) {
                        $output += "<tr><td>";
                        $output += value.Product;
                        $output += "</td><td>&euro; ";
                        $output += value.Prijs;
                        $output += "</td></tr>";
                    });
                    $output += "<tr><td></td><td>&euro; ";
                    $output += json.Totaal;
                    $output += "</td></tr></table>";
                    $(".inhoud").append($output);
                });
    }

    //loginform validatie
    $("#inlogform").submit(function (e) {
        e.preventDefault();
    });
    $("#inlogform").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            wachtwoord: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Vul uw e-mailadres in",
                email: "Vul een geldig e-mailadres in"
            },
            wachtwoord: {
                required: "Vul uw wachtwoord in"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    //alle emailadressen ophalen
    var $emails;
    $.getJSON(
            "src/PizzeriaProject/business/ajax_json_klanten.php",
            function (json) {
                $emails = json;
            }
    );

    //regform validatie
    $.validator.addMethod("emailCheck", function (value, element) {
        //alle emailadressen ophalen en vergelijken met input 
        var $vrij = true;
        $.each($emails, function (index, emailvalue) {
            if (emailvalue == value) {
                $vrij = false;
            }
        });
        return $vrij;
    });

    $("#regform").submit(function (e) {
        e.preventDefault();
    });
    $("#regform").validate({
        rules: {
            voornaam: {
                required: true
            },
            achternaam: {
                required: true
            },
            straat: {
                required: true
            },
            huisnummer: {
                required: true,
                digits: true
            },
            postcode: {
                required: true,
                digits: true
            },
            woonplaats: {
                required: true
            },
            telefoon: {
                required: true
            },
            email: {
                emailCheck: true,
                required: true,
                email: true
            },
            wachtwoord: {
                required: true
            }
        },
        messages: {
            voornaam: {
                required: "Vul uw voornaam in"
            },
            achternaam: {
                required: "Vul uw achternaam in"
            },
            straat: {
                required: "Vul uw straat in"
            },
            huisnummer: {
                required: "Vul uw huisnummer in",
                digits: "Vul een geldige huisnummer in"
            },
            postcode: {
                required: "Vul uw postcode in",
                digits: "Vul een geldige postcode in"
            },
            woonplaats: {
                required: "Vul uw woonplaats in"
            },
            telefoon: {
                required: "Vul uw telefoonnummer in"
            },
            email: {
                emailCheck: "Dit e-mailadres is al in gebruik",
                required: "Vul uw e-mailadres in",
                email: "Vul een geldig e-mailadres in"
            },
            wachtwoord: {
                required: "Vul uw wachtwoord in"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});



