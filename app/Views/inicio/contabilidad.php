<div class="container-fluid">
    <div class="row">
        <div class="col-sm">

        </div>
        <div class="col-sm-10">
            <div class="row">
                <div class="col">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Actualizar datos</button>
                        <button type="button" class="btn btn-primary" id="guardarh">Guardar historial</button>

                    </div>
                </div>
                <div class="col">
                    <form class="form-inline" method="post" action="<?php echo base_url('/historial') ?>">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Fecha</label>
                            <input type="date" class="form-control" name="fechahistorial" required>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Consultar historial</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm">

        </div>
    </div>
</div>


<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm">

        </div>
        <?php
        echo '<div class="col-sm-10">
<table id="inventario" class="table table-striped table-bordered" >
    <thead class="thead-dark">
        <tr>
            <th scope="col">C&oacute;digo</th>
            <th scope="col">Familia</th>
            <th scope="col">Descripci&oacute;n</th>
            <th scope="col">Facturas y Remisiones</th>
            <th scope="col">Agraria</th>
            <th scope="col">Bodega</th>
            <th scope="col">Suma Total</th>
            <th scope="col">Existencia Alix</th>
            <th scope="col">Diferencia</th>
            <th scope="col">Anotaci&oacute;n</th>
            <th scope="col">Guardar</th>
        </tr>
    </thead>
    <tbody>';

        foreach ($json as $valor) {
            echo '<tr id="' . $valor['codigo'] . '-fila">';
            echo '<td class="col-auto" scope="row">' . $valor['codigo'] . '</td>';
            echo '<td>' . $valor['familia'] . '</td>';
            echo '<td class="col-auto">' . $valor['descripcion'] . '</td>';
            echo '<td class="col-auto"><input min="0" class="form-control ltinput" type="number" codigo="' . $valor['codigo'] . '-facturasyremisiones" value="' . $valor['facturasyremisiones'] . '"></td>';
            echo '<td class="col-auto"><input min="0" class="form-control ltinput " type="number" codigo="' . $valor['codigo'] . '-agraria" value="' . $valor['agraria'] . '"></td>';
            echo '<td class="col-auto" id="' . $valor['codigo'] . '-bodega">' . $valor['bodega'] . '</td>';
            echo '<td class="col-auto" id="' . $valor['codigo'] . '-sumatotal">' . $valor['sumatotal'] . '</td>';
            echo '<td class="col-auto" id="' . $valor['codigo'] . '-existencia">' . $valor['existencia'] . '</td>';
            echo '<td class="col-auto" id="' . $valor['codigo'] . '-diferencia">' . $valor['diferencia'] . '</td>';
            echo '<td class="col-auto"><input class="form-control ltinput" type="text" codigo="' . $valor['codigo'] . '-nota" value="' . $valor['nota'] . '"></td>';
            echo '<td class="col-auto">
            <button id="' . $valor['codigo'] . '-boton" codigo="' . $valor['codigo'] . '" type="button" class="btn btn-primary guardar" disabled>
                <i class="bi bi-send-fill"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                </svg>
            </button>
            <button type="button" class="btn btn-primary alix" data-toggle="modal" data-target="#exampleModall" codigo="' . $valor['codigo'] . '" descripcion="' . $valor['descripcion'] . '" existencia="' . $valor['existencia'] . '">
                Alix
            </button>
        </td>';
            echo '</tr>';
        }
        echo '</tbody>
</table>
</div>';
        ?>
        <div class="col-sm">
        </div>
    </div>
</div>
<script>
    var tabladinamica = null;
    $(document).ready(function() {
        $("#guardarh").removeClass('disabled');
        tabladinamica = $('#inventario').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                exportOptions: {
                    format: {
                        body: function(data, row, column, node) {
                            //check if type is input using jquery
                            if (data.substring(0, 1) == "<") {
                                return $(data).val();
                            }
                            return data;
                        }
                    }
                }
            }, {
                extend: 'pdf',
                exportOptions: {
                    format: {
                        body: function(data, row, column, node) {
                            //check if type is input using jquery
                            if (data.substring(0, 1) == "<") {
                                return $(data).val();
                            }
                            return data;
                        }
                    }
                }
            }, {
                extend: 'csv',
                exportOptions: {
                    format: {
                        body: function(data, row, column, node) {
                            //check if type is input using jquery
                            if (data.substring(0, 1) == "<") {
                                return $(data).val();
                            }
                            return data;
                        }
                    }
                }
            }, {
                extend: 'copy',
                exportOptions: {
                    format: {
                        body: function(data, row, column, node) {
                            //check if type is input using jquery
                            if (data.substring(0, 1) == "<") {
                                return $(data).val();
                            }
                            return data;
                        }
                    }
                }
            }, {
                extend: 'print',
                exportOptions: {
                    format: {
                        body: function(data, row, column, node) {
                            //check if type is input using jquery
                            if (data.substring(0, 1) == "<") {
                                return $(data).val();
                            }
                            return data;
                        }
                    }
                }
            }],
            scrollY: 600, //tamaño de alto de tabla
            bAutoWidth: false,
            pageLength: 100, //numero de registros por paginado
            ordering: false, //no ordenar tabla
            rowGroup: {
                dataSrc: 1
            }, //agrupar por familia, columna 1. (codigo es columna 0)
            columnDefs: [ //funcion de columna
                {
                    target: 0, //en la columna 0
                    visible: false, //no mostrar
                    searchable: false, //tampoco buscar
                },
                {
                    target: 1, //en la columna 1
                    visible: false, //no mostrar
                    searchable: false, //tampoco buscar
                },
                {
                    width: 10,
                    targets: 3
                }
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                if (aData[8] == 0) {
                    $(nRow).css('background-color', '#B2F4B7')
                }
                if (aData[8] < 0) {
                    $(nRow).css('background-color', '#F4B2B2')
                }
                if (aData[8] > 0) {
                    $(nRow).css('background-color', '#B2DCF4')
                }
            },
            language: {
                "processing": "Procesando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": "Buscar:",
                "infoThousands": ",",
                "loadingRecords": "Cargando...",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad",
                    "collection": "Colección",
                    "colvisRestore": "Restaurar visibilidad",
                    "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                    "copySuccess": {
                        "1": "Copiada 1 fila al portapapeles",
                        "_": "Copiadas %ds fila al portapapeles"
                    },
                    "copyTitle": "Copiar al portapapeles",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Mostrar todas las filas",
                        "_": "Mostrar %d filas"
                    },
                    "pdf": "PDF",
                    "print": "Imprimir",
                    "renameState": "Cambiar nombre",
                    "updateState": "Actualizar",
                    "createState": "Crear Estado",
                    "removeAllStates": "Remover Estados",
                    "removeState": "Remover",
                    "savedStates": "Estados Guardados",
                    "stateRestore": "Estado %d"
                },
                "autoFill": {
                    "cancel": "Cancelar",
                    "fill": "Rellene todas las celdas con <i>%d<\/i>",
                    "fillHorizontal": "Rellenar celdas horizontalmente",
                    "fillVertical": "Rellenar celdas verticalmentemente"
                },
                "decimal": ",",
                "searchBuilder": {
                    "add": "Añadir condición",
                    "button": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "clearAll": "Borrar todo",
                    "condition": "Condición",
                    "conditions": {
                        "date": {
                            "after": "Despues",
                            "before": "Antes",
                            "between": "Entre",
                            "empty": "Vacío",
                            "equals": "Igual a",
                            "notBetween": "No entre",
                            "notEmpty": "No Vacio",
                            "not": "Diferente de"
                        },
                        "number": {
                            "between": "Entre",
                            "empty": "Vacio",
                            "equals": "Igual a",
                            "gt": "Mayor a",
                            "gte": "Mayor o igual a",
                            "lt": "Menor que",
                            "lte": "Menor o igual que",
                            "notBetween": "No entre",
                            "notEmpty": "No vacío",
                            "not": "Diferente de"
                        },
                        "string": {
                            "contains": "Contiene",
                            "empty": "Vacío",
                            "endsWith": "Termina en",
                            "equals": "Igual a",
                            "notEmpty": "No Vacio",
                            "startsWith": "Empieza con",
                            "not": "Diferente de",
                            "notContains": "No Contiene",
                            "notStartsWith": "No empieza con",
                            "notEndsWith": "No termina con"
                        },
                        "array": {
                            "not": "Diferente de",
                            "equals": "Igual",
                            "empty": "Vacío",
                            "contains": "Contiene",
                            "notEmpty": "No Vacío",
                            "without": "Sin"
                        }
                    },
                    "data": "Data",
                    "deleteTitle": "Eliminar regla de filtrado",
                    "leftTitle": "Criterios anulados",
                    "logicAnd": "Y",
                    "logicOr": "O",
                    "rightTitle": "Criterios de sangría",
                    "title": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "value": "Valor"
                },
                "searchPanes": {
                    "clearMessage": "Borrar todo",
                    "collapse": {
                        "0": "Paneles de búsqueda",
                        "_": "Paneles de búsqueda (%d)"
                    },
                    "count": "{total}",
                    "countFiltered": "{shown} ({total})",
                    "emptyPanes": "Sin paneles de búsqueda",
                    "loadMessage": "Cargando paneles de búsqueda",
                    "title": "Filtros Activos - %d",
                    "showMessage": "Mostrar Todo",
                    "collapseMessage": "Colapsar Todo"
                },
                "select": {
                    "cells": {
                        "1": "1 celda seleccionada",
                        "_": "%d celdas seleccionadas"
                    },
                    "columns": {
                        "1": "1 columna seleccionada",
                        "_": "%d columnas seleccionadas"
                    },
                    "rows": {
                        "1": "1 fila seleccionada",
                        "_": "%d filas seleccionadas"
                    }
                },
                "thousands": ".",
                "datetime": {
                    "previous": "Anterior",
                    "next": "Proximo",
                    "hours": "Horas",
                    "minutes": "Minutos",
                    "seconds": "Segundos",
                    "unknown": "-",
                    "amPm": [
                        "AM",
                        "PM"
                    ],
                    "months": {
                        "0": "Enero",
                        "1": "Febrero",
                        "10": "Noviembre",
                        "11": "Diciembre",
                        "2": "Marzo",
                        "3": "Abril",
                        "4": "Mayo",
                        "5": "Junio",
                        "6": "Julio",
                        "7": "Agosto",
                        "8": "Septiembre",
                        "9": "Octubre"
                    },
                    "weekdays": [
                        "Dom",
                        "Lun",
                        "Mar",
                        "Mie",
                        "Jue",
                        "Vie",
                        "Sab"
                    ]
                },
                "editor": {
                    "close": "Cerrar",
                    "create": {
                        "button": "Nuevo",
                        "title": "Crear Nuevo Registro",
                        "submit": "Crear"
                    },
                    "edit": {
                        "button": "Editar",
                        "title": "Editar Registro",
                        "submit": "Actualizar"
                    },
                    "remove": {
                        "button": "Eliminar",
                        "title": "Eliminar Registro",
                        "submit": "Eliminar",
                        "confirm": {
                            "_": "¿Está seguro que desea eliminar %d filas?",
                            "1": "¿Está seguro que desea eliminar 1 fila?"
                        }
                    },
                    "error": {
                        "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                    },
                    "multi": {
                        "title": "Múltiples Valores",
                        "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                        "restore": "Deshacer Cambios",
                        "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                    }
                },
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "stateRestore": {
                    "creationModal": {
                        "button": "Crear",
                        "name": "Nombre:",
                        "order": "Clasificación",
                        "paging": "Paginación",
                        "search": "Busqueda",
                        "select": "Seleccionar",
                        "columns": {
                            "search": "Búsqueda de Columna",
                            "visible": "Visibilidad de Columna"
                        },
                        "title": "Crear Nuevo Estado",
                        "toggleLabel": "Incluir:"
                    },
                    "emptyError": "El nombre no puede estar vacio",
                    "removeConfirm": "¿Seguro que quiere eliminar este %s?",
                    "removeError": "Error al eliminar el registro",
                    "removeJoiner": "y",
                    "removeSubmit": "Eliminar",
                    "renameButton": "Cambiar Nombre",
                    "renameLabel": "Nuevo nombre para %s",
                    "duplicateError": "Ya existe un Estado con este nombre.",
                    "emptyStates": "No hay Estados guardados",
                    "removeTitle": "Remover Estado",
                    "renameTitle": "Cambiar Nombre Estado"
                }
            } //leguaje en español, ingles por default
        }).on('page.dt', function() {
            $('.dataTables_scrollBody').scrollTop(0);
        });


        $('input[type=search]').focus(function() {
            $('input[type=search]').val('');
        });

        $('#inventario tbody').on('change', '.ltinput', function() {
            var input = $(this).attr('codigo');
            const myArray = input.split("-");
            var codigo = myArray[0];
            var campo = myArray[1];
            //var data = tabladinamica.row( this.closest( 'td' ) ).data();
            var valor = $(this).val();


            $("#" + codigo + "-boton").removeAttr('disabled');
            $("#guardarh").addClass('disabled');
            cambioysuma(codigo, campo, valor);
        });
        $('#inventario tbody').on('click', '.guardar', function() {
            var data = tabladinamica.row($(this).parents('tr')).data();
            var tcodigo = data[0];
            var tfamilia = data[1];
            var tdescripcion = data[2];
            var tfacturasyremisiones = $('input[codigo="' + tcodigo + '-facturasyremisiones"]').val();
            var tagraria = $('input[codigo="' + tcodigo + '-agraria"]').val();
            var tbodega = $("#" + tcodigo + "-bodega").html();
            var tsumatotal = $("#" + tcodigo + "-sumatotal").html();
            var texistencia = $("#" + tcodigo + "-existencia").html();
            var tdiferencia = $("#" + tcodigo + "-diferencia").html();
            var tnota = $('input[codigo="' + tcodigo + '-nota"]').val();
            var arregloPost = {
                "codigo": tcodigo,
                "facturasyremisiones": tfacturasyremisiones,
                "agraria": tagraria,
                "bodega": tbodega,
                "sumatotal": tsumatotal,
                "existencia": texistencia,
                "diferencia": tdiferencia,
                "nota": tnota,
                "actualizar" : "contabilidad"
            }

            guardarelemento(arregloPost);

        });
        $('#guardarh').click(function() {
            existehistorial();
        });

        $('#inventario tbody').on('click', '.alix', function() {
            var data = tabladinamica.row($(this).parents('tr')).data();
            var tcodigo = data[0];
            var tdescripcion = data[2];
            var texistencia = $("#" + tcodigo + "-existencia").html();

            $('#alixcodigo').val(tcodigo);
            $('#alixdescricion').val(tdescripcion);
            $('#alixexistencia').val(texistencia);
        });

        $('#guardaralix').click(function() {
            var arregloPost = {
                "codigo": $('#alixcodigo').val(),
                "existencia": $('#alixexistencia').val()
            }
            actualizaralix(arregloPost);
        });
    }); //fin del function ready

    function cambioysuma(codigo, campo, valor) {
        var sumatotal = 0;


        if (campo == "facturasyremisiones") {
            var agraria = parseInt($('input[codigo="' + codigo + '-agraria"]').val());
            var bodega = parseInt($("#" + codigo + "-bodega").html());
            var sumatotal = parseInt(valor) + agraria + bodega;
            $("#" + codigo + "-sumatotal").html(sumatotal);

        } else if (campo == "agraria") {
            var facturasyremisiones = parseInt($('input[codigo="' + codigo + '-facturasyremisiones"]').val());
            var bodega = parseInt($("#" + codigo + "-bodega").html());
            var sumatotal = parseInt(valor) + facturasyremisiones + bodega;
            $("#" + codigo + "-sumatotal").html(sumatotal);
        }

        var diferencia = $("#" + codigo + "-sumatotal").html() - parseInt($("#" + codigo + "-existencia").html());
        $("#" + codigo + "-diferencia").html(diferencia)




    }

    function guardarelemento(arreglo) {
        $.post("<?php echo base_url('cambiar') ?>", // url
            arreglo, // data to be submit
            function(data, status, jqXHR) { // success callback
                if (status == 'success') {
                    Swal.fire({
                        title: 'Hecho!',
                        timer: 1000,
                        showCancelButton: false,
                        showConfirmButton: false,
                        icon: 'success'
                    });

                    if (parseInt($("#" + arreglo.codigo + "-diferencia").html()) == 0) {
                        $("#" + arreglo.codigo + "-fila").css('background-color', '#B2F4B7')
                    }
                    if (parseInt($("#" + arreglo.codigo + "-diferencia").html()) < 0) {
                        $("#" + arreglo.codigo + "-fila").css('background-color', '#F4B2B2')
                    }
                    if (parseInt($("#" + arreglo.codigo + "-diferencia").html()) > 0) {
                        $("#" + arreglo.codigo + "-fila").css('background-color', '#B2DCF4')
                    }
                    $("#" + arreglo.codigo + "-boton").prop('disabled', true);
                    $("#guardarh").removeClass('disabled');


                } else {
                    Swal.fire({
                        title: 'Error!',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false,
                        icon: 'error'
                    });
                }

            })
    }

    function existehistorial() {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('existehistorial') ?>",
            dataType: 'JSON',
            data: {
                "fecha": "hola"
            },
            success: function(response) {
                console.log(response);
                if (response.length == 0) {
                    guardarhistorial();
                } else {
                    Swal.fire({
                        title: 'Ya existe el historial.',
                        text: "¿Desea actualizarlo?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            actualizarhistorial();
                        }
                    })
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function guardarhistorial() {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('guardarhistorial') ?>",
            dataType: 'JSON',
            data: {
                "fecha": "hola"
            },
            success: function(response) {
                console.log(response);
                Swal.fire({
                    title: 'Se guardo con exito!',
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false,
                    icon: 'success'
                });
            },
            error: function(error) {}
        });
    }

    function actualizarhistorial() {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('actualizarhistorial') ?>",
            dataType: 'JSON',
            data: {
                "fecha": "hola"
            },
            success: function(response) {
                console.log(response);
                Swal.fire({
                    title: 'Se actualizo con exito!',
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false,
                    icon: 'success'
                });
            },
            error: function(error) {}
        });
    }

    function actualizaralix(arreglo) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('actualizaralix') ?>",
            dataType: 'JSON',
            data: arreglo,
            success: function(response) {
                var texistencia = $("#" + arreglo.codigo + "-existencia").html(arreglo.existencia);
                cambioysuma(arreglo.codigo, 0, 0);
                var texistencia = $("#" + arreglo.codigo + "-existencia").html();
                var tdiferencia = $("#" + arreglo.codigo + "-diferencia").html();
                var arregloPost = {
                    "codigo": arreglo.codigo,
                    "existencia": texistencia,
                    "diferencia": tdiferencia,
                    "actualizar" : "alix"
                }

                guardarelemento(arregloPost);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    //modal nuevo registro

    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
</script>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¡Advertencia! Se eliminaran los datos actuales.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Descargar la plantilla para rellenar datos.</label>
                    <br>
                    <a href="<?= base_url('assets/datos/plantilla.csv'); ?>">plantilla.csv</a>
                </div>
                <?php foreach ($errors as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>

                <?= form_open_multipart('upload') ?>
                <input type="file" name="userfile" size="20" accept=".csv">
                <br><br>
                <input type="submit" value="Enviar" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar existencia de Alix</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">C&oacute;digo</label>
                    <input type="text" class="form-control" id="alixcodigo" disabled>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Descripci&oacute;n</label>
                    <input type="text" class="form-control" id="alixdescricion" disabled>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Existencia</label>
                    <input type="text" class="form-control" id="alixexistencia">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="guardaralix" data-bs-dismiss="modal" class="close">Actualizar</button>
            </div>
        </div>
    </div>
</div>