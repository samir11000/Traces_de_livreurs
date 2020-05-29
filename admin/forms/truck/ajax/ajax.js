$(document).ready(function(){
    $("#addOrDelete").change(function(){
        $('div#changeableForm').children().remove();
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "ajax/ajax_camion.php",
                data: { choix: this.value}
            })
            .done(function(data) {
                $('#changeableForm').html(data);
                $('#searchImmat').on('input',function(e){
                    var tab = "<table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">\
                    <thead>\
                        <tr>\
                            <th>Id</th>\
                            <th>Marque</th>\
                            <th>Model</th>\
                            <th>Type</th>\
                            <th>Date première circulation</th>\
                            <th>Consomation</th>\
                            <th>nombre Km</th>\
                            <th>Taille réservoir</th>\
                            <th>Numéro immatriculation</th>\
                            <th>Type carburant</th>\
                        </tr>\
                    </thead>\
                    <tbody>";
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: "ajax/ajax_camion.php",
                        data: {choix: "supp", req: this.value}
                    })
                    .done(function(data) {
                        $('#tab-camions').html(tab+data+"</tbody></table>");
                    });
                });
              });
    });
});