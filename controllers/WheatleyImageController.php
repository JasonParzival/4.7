<?php
require_once "WheatleyController.php"; 

class WheatleyImageController extends WheatleyController {
    public $template = "base_image1.twig";
    public $temp = "Картинка";

    public function getContext() : array
    {
        $context = parent::getContext(); 
        
        $context['image'] = "../images/wheatley.jpg";

        return $context;
    }
}