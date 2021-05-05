<?php

class Session {
    public function set($type,$message) {
        setcookie($type,$message,time()+1,'/');
    }
}