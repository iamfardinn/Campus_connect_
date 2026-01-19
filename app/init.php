<?php
  // Start PHP Session
  session_start();

  // Load Config
  require_once 'config/config.php';

  // Autoload Core Libraries
  // This automatically loads files from the 'core' folder when a class is instantiated
  spl_autoload_register(function($className){
      require_once 'core/' . $className . '.php';
  });