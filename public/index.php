<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"  rel="stylesheet" />
</head>
<body>
    <div class="container">
        <?php 
        require_once '../vendor/autoload.php';
        require_once "../controllers/MainController.php";
        require_once "../controllers/WheatleyController.php";
        require_once "../controllers/WheatleyImageController.php";
        require_once "../controllers/WheatleyInfoController.php";
        require_once "../controllers/GLaDOSController.php";
        require_once "../controllers/GLaDOSImageController.php";
        require_once "../controllers/GLaDOSInfoController.php";

        require_once "../controllers/Controller404.php";

        require_once "../controllers/BaseController.php";
        require_once "../controllers/TwigBaseController.php";

        $loader = new \Twig\Loader\FilesystemLoader('../views');

        $twig = new \Twig\Environment($loader);

        $url = $_SERVER["REQUEST_URI"];

        $context = [];

        $controller = new Controller404($twig);

        if ($url == "/") {
            $controller = new MainController($twig);
        } elseif (preg_match("#^/GLaDOS#", $url)) {
            $controller = new GLaDOSController($twig);

            if (preg_match("#^/GLaDOS/image#", $url)) {
                $controller = new GLaDOSImageController($twig);
            } elseif (preg_match("#^/GLaDOS/info#", $url)) {
                $controller = new GLaDOSInfoController($twig);
            }
        } elseif (preg_match("#^/wheatley#", $url)) {
            $controller = new WheatleyController($twig);

            if (preg_match("#^/wheatley/image#", $url)) {
                $controller = new WheatleyImageController($twig);
            } elseif (preg_match("#^/wheatley/info#", $url)) {
                $controller = new WheatleyInfoController($twig);
            }
        }
        if ($controller) {
            $controller->get();
        }
        ?>
    </div> 
</body>
</html>