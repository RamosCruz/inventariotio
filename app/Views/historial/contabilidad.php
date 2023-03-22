<div class="container-fluid">
    <div class="row">
        <div class="col-sm">
        
        </div>
        <div class="col-sm-10">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a type="button" class="btn btn-primary" href="<?php echo base_url('/inicio') ?>">Volver al inicio</a>
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
$json = null; 
foreach ($jsonres as $valor){
    $json = json_decode($valor['jsonres']);
}

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
        </tr>
    </thead>
    <tbody>' ;
    
if($json == null){
    echo '<tr>' ;
        echo '<td class="col-auto" scope="row">No existen datos</td>' ;
        
        echo '</tr>' ;
}else{
    foreach ($json as $valor) {
        echo '<tr>' ;
        echo '<td class="col-auto" scope="row">' .$valor->codigo. '</td>' ;
        echo '<td>' .$valor->familia. '</td>' ;
        echo '<td class="col-auto">' .$valor->descripcion. '</td>' ;
        echo '<td class="col-auto">'.$valor->facturasyremisiones.'</td>' ;
        echo '<td class="col-auto">' .$valor->agraria. '</td>' ;
        echo '<td class="col-auto">' .$valor->bodega. '</td>' ;
        echo '<td class="col-auto">' .$valor->sumatotal. '</td>' ;
        echo '<td class="col-auto">' .$valor->existencia. '</td>' ;
        echo '<td class="col-auto">' .$valor->diferencia. '</td>' ;
        echo '<td class="col-auto">' .$valor->nota. '</td>' ;
        
        echo '</tr>' ;
        
        
    
    }
}

echo '</tbody>
</table>
</div>' ;
?>
<div class="col-sm">
        </div>
    </div>
</div>
<script>
            var tabladinamica = null;
            $(document).ready(function () 
            { 
                $("#guardarh").removeClass('disabled');
                tabladinamica = $('#inventario').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {extend:'excel',exportOptions: {format: {
                            body: function ( data, row, column, node ) {
                                //check if type is input using jquery
                                if( data.substring(0, 1)=="<"){
                                    return $(data).val();
                                }
                                return data;
                            }
                        }
                        }}
                        , {extend:'pdf',exportOptions: {format: {
                            body: function ( data, row, column, node ) {
                                //check if type is input using jquery
                                if( data.substring(0, 1)=="<"){
                                    return $(data).val();
                                }
                                return data;
                                }
                            }
                        }}
                        , {extend:'csv',exportOptions: {format: {
                            body: function ( data, row, column, node ) {
                                //check if type is input using jquery
                                if( data.substring(0, 1)=="<"){
                                    return $(data).val();
                                }
                                return data;
                                }
                            }
                        }}
                        , {extend:'copy',exportOptions: {format: {
                            body: function ( data, row, column, node ) {
                                //check if type is input using jquery
                                if( data.substring(0, 1)=="<"){
                                    return $(data).val();
                                }
                                return data;
                                }
                            }
                        }}
                        , {extend:'print',exportOptions: {format: {
                            body: function ( data, row, column, node ) {
                                //check if type is input using jquery
                                if( data.substring(0, 1)=="<"){
                                    return $(data).val();
                                }
                                return data;
                                }
                            }
                        }}
                    ],
                    scrollY: 600, //tamaño de alto de tabla
                    bAutoWidth: false,
                    pageLength: 100, //numero de registros por paginado
                    ordering: false, //no ordenar tabla
                    rowGroup: {
                        dataSrc: 1
                    },  //agrupar por familia, columna 1. (codigo es columna 0)
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
                    fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ){
                            if ( aData[8] == 0 )
                            {
                                $(nRow).css('background-color', '#B2F4B7')
                            }if ( aData[8] < 0 )
                            {
                                $(nRow).css('background-color', '#F4B2B2')
                            }if ( aData[8] > 0 )
                            {
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
                }).on( 'page.dt', function () {$('.dataTables_scrollBody').scrollTop(0);});
        }); //fin del function ready

</script>