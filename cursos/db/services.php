<?php
// Configuración de las funciones del servicio web
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

// Configuración del servicio web
$services = array(
    'Cursos' => array(
        'functions' => array('local_cursos_get_courses'),
        'restrictedusers' => 0, // No hay restricciones de usuarios
        'enabled' => 1,         // El servicio web está habilitado
    ),
);
