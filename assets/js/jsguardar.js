$(document).ready(function () {
    $(".btn").on("click", function () {
        var a = $(this).attr("title"),
            n = $(this).attr("id");
        switch (a) {
            case "Modificar":
                $(function () {
                    $("#modal-consultar").modal(),
                        $.ajax({ url: "action/registro.editar.php", type: "post", data: "id=" + n }).done(function (a) {
                            $("#consulta").html(a);
                        });
                });
                break;
            case "Eliminar":
                $(function () {
                    $("#modal-eliminar").modal(),
                        $.ajax({ url: "action/registro.eliminar.php", type: "post", data: "id=" + n }).done(function (a) {
                            $("#eliminar").html(a);
                        });
                });
                break;
            case "Incidencias":
                $(function () {
                    $("#modal-incidencias").modal(),
                        $.ajax({ url: "action/registro.incidencia.php", type: "post" }).done(function (a) {
                            $("#incidencias_div").html(a);
                        });
                });
                break;
            case "Footer":
                $(function () {
                    $("#modal-footer").modal()
                });
                break;
        }
    }),
        $("#ssids, #comments").keyup(function () {
            var a = $("#ssids").val().trim(),
                n = $("#comments").val().trim(),
                i = $("#tablaList");
            i
                .find("td.col3:contains(" + a + ")")
                .removeClass("no_cumple")
                .addClass("cumple"),
                i
                    .find("td.col6:contains(" + n + ")")
                    .removeClass("no_cumple")
                    .addClass("cumple"),
                i
                    .find("td.col3:not(:contains(" + a + "))")
                    .addClass("no_cumple")
                    .removeClass("cumple"),
                i
                    .find("td.col6:not(:contains(" + n + "))")
                    .addClass("no_cumple")
                    .removeClass("cumple"),
                i.find("tr").removeClass("fila_eliminar").show(),
                i.find("tr .no_cumple").each(function () {
                    $(this).parent().addClass("fila_eliminar").hide();
                });
        });
});
