<?php 
if(isset($_COOKIE['success'])){
    echo '<div class="alert alert-success mt-4 w-75 mb-5 mx-auto">'. $_COOKIE['success'] . '</div>';
}
if(isset($_COOKIE['error'])){
    echo '<div class="alert alert-danger mt-4 w-75 mb-5 mx-auto">'. $_COOKIE['error'] . '</div>';
}
if(isset($_COOKIE['info'])){
    echo '<div class="alert alert-info mt-4 w-75 mb-5 mx-auto">'. $_COOKIE['info'] . '</div>';
}