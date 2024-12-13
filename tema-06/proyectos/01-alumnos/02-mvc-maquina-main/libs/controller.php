<?php

    class Controller {

        function __construct() {
            # No existe view, sino que se crea this->view
            $this->view = new View();

        }
        
        function loadModel($model) {

            $url = 'models/' . $model . '.model.php';
            if (file_exists($url)) {

                require $url;

                $modelName = $model.'Model';
                $this->model = new $modelName();
            }
        }
    }


?>