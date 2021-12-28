<html>
 <head>
  <title>Lab 7</title>
 </head>
 <body>
 <?php
    echo "<hr/>";
    echo "1) С помощью рекурсии организуйте функцию возведения числа в степень. Формат: function power(\$val, \$pow), где \$val – заданное число, \$pow – степень.";
    function power($val, $pow)
	{
		if ($val == 0)
		    return 0;
	    elseif ($pow == 0)
		    return 1;
	    elseif ($pow < 0)
            return power(1/$val, -$pow);
		else
            return $val *  power($val, $pow-1);
	}
	echo "<br/><br/>3^-2 = ", power(3, -2);
    echo "<br/>5^3 = ";
    echo power(5, 3);

    date_default_timezone_set('Europe/Moscow');
    function myTime() {
        $hour = date('G');
        $minute = date('i');
        $resulth = ($hour <= 10) ? $hour % 10 : $hour % 20;
        switch ($resulth) {
            case 1:
                echo "$hour час";
                break;
            case 2:
            case 3:
            case 4:
                echo "$hour часа";
                break;
            default:
                echo "$hour часов";
                break;
        }
        $resultm = ($minute <= 10) ? $minute % 10 : $minute % 20;
        switch ($resultm) {
            case 1:
                return " $minute минута";
            case 2:
            case 3:
            case 4:
                return " $minute минуты";
            default:
                return " $minute минут";
        }
    }
    echo "<hr/>";
    echo "2) Напишите функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например: 22 часа 15 минут 21 час 43 минуты.<br/><br/>";
    echo myTime();


    echo "<hr/>";
    echo "3) С помощью цикла while выведите все числа в промежутке от 0 до 100, которые делятся на 3 без остатка.<br/><br/>";
    $number = 1;
    while ($number < 100) {
        if ($number % 3 == 0) {
            echo $number++ . ' | ';
        }
        $number++;
    }


    echo "<hr/>";
    echo "4) С помощью цикла do…while напишите функцию для вывода чисел от 0 до 10,
        чтобы результат выглядел так: 0 – это ноль 1 – нечетное число 2 – четное число 3 – нечетное число … 10 – четное число.<br/><br/>";
    $num = 0;
    do {
        if ($num == 0) {
            echo $num . ' – это ноль.' . '<br>';
            $num++;
        } elseif ($num % 2 != 0) {
            echo $num . ' – нечетное число.' . '<br>';
            $num++;
        } else {
            echo $num . ' – четное число.' . '<br>';
            $num++;
        }
    } while ($num < 11);


    echo "<hr/>";
    echo "5) Выведите с помощью цикла for числа от 0 до 9, НЕ используя тело цикла. То есть выглядеть должно вот так: for(…){// здесь пусто}.<br/><br/>";
    for ($i = 0; $i < 10; print $i++ . ' ') { };


    echo "<hr/>";
    echo "6) Объявите массив, где в качестве ключей будут использоваться названия областей,
        а в качестве значений – массивы с названиями городов из соответствующей области.
        Выведите в цикле значения массива, чтобы результат был таким:
        Московская область: Москва, Зеленоград, Клин Ленинградская область: Санкт-Петербург, Всеволожск, Павловск, Кронштадт Рязанская область …
        (названия городов можно найти на maps.yandex.ru).<br/><br/>";
    $areaArr = [
        'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
        'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
        'Волгоградская область' => ['Волгоград', 'Волжский', 'Камышин', 'Урюпинск', 'Иловля']
    ];
    function displayCity($arr)
    {
        foreach($arr as $key => $value){
            echo $key . ': ' . join(', ',$value) . '<br/>';
        }
    }
    displayCity($areaArr);


    echo "<hr/>";
    echo "7) Повторите предыдущее задание, но выводите на экран только города, начинающиеся с буквы «К».<br/><br/>";
    function searchCity($arr)
    {
        function checkForKStart($val){
            if(mb_substr($val,0,1,'utf-8') == 'К') return $val;
        }
        foreach($arr as $key => $value){
            echo $key . ': ' . join(', ',array_filter($value,'checkForKStart')) . '<br/>';
        }
    }
    searchCity($areaArr);


    echo "<hr/>";
    echo "8) Объявите массив, индексами которого являются буквы русского языка, а значениями – соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’). Напишите функцию транслитерации строк.<br/><br/>";
    function translit($string)
    {
        $letters = [
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '\'',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

            'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
            'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
            'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
            'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
            'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
            'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
            'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
        ];
        
        $value = strtr($string, $letters);
	    return $value;
    }
    echo translit('Объявить массив, индексами которого являются буквы русского языка, а значениями – соответствующие латинские буквосочетания');


    echo "<hr/>";
    echo "9)Напишите функцию, которая получает строку на русском языке, производит транслитерацию и замену пробелов на подчеркивания.<br/><br/>";
    function translitReplaceSpaces($string)
    {
        $letters = [
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '\'',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

            'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
            'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
            'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
            'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
            'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
            'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
            'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',   ' ' => '_',
        ];

        $value = strtr($string, $letters);
        return $value;
    }
    echo translitReplaceSpaces('Объединить две ранее написанные функции в одну');
 ?>


    <hr/>
    <?php echo "10)Создайте калькулятор, который будет определять тип выбранной пользователем операции, ориентируясь на нажатую кнопку операции.
        Данные, введённые пользователем в поля, должны сохраняться и выводиться вместе с результатом вычисления.<br/><br/>";?>
    <form action="" method="post">
		<input type="text" name="a" value="<?php print (isset($_POST['a']) ? $arg1 = $_POST['a'] : ''); ?>">
		<input type="text" name="b" value="<?php print (isset($_POST['b']) ? $arg2 = $_POST['b'] : ''); ?>"> 
		<?php
            if (isset($_POST['+'])) {
                $res = $arg1 + $arg2;
                echo "<b>= $res</b>";
            } elseif (isset($_POST['-'])) {
                    $res = $arg1 - $arg2;
                    echo "<b>= $res</b>";
            } elseif (isset($_POST['*'])) {
                    $res = $arg1 * $arg2;
                    echo "<b>= $res</b>";
            } elseif (isset($_POST['/'])) {
                    $res = $arg1 / $arg2;
                    echo "<b>= $res</b>";
            };
		?>
		<br>
		<input type="submit" value="+" name="+">
		<input type="submit" value="-" name="-">
		<input type="submit" value="*" name="*">
		<input type="submit" value="/" name="/">
	</form>

    <hr/>
    <?php echo "11)Создать форму для загрузки файлов на сервер. Загрузить файл на сервер. Вывести имя загруженного файла.<br/><br/>";?>
    <form method="post" enctype="multipart/form-data">
    Выберите файл: <input type="file" name="filename" size="10" /><br /><br />
    <input type="submit" value="Загрузить" />
    <?php
        if ($_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK)
        {
            $name = $_FILES["filename"]["name"];
            move_uploaded_file($_FILES["filename"]["tmp_name"], $name);
            echo "Файл ", $name, " загружен";
        }
    ?>
    </form>
 </body>
</html>