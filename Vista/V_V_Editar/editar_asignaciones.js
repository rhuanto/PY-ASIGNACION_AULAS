document.addEventListener('DOMContentLoaded', function () {
    const asignacionSelect = $('#asignacion-select'); // Usamos jQuery para seleccionar el elemento
    const docenteInput = document.getElementById('docente');
    const cursoInput = document.getElementById('curso');
    const diaInput = document.getElementById('dia');
    const horaInicioInput = document.getElementById('hora_inicio');
    const horaFinInput = document.getElementById('hora_fin');
    const grupoInput = document.getElementById('grupo');
    const cicloInput = document.getElementById('ciclo');
    const cantidadAlumnosInput = document.getElementById('cantidad_alumnos');
    const guardarBtn = document.getElementById('guardar-btn');
    const eliminarBtn = document.getElementById('eliminar-btn');

    // Inicializa Select2 en el select de asignaciones
    asignacionSelect.select2({
        placeholder: 'Seleccione una asignación',
    });

    // Cargar todas las asignaciones en el select
    fetch('../../controlador/C_ListaAsignaciones.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(asignacion => {
                const option = new Option(`${asignacion.Docente} - ${asignacion.Curso} - ${asignacion.Dia}`, asignacion.Id_Asignacion);
                asignacionSelect.append(option);
            });
        })
        .catch(error => console.error('Error:', error));

    // Manejar el cambio en el select
    asignacionSelect.on('change', function () {
        const idAsignacion = $(this).val();
        if (idAsignacion) {
            fetch(`../../controlador/C_Editar.php?id_asignacion=${idAsignacion}`)
                .then(response => response.json())
                .then(data => {
                    docenteInput.value = data.Docente;
                    cursoInput.value = data.Curso;
                    diaInput.value = data.Dia;
                    horaInicioInput.value = data.Hora_Inicio;
                    horaFinInput.value = data.Hora_Fin;
                    grupoInput.value = data.Grupo;
                    cicloInput.value = data.Ciclo;
                    cantidadAlumnosInput.value = data.Cantidad_Alumnos;
                })
                .catch(error => console.error('Error:', error));
        }
    });

    // Manejar el botón de guardar
    guardarBtn.addEventListener('click', function () {
        const idAsignacion = asignacionSelect.val();
        const data = {
            id: idAsignacion,
            docente: docenteInput.value,
            curso: cursoInput.value,
            dia: diaInput.value,
            hora_inicio: horaInicioInput.value,
            hora_fin: horaFinInput.value,
            grupo: grupoInput.value,
            ciclo: cicloInput.value,
            cantidad_alumnos: cantidadAlumnosInput.value
        };

        fetch('../../controlador/C_Actualizar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Actualización exitosa');
                    location.reload(); // Recargar la página
                } else {
                    alert('Error al actualizar');
                }
            })
            .catch(error => console.error('Error:', error));
    });

    // Manejar el botón de eliminar
    eliminarBtn.addEventListener('click', function () {
        const idAsignacion = asignacionSelect.val();
        if (confirm('¿Estás seguro de que quieres eliminar esta asignación?')) {
            fetch(`../../controlador/C_Borrar.php?id_asignacion=${idAsignacion}`, {
                method: 'DELETE'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Eliminación exitosa');
                        location.reload(); // Recargar la página
                    } else {
                        alert('Error al eliminar');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
});
