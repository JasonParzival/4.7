<?php
require_once "WheatleyController.php"; 

class WheatleyImageController extends WheatleyController {
    public $template = "base_image1.twig";
    //$context['image'] = "../images/wheatley.jpg";
    public $temp = "Картинка";

    public function getContext() : array
    {
        $context = parent::getContext(); 
        
        $context['image'] = "../images/wheatley.jpg";

        return $context;
    }
}