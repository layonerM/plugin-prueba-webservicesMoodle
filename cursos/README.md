# Plugin Local de Cursos para Moodle

Este plugin proporciona un webservice personalizado en Moodle para obtener una lista de cursos con soporte para paginación.

## Instalación

1. Descarga e instala la versión 4.1 de Moodle en tu máquina local.

2. Copia el contenido de este repositorio en la carpeta `local/cursos` de tu instalación de Moodle.

3. Accede a tu sitio de Moodle como administrador y ve a `Administración del sitio` -> `Notificaciones`. Moodle debería detectar el nuevo plugin y solicitar su instalación.

4. Sigue las instrucciones en pantalla para completar la instalación.

## Uso del Webservice

### Endpoint del Webservice

- **Nombre del Servicio Web:** Cursos
- **Función del Webservice:** `local_cursos_get_courses`
- **Parámetros de Entrada:**
  - `page` (Número de página que se desea obtener, por defecto 1)
  - `per_page` (Cantidad de cursos por página, por defecto 10)

