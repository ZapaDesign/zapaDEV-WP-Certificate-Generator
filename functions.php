<?php
    
    function get_cert_id_number($title) {
        return substr($title, 0, strpos($title, '/' ) );
    }
