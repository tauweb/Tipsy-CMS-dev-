<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Класс формирования данных для html страницы
 *
 */
class TDocument
{

    /**
     * Содержит сообщения об ошибках
     */
    public $errors = array();

    /**
     * @var array Массив, содержит теги для html контейнера <head>
     *
     */
    public $head_data = [ //Todo: После нормализации работы БД, переписать!
        // Заголовок документа (html5)
        // http://www.w3schools.com/html5/tag_title.asp
        "title" => "Домашняя страница Tipsy CMS",

        // Применяется для определения стилей элементов веб-страницы
        // http://www.w3schools.com/html5/tag_style.asp
        "style" => [
            // Определяет устройство вывода, для работы с которым предназначена таблица стилей.
            "media" => "", // [text/css]
            // Сообщает браузеру, какой синтаксис использовать, чтобы правильно интерпретировать стили.
            "type" => "", // [media_query]
            // Specifies that the styles only apply to this element's parent element and that element's child elements (HTML5)
            "scoped" => "", // [scoped]
        ],

        // Инструктирует браузер относительно полного базового адреса текущего документа
        // http://www.w3schools.com/html5/tag_base.asp
        "base" => [
            // Адрес, который должен использоваться для указания полного пути к файлам.
            "href" => "", // [URL]
            // Имя окна или фрейма, куда будет загружаться документ, открываемый по ссылке.
            "target" => "", // [_blank, _parent, _self, _top, framename]
        ],

        // Устанавливает связь с внешним документом вроде файла со стилями или со шрифтами
        // http://www.w3schools.com/html5/tag_link.asp
        "link" => [
            // Путь к связываемому файлу.
            "href" => "", // [URL]
            // Specifies the language of the text in the linked document
            "hreflang" => "", // [language_code]
            // Определяет устройство, для которого следует применять стилевое оформление.
            "media" => "", // [media_query]
            // Определяет отношения между текущим документом и файлом, на который делается ссылка.
            "rel" => "", // [alternate, archives, author, bookmark, external, first, help, icon, last, licence, next, nofollow, noreferrer, pingback, prefetch, prev, search, sidebar, stylesheet, tag, up]
            // Указывает размер иконок для визуального отображения.
            "sizes" => "", // [HeightxWidth, any]
            // MIME-тип данных подключаемого файла.
            "type" => "", // [MIME_type]
        ],

        // Определяет метатеги, которые используются для хранения информации предназначенной для браузеров и поисковых систем.
        // http://www.w3schools.com/html5/tag_meta.asp
        "meta" => [
            // Задает кодировку документа.
            "charset" => "", // [character_set]
            // Устанавливает значение атрибута, заданного с помощью name или http-equiv.
            "content" => "", // [text]
            // Предназначен для конвертирования метатега в заголовок HTTP.
            "http-equiv" => "", // [content-type, default-style, refresh]
            // Имя метатега, также косвенно устанавливает его предназначение.
            "name" => "", // [application-name, author, description, generator, keywords]
        ],

        // Предназначен для описания скриптов, может содержать ссылку на программу или ее текст на определенном языке.
        "script" => [
            // Specifies that the script is executed asynchronously (only for external scripts)
            "async" => "", // [async]
            // Откладывает выполнение скрипта до тех пор, пока вся страница не будет загружена полностью.
            "defer" => "", // [defer]
            // Определяет тип содержимого тега <script>.
            "type" => "", // [MIME_type]
            // Specifies the character encoding used in an external script file
            "charset" => "", // [character_set]
            // Адрес скрипта из внешнего файла для импорта в текущий документ.
            "src" => "", // [URL]
        ],

        /* // Показывает свое содержимое, если браузер не поддерживает работу со скриптами или их поддержка отключена
     "noscript" => "", */

        /* "command" => "", */
    ];

    public $stylesheet = array();
    public $charset = '	<meta charset="utf-8" />';
    public $h4 = 'Tipsy использует HTML5';

    // Todo: Псосле того как контент будет загружаться из БД, удалять это свойство
    public $content = '
        <p>Tipsy cms находится в начальной стадии разработки. Так как она пишется практически вся на коленках в метро,
        параллельно изучению php, mySQL, html и css, сроки ее завершения совершенно не определены :)</p>
        <p>
        Сайт создан для отлаживания исходников, когда я их пишу, например, в метро, когда другой возможности протестить
        работоспособность нет. А исходя из того, что, в основном, написание происходит в дороге с мобильного девайса,
        сиё творение будет чаще не работать, чем работать. ;)
        </p>Для работы Tipsy CMS требуется php версии не ниже 5.4, html5 и css3';

    /**
     * Конструктор. Используется для инициализации начальных состояний объекта.
     */
    public function __construct()
    {
        // Получаем списокэсообщений об ошибках и регистрируем его в объекте для последующего вывода на страницу html
        $this->errors = TRuntimeException::$errors;

        // Определяем и проверяем шаблон
        $this->getTemplate();
    }

    /**
     * Метод определяющий используемый шаблон
     *
     */
    public function getTemplate()
    {
        $template = _TPATH_TEMPLATES . '/' . TConfig::$template;

        if (file_exists($t = $template . '/' . 'index.php')) {
            require_once $template . '/' . 'index.php';
        } else {
            throw new TRuntimeException('Не найден index.php выбранного шаблона');
        }

        return $this;
    }

    /**
     * Метод вывода системных ошибок на страницу html
     *
     */
    public function getErrors()
    {
        if (!empty($this->errors)) {
            foreach ((array)$this->errors as $msg) {
                echo $msg;
            }
        }
    }


    public function getLeft()
    {
        $nav = [
            '<a href="http://php.net">PHP</a>',
            '<a href="http://w3.org">html5</a>',
            '<a href="https://github.com/WhiskeyMan-Tau/tipsy_cms.git">Исходники</a>',
        ];

        foreach ($nav as $val)
            echo $val;
    }

    public function addStylesheet($name)
    {
        $this->stylesheet[$name] = 'templates/tipsy/css/' . $name;
    }

    /**
     * Метод устанавливающий тег связи с внешним документом(<link>), например файлом со стилями
     * @param    $link
     * @param    $href
     * @param    $hreflang
     * @param
     */
    public function setStylesheet($name)
    {
        if (!empty($this->stylesheet)) {
            foreach ((array)$this->stylesheet as $stylesheet) {
                echo '<link rel = "stylesheet" href=" ' . $stylesheet . ' ">';
            }
        }
    }

    /**
     * Метод формирующий содержимое html контейнера <head>
     *
     */
    public function setHeadData()
    {
        $this->head_data = [
            // Заголовок документа
            // http://www.w3schools.com/html5/tag_title.asp
            "title" => "Домашняя страница Tipsy CMS",

            // Применяется для определения стилей элементов веб-страницы
            // http://www.w3schools.com/html5/tag_style.asp
            "style" => [
                // Определяет устройство вывода, для работы с которым предназначена таблица стилей.
                "media" => "", // [text/css]
                // Сообщает браузеру, какой синтаксис использовать, чтобы правильно интерпретировать стили.
                "type" => "", // [media_query]
                // Specifies that the styles only apply to this element's parent element and that element's child elements (HTML5)
                "scoped" => "", // [scoped]
            ],

            // Инструктирует браузер относительно полного базового адреса текущего документа
            // http://www.w3schools.com/html5/tag_base.asp
            "base" => [
                // Адрес, который должен использоваться для указания полного пути к файлам.
                "href" => "", // [URL]
                // Имя окна или фрейма, куда будет загружаться документ, открываемый по ссылке.
                "target" => "", // [_blank, _parent, _self, _top, framename]
            ],

            // Устанавливает связь с внешним документом вроде файла со стилями или со шрифтами
            // http://www.w3schools.com/html5/tag_link.asp
            "link" => [
                // Путь к связываемому файлу.
                "href" => "", // [URL]
                // Specifies the language of the text in the linked document
                "hreflang" => "", // [language_code]
                // Определяет устройство, для которого следует применять стилевое оформление.
                "media" => "", // [media_query]
                // Определяет отношения между текущим документом и файлом, на который делается ссылка.
                "rel" => "", // [alternate, archives, author, bookmark, external, first, help, icon, last, licence, next, nofollow, noreferrer, pingback, prefetch, prev, search, sidebar, stylesheet, tag, up]
                // Указывает размер иконок для визуального отображения.
                "sizes" => "", // [HeightxWidth, any]
                // MIME-тип данных подключаемого файла.
                "type" => "", // [MIME_type]
            ],

            // Определяет метатеги, которые используются для хранения информации предназначенной для браузеров и поисковых систем.
            // http://www.w3schools.com/html5/tag_meta.asp
            "meta" => [
                // Задает кодировку документа.
                "charset" => "", // [character_set]
                // Устанавливает значение атрибута, заданного с помощью name или http-equiv.
                "content" => "", // [text]
                // Предназначен для конвертирования метатега в заголовок HTTP.
                "http-equiv" => "", // [content-type, default-style, refresh]
                // Имя метатега, также косвенно устанавливает его предназначение.
                "name" => "", // [application-name, author, description, generator, keywords]
            ],

            // Предназначен для описания скриптов, может содержать ссылку на программу или ее текст на определенном языке.
            "script" => [
                // Specifies that the script is executed asynchronously (only for external scripts)
                "async" => "", // [async]
                // Откладывает выполнение скрипта до тех пор, пока вся страница не будет загружена полностью.
                "defer" => "", // [defer]
                // Определяет тип содержимого тега <script>.
                "type" => "", // [MIME_type]
                // Specifies the character encoding used in an external script file
                "charset" => "", // [character_set]
                // Адрес скрипта из внешнего файла для импорта в текущий документ.
                "src" => "", // [URL]
            ],

            /* // Показывает свое содержимое, если браузер не поддерживает работу со скриптами или их поддержка отключена
         "noscript" => "", */

            /* "command" => "", */
        ];

    }
}

?>
