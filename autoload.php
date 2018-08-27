<?php
spl_autoload_register( function( $class_name ) {
    /**
     * Note that actual usage may require some string operations to specify the filename
     */
    $file_name = $class_name . '.php';
    if( file_exists( $file_name ) ) {
        require $file_name;
    }
} );

// spl_autoload_register(function($className) {
    
//     $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
//     echo $_SERVER['DOCUMENT_ROOT'] . '/class/' . $className . '.php';
//     include_once $_SERVER['DOCUMENT_ROOT'] . '/class/' . $className . '.php';
    
// });	