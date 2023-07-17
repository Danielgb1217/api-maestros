function sendDataToAPI(event) { //insertar valores en la BD
    event.preventDefault();

    const fullName = document.getElementById('fullName').value;
    const identificationCard = document.getElementById('card').value;
    const phone = document.getElementById('phone').value;
    const address = document.getElementById('address').value;
    const id = document.getElementById('idTeacher').value;

    const formData = {
        nombrecompleto: fullName,
        cedula: identificationCard,
        telefono: phone,
        direccion: address,
        id: id
    };

    let typeMethod = '';

    if (id) typeMethod = 'PUT'; //si me envian un id Hago un put de lo contrario estor haciendo un post
    else typeMethod = 'POST';

    console.log(typeMethod);

    fetch('http://localhost:8000/api/teachers.php', {
        method: typeMethod,
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
        .then(response => response.json())
        .then(data => {
            getDataFromAPI();
            console.log(data);
        })
        .catch(error => {

            console.error('Error al enviar datos a la API:', error);
        });

    window.location.reload();
}

function getDataFromAPI() {

    const apiURL = 'http://localhost:8000/api/teachers.php';

    fetch(apiURL)
        .then(response => response.json())
        .then(data => {
            const tableApi = document.querySelector('#tableApi tbody');
            tableApi.innerHTML = '';
            data.forEach(teacher => {
                const row = document.createElement('tr');   //genero la tabla con los valores obtenidos de la BD

                const idCell = document.createElement('th');
                idCell.textContent = teacher.id;
                row.appendChild(idCell);

                const fullNameCell = document.createElement('td');
                fullNameCell.textContent = teacher.nombrecompleto;
                row.appendChild(fullNameCell);

                const identificationCardCell = document.createElement('td');
                identificationCardCell.textContent = teacher.cedula;
                row.appendChild(identificationCardCell);

                const phoneNumberCell = document.createElement('td');
                phoneNumberCell.textContent = teacher.telefono;
                row.appendChild(phoneNumberCell);

                const addressCell = document.createElement('td');
                addressCell.textContent = teacher.direccion;
                row.appendChild(addressCell);

                const actionsCell = document.createElement('td');
                const editIcon = generateIcon('fa-pencil-alt', 'Editar', teacher.id);
                const deleteIcon = generateIcon('fa-trash', 'Eliminar', teacher.id);

                editIcon.addEventListener('click', function () {

                    document.getElementById('fullName').value = teacher.nombrecompleto;
                    document.getElementById('card').value = teacher.cedula;
                    document.getElementById('phone').value = teacher.telefono;
                    document.getElementById('address').value = teacher.direccion;
                    document.getElementById('idTeacher').value = teacher.id;

                });

                deleteIcon.addEventListener('click', function () {

                    const idDelete = {
                        id: teacher.id
                    };

                    fetch('http://localhost:8000/api/teachers.php', {       //elimino registros de la BD
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(idDelete)
                    })
                        .then(response => response.json())
                        .then(data => {
                            getDataFromAPI();
                            console.log(data);
                        })
                        .catch(error => {
                            console.error('Error al enviar datos a la API:', error);
                        });

                });

                actionsCell.appendChild(editIcon);
                actionsCell.appendChild(deleteIcon);
                row.appendChild(actionsCell);
                tableApi.appendChild(row);

            });
        })
        .catch(error => {
            console.error('Error al obtener datos:', error);
        });


}


function generateIcon(iconClass, tooltip, id) {
    const iconWrapper = document.createElement('span');
    iconWrapper.classList.add('icon-wrapper');

    const icon = document.createElement('span');
    icon.classList.add('fas');
    icon.classList.add(iconClass);
    icon.setAttribute('data-bs-toggle', 'tooltip');
    icon.setAttribute('data-bs-original-title', tooltip);
    icon.setAttribute('data-id', id);
    iconWrapper.appendChild(icon);

    return iconWrapper;
}

document.addEventListener('DOMContentLoaded', getDataFromAPI);
document.getElementById('formApi').addEventListener('submit', sendDataToAPI);
