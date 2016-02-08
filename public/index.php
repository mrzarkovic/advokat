<?php

   define( 'BASEPATH', str_replace( "\\", "/", "../system" ) );

   // Include startup scripts
   require_once( BASEPATH . '/includes/start-up.php' );
   // Include routes
   require_once( BASEPATH . '/config/routes.php' );

   // Exception handling
   set_exception_handler( 'exception_handler' );
   function exception_handler( $exception )
   {
     echo $msg = $exception->getMessage();
     //include(BASEPATH .' /views/404.php');
   }

   $core->start();

?>
