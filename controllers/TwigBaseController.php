<?php
require_once "BaseController.php"; // обязательно импортим BaseController

class TwigBaseController extends BaseController {
    public $title = ""; // название страницы
    public $template = ""; // шаблон страницы
    public $temp = "";
    public $nav = [ // добавил список словариков
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
    public $menuWheatley = [
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

    public $menuGLaDOS = [
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

    public $newnav = [
        [
            "title" => "Картинка",
            "url" => "image",
        ],
        [
            "title" => "Описание",
            "url" => "info",
        ]
    ];
    protected \Twig\Environment $twig; // ссылка на экземпляр twig, для рендернига
    
    // теперь пишем конструктор, 
    // передаем в него один параметр
    // собственно ссылка на экземпляр twig
    // это кстати Dependency Injection называется
    // это лучше чем создавать глобальный объект $twig 
    // и быстрее чем создавать персональный $twig обработчик для каждого класс 
    public function __construct($twig)
    {
        $this->twig = $twig; // пробрасываем его внутрь
    }
    
    // переопределяем функцию контекста
    public function getContext() : array
    {
        $context = parent::getContext(); // вызываем родительский метод
        $context['title'] = $this->title; // добавляем title в контекст
        $context['nav'] = $this->nav;
        $context['menuWheatley'] = $this->menuWheatley;
        $context['menuGLaDOS'] = $this->menuGLaDOS;
        $context['newnav'] = $this->newnav;
        $context['temp'] = $this->temp;

        return $context;
    }
    
    // функция гет, рендерит результат используя $template в качестве шаблона
    // и вызывает функцию getContext для формирования словаря контекста
    public function get() {
        echo $this->twig->render($this->template, $this->getContext());
    }
}