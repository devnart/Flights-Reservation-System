<?php 
if(isset($_COOKIE['success'])){
    echo '<div class="alert alert-success mt-4 w-75 mb-5 mx-auto position-absolute start-0 end-0 bottom-0" style="transition:300ms;opacity:0.8">'. $_COOKIE['success'] . '</div>';
}
if(isset($_COOKIE['error'])){
    echo '<div class="alert alert-danger mt-4 w-75 mb-5 mx-auto position-absolute start-0 end-0 bottom-0" style="transition:300ms;opacity:0.8">'. $_COOKIE['error'] . '</div>';
}
if(isset($_COOKIE['info'])){
    echo '<div class="alert alert-info mt-4 w-75 mb-5 mx-auto position-absolute start-0 end-0 bottom-0" style="transition:300ms;opacity:0.8">'. $_COOKIE['info'] . '</div>';
}