$(document).ready(function () {
    $(".eliminar").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Está seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    $(".dar_baja").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Está seguro de dar de baja?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    $(".reingresar").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Está seguro de reingresar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    $('#buscar_libr').select2({
        dropdownParent: $("#prestar_libro")
    });
    $('#estudiante_libr').select2({
        dropdownParent: $("#prestar_libro")
    });
    $('#buscar_articulo').select2({
        dropdownParent: $("#prestar_articulo")
    });
    $('#estudiante_articulo').select2({
        dropdownParent: $("#prestar_articulo")
    });
    $('#buscar_tesis').select2({
        dropdownParent: $("#prestar_tesis")
    });
    $('#estudiante_tesis').select2({
        dropdownParent: $("#prestar_tesis")
    });
    $(".devolver").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estado conforme?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    $('#alerta').toast('show');
    $('#errorCambioPass').toast('show');
    
});