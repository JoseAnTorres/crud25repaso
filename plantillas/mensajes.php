<?php
        if(isset($_SESSION['mensajes'])){
            echo <<<CADENA
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            {$_SESSION['mensajes']}
            </div>
            </div>
            CADENA;
            unset($_SESSION['mensajes']);
        }