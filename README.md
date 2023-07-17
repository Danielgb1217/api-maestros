
# Proyecto API de Maestros
Autor: Daniel Andrés González

Este proyecto es una API simple para gestionar datos de maestros. Permite realizar operaciones básicas como obtener, crear, actualizar y eliminar registros de maestros en una base de datos MySQL.

## Requisitos previos
Antes de ejecutar este proyecto localmente, asegúrate de tener instalado lo siguiente:

PHP 5.6 o superior.
MySQL o algún otro sistema de gestión de bases de datos compatible con PHP.
Un servidor web local (por ejemplo, Apache) para ejecutar la API.

## Descarga y configuración
Clona el repositorio o descárgalo como archivo ZIP.
Coloca el contenido en tu servidor web local (por ejemplo, dentro de la carpeta htdocs de XAMPP o www de WAMP).
Crea una base de datos en tu sistema de gestión de bases de datos llamada pruebatecnica y asegúrate de importar el archivo database.sql incluido en el repositorio para crear la tabla maestros.

## En el siguiente enlace puedss encontrar la documentación más detallasda de la api
https://app.swaggerhub.com/apis/Danielgb1217/api-maestros_prueba_tecnica/1.0.0

## Uso de la API
La API admite las siguientes operaciones:

Obtener todos los maestros

GET /api/teachers.php
Crear un nuevo maestro

POST /api/teachers.php
Envía un JSON con los datos del maestro a crear:

json

{
  "cedula": "123456789",
  "nombrecompleto": "Nombre Apellido",
  "telefono": "555-1234",
  "direccion": "Dirección de ejemplo"
}
Actualizar un maestro existente

PUT /api/teachers.php
Envía un JSON con los datos del maestro a actualizar, incluyendo el ID del maestro a modificar:

json

{
  "id": 1,
  "cedula": "987654321",
  "nombrecompleto": "Nuevo Nombre",
  "telefono": "555-5678",
  "direccion": "Nueva dirección"
}
Eliminar un maestro

DELETE /api/teachers.php
Envía un JSON con el ID del maestro a eliminar:

json

{
  "id": 1
}

## Ejecutar el proyecto
Inicia tu servidor web y asegúrate de que el servidor de bases de datos esté en funcionamiento.
Abre tu navegador y navega a la dirección donde hayas ubicado el proyecto.
Puedes utilizar herramientas como Postman para probar las diferentes operaciones de la API.
Recuerda adaptar la URL de la API en el código de ejemplo de la interfaz web (sendDataToAPI y getDataFromAPI) para que coincida con la dirección de tu servidor local.
