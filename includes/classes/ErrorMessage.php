<?php

class ErrorMessage {

    public static function show ($text) {
        exit("<span class='error-banner'>$text</span>");
    }
}

?>