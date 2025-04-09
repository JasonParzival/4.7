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

        $loader = new \Twig\Loader\FilesystemLoader('../views');

        $twig = new \Twig\Environment($loader);

        $url = $_SERVER["REQUEST_URI"];

        $title = "";
        $template = "";
        $temp = "";
        $context = [];
        $nav = [ // добавил список словариков
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
        ];
        $menuWheatley = [
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
        ];

        $newnav = [
            [
                "title" => "Картинка",
                "url" => "image",
            ],
            [
                "title" => "Описание",
                "url" => "info",
            ]
        ];

        // тут теперь просто заполняю значение переменных
        if ($url == "/") {
            $title = "Главная";
            $template = "main.twig";
        } elseif (preg_match("#^/GLaDOS#", $url)) {
            $title = "ГЛэДОС";
            $template = "GLaDOS.twig";

            if (preg_match("#^/GLaDOS/image#", $url)) {
                $template = "base_image2.twig";
                $context['image'] = "/images/GLaDOS.gif";
                $temp = "Картинка";
            } elseif (preg_match("#^/GLaDOS/info#", $url)) {
                $template = "GLaDOS_info.twig";
                $temp = "Описание";
            }
        } elseif (preg_match("#^/wheatley#", $url)) {
            $title = "Уитли";
            $template = "wheatley.twig";

            if (preg_match("#^/wheatley/image#", $url)) {
                $template = "base_image1.twig";
                $context['image'] = "../images/wheatley.jpg";
                $temp = "Картинка";
            } elseif (preg_match("#^/wheatley/info#", $url)) {
                $template = "wheatley_info.twig";
                $temp = "Описание";
            }
        }

        $context['title'] = $title;
        $context['nav'] = $nav;
        $context['menuWheatley'] = $menuWheatley;
        $context['menuGLaDOS'] = $menuGLaDOS;
        $context['newnav'] = $newnav;
        $context['temp'] = $temp;

        // ну и рендерю
        echo $twig->render($template, $context);
        ?>
    </div> 
</body>
</html>