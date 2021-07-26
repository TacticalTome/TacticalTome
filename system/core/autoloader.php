<?php

    namespace core;

    spl_autoload_register(function(string $className): void {
        $class = array_values(array_filter(explode("\\", $className)));
        $fileName = strtolower($class[count($class)-1]) . ".php";

        $directory = "";
        switch ($class[0]) {
            case "core":    
                $directory = CORE_DIRECTORY;
                break;

            case "library":
                $directory = LIBRARY_DIRECTORY;
                break;
            
            case "model":
                $directory = MODEL_DIRECTORY;
                break;

            case "controller":
                $directory = CONTROLLER_DIRECTORY;
                break;
        }

        if (!file_exists($directory . $fileName)) throw new \Exception("Class does not exist: $className");
        
        require_once($directory . $fileName);
    });