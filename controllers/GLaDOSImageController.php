<?php
require_once "GLaDOSController.php"; 

class GLaDOSImageController extends GLaDOSController {
    public $template = "base_image2.twig";
    public $temp = "Картинка";

    public function getContext() : array
    {
        $context = parent::getContext(); 
        
        $context['image'] = "../images/GLaDOS.gif";

        return $context;
    }
}