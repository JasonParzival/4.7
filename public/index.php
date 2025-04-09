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

        //$title = "";
        //$template = "";
        //$temp = "";
        $context = [];

        $controller = new Controller404($twig);

        /*$nav = [ // добавил список словариков
            [
                "title" => "Главная",
                "url" => "/",
            ],
            [
                "title" => "Уитли",
                "url" => "/wheatley",
            ],
            [
                "title" => "ГЛэДОС",
                "url" => "/GLaDOS",
            ]
        ];*/
        /*$menuWheatley = [
            [
                "btn" => "primary",
                "title" => "Уитли",
                "url" => "/wheatley",
            ],
            [
                "btn" => "link",
                "title" => "Картинка",
                "url" => "/wheatley/image",
            ],
            [
                "btn" => "link",
                "title" => "Описание",
                "url" => "/wheatley/info",
            ]
        ];

        $menuGLaDOS = [
            [
                "btn" => "primary",
                "title" => "ГЛэДОС",
                "url" => "/GLaDOS",
            ],
            [
                "btn" => "link",
                "title" => "Картинка",
                "url" => "/GLaDOS/image",
            ],
            [
                "btn" => "link",
                "title" => "Описание",
                "url" => "/GLaDOS/info",
            ]
        ];*/

        /*$newnav = [
            [
                "title" => "Картинка",
                "url" => "image",
            ],
            [
                "title" => "Описание",
                "url" => "info",
            ]
        ];*/

        // тут теперь просто заполняю значение переменных
        if ($url == "/") {
           // $title = "Главная";
            //$template = "main.twig";
            $controller = new MainController($twig); // создаем экземпляр контроллера для главной страницы
        } elseif (preg_match("#^/GLaDOS#", $url)) {
            //$title = "ГЛэДОС";
            //$template = "GLaDOS.twig";
            $controller = new GLaDOSController($twig);

            if (preg_match("#^/GLaDOS/image#", $url)) {
                //$template = "base_image2.twig";
                //$context['image'] = "/images/GLaDOS.gif";
                //$temp = "Картинка";
                $controller = new GLaDOSImageController($twig);
            } elseif (preg_match("#^/GLaDOS/info#", $url)) {
                //$template = "GLaDOS_info.twig";
                //$temp = "Описание";
                $controller = new GLaDOSInfoController($twig);
            }
        } elseif (preg_match("#^/wheatley#", $url)) {
            //$title = "Уитли";
            //$template = "wheatley.twig";
            $controller = new WheatleyController($twig);

            if (preg_match("#^/wheatley/image#", $url)) {
                //$template = "base_image1.twig";
                //$context['image'] = "../images/wheatley.jpg";
                //$temp = "Картинка";
                $controller = new WheatleyImageController($twig);
            } elseif (preg_match("#^/wheatley/info#", $url)) {
                //$template = "wheatley_info.twig";
                //$temp = "Описание";
                $controller = new WheatleyInfoController($twig);
            }
        }

        //$context['title'] = $title;
        //$context['nav'] = $nav;
        //$context['menuWheatley'] = $menuWheatley;
        //$context['menuGLaDOS'] = $menuGLaDOS;
        //$context['newnav'] = $newnav;
        //$context['temp'] = $temp;

        // ну и рендерю
        //echo $twig->render($template, $context);

        // проверяем если controller не пустой, то рендерим страницу
        if ($controller) {
            $controller->get();
        }
        ?>
    </div> 
</body>
</html>