<?php
// ... (Encabezado y declaración de versiones)

class local_cursos_external extends external_api {
    public static function get_courses_parameters() {
        return new external_function_parameters(
            array(
                'page' => new external_value(PARAM_INT, 'Número de página', false, 1),
                'per_page' => new external_value(PARAM_INT, 'Cursos por página', false, 10),
            )
        );
    }

    public static function get_courses_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'Identificador del curso'),
                    'fullname' => new external_value(PARAM_TEXT, 'Nombre completo del curso'),
                    'shortname' => new external_value(PARAM_TEXT, 'Nombre corto del curso'),
                    'summary' => new external_value(PARAM_TEXT, 'Resumen del curso'),
                    'startdate' => new external_value(PARAM_INT, 'Fecha de inicio del curso (timestamp)'),
                    'enddate' => new external_value(PARAM_INT, 'Fecha de finalización del curso (timestamp)'),
                    'category' => new external_value(PARAM_TEXT, 'Categoría del curso'),
                )
            )
        );
    }

    public static function get_courses($page = 1, $per_page = 10) {
        global $DB;

        // Calcula el offset para la paginación.
        $offset = ($page - 1) * $per_page;

        // Obtiene la lista de cursos según la paginación.
        $courses = $DB->get_records_sql(
            "SELECT id, fullname, shortname, summary, startdate, enddate, category
             FROM {course}
             ORDER BY id
             LIMIT :per_page OFFSET :offset",
            array('per_page' => $per_page, 'offset' => $offset)
        );

        // Obtiene el total de cursos sin paginación.
        $total_courses = $DB->count_records('course');

        // Calcula el total de páginas.
        $total_pages = ceil($total_courses / $per_page);

        // Construye la respuesta.
        $response = array(
            'total' => $total_courses,
            'page' => $page,
            'per_page' => $per_page,
            'total_pages' => $total_pages,
            'data' => array(),
        );

        // Construye la información de cada curso.
        foreach ($courses as $course) {
            $response['data'][] = array(
                'id' => $course->id,
                'fullname' => $course->fullname,
                'shortname' => $course->shortname,
                'summary' => $course->summary,
                'startdate' => (int)$course->startdate, // Cast to int for consistency.
                'enddate' => (int)$course->enddate,     
                'category' => $course->category,
            );
        }

        return $response;
    }
}

// Configuración del servicio web.
$functions = array(
    'local_cursos_get_courses' => array(
        'classname' => 'local_cursos_external',
        'methodname' => 'get_courses',
        'classpath' => 'local/cursos/externallib.php',
        'description' => 'Obtener lista de cursos con paginación',
        'type' => 'read',
        'capabilities' => 'local/cursos:view',
    ),
);
?>
