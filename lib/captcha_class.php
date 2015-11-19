<?php
//генерация картинок для кода
class Captcha {

	const WIDTH = 100;//ширина каптчи
	const HEIGHT = 60;//высота каптчи
	const FONT_SIZE = 16;//размер шрифа
	const LET_AMOUNT = 4;//кол-во вводимых символов
	const BG_LET_AMOUNT = 30;//шум для каптчи
	const FONT = "fonts/verdana.ttf";//путь к шрифту
	
	private static $letters = array("a", "b", "c", "d", "e", "f", "g");//буквы выводимые на каптче
	private static $colors = array(90, 110, 130, 150, 170, 190, 210);//массив с цветами для букв
	
	/*-вывод каптчи-*/
	public static function generate() {
		if (!session_id()) session_start();//начинаем сесию
		$src = imagecreatetruecolor(self::WIDTH, self::HEIGHT);//создаем изображение
		$bg = imagecolorallocate($src, 255, 255, 255);//задаем цвет фона
		imagefill($src, 0, 0, $bg);//заливаем каптчу цветом
		
		for ($i = 0; $i < self::BG_LET_AMOUNT; $i++) {//задаем шум на каптче
			$color = imagecolorallocatealpha($src, rand(0, 255), rand(0, 255), rand(0, 255), 100);//генерируем цвет
			$letter = self::$letters[rand(0, count(self::$letters) - 1)];//создаем букву
			$size = rand(self::FONT_SIZE - 2, self::FONT_SIZE + 2);//создаем размер для букв
			imagettftext($src, $size, rand(0, 45), rand(self::WIDTH * 0.1, self::WIDTH * 0.9), rand(self::HEIGHT * 0.1, self::HEIGHT * 0.9), $color, self::FONT, $letter);//выводи шум
		}
		$code = "";
		for ($i = 0; $i < self::LET_AMOUNT; $i++) {//вывод каптчи
			$color = imagecolorallocatealpha($src, self::$colors[rand(0, count(self::$colors) - 1)],
				self::$colors[rand(0, count(self::$colors) - 1)],
				self::$colors[rand(0, count(self::$colors) - 1)], rand(20, 40));//задаем цвет
			$letter = self::$letters[rand(0, count(self::$letters) - 1)];//задаем буквы
			$size = rand(self::FONT_SIZE * 2 - 2, self::FONT_SIZE * 2 + 2);//шрифт
			$x = ($i + 1) * self::FONT_SIZE + rand(1, 5);//по ширине координаты букв последовательно
			$y = ((self::HEIGHT * 2) / 3) + rand(0, 5);//по высоте
			imagettftext($src, $size, rand(0, 15), $x, $y, $color, self::FONT, $letter);//вывод каптчи
			$code .= $letter;//код каптчи передаем для проверки
		}
		$_SESSION["rand_code"] = $code;//код каптчи передаем для проверки в сесию
		header("Content-type: image/gif");//показываем каптчу пользователю
		imagegif($src);
	}
	
	/*-проверка каптчи-*/
	public static function check($code) {
		if (!session_id()) session_start();//стартуем сесию
		return ($code === $_SESSION["rand_code"]);//сравниваем
	}
}

?>