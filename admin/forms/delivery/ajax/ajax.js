$(document).ready(function(){
    $("#addOrDelete").change(function(){
        $('div#changeableForm').children().remove();
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "ajax/ajax_delivery.php",
                data: { choix: this.value}
            })
            .done(function(data) {
                $('#changeableForm').html(data);
                $('#searchDeliveryName').on('input',function(e){
                    console.log("ok");
                    var tab = "<table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">\
                    <thead>\
                        <tr> \
                            <th>Id</th> \
                            <th>Nom</th> \
                            <th>Prénom</th> \
                            <th>Adresse Résidentielle</th> \
                            <th>Date de naissance</th> \
                            <th>Date obtention permis</th> \
                            <th>Date expiration permis</th> \
                            <th>Numéro de Permis</th> \
                            <th>Téléphone</th> \
                            <th>Ville</th> \
                        </tr> \
                    </thead>\
                    <tbody>";
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: "ajax/ajax_delivery.php",
                        data: {choix: "supp", req: this.value}
                    })
                    .done(function(data) {
                        $('#tab-camions').html(tab+data+"</tbody></table>");
                    });
                });
              });
    });
});