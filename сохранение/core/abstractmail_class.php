<?php
//класс для отправки писем на почтовые сервисы
abstract class AbstractMail {
	
	private $view;//шаблонизатор отвечающий за тпл файл
	private $from;//эл адрес с котрого идет отправка
	private $from_name = "";//имя отправителя
	private $type= "text/html";//тип письма
	private $encoding = "utf-8";//кодировка письма
	
	public function __construct($view, $from) {
		$this->view = $view;
		$this->from = $from;
	}
	
	public function setFrom($from) {
		$this->from = $from;
	}
	
	public function setFromName($from_name) {
		$this->from_name = $from_name;
	}
	
	public function setType($type) {
		$this->type = $type;
	}
	
	public function setEncoding($encoding) {
		$this->encoding = $encoding;
	}
	
	/*-метод отправки письма-*/
	/*-$to- кому отправляется, $data- массив данных для шаблона, $template-название шаблона tpl файла*/
	public function send($to, $data, $template) {
		$from = "=?utf-8?B?".base64_encode($this->from_name)."?="." <".$this->from.">";//перекодировка (дабы избежать проблемы с кодировкой в принимающих почтовых клиентах)
		$headers = "From: ".$from."\r\nReply-To: ".$from."\r\nContent-type: ".$this->type."; charset=\"".$this->encoding."\"\r\n";//заголовки - делаем переход на новую строку
		$text = $this->view->render($template, $data, true);//текст письма получаем и возвращаем
		$lines = preg_split("/\\r\\n?|\\n/", $text);//парсим текст - 1-я строка тема, остальное текст письма
		$subject = $lines[0];
		$subject = "=?utf-8?B?".base64_encode($subject)."?=";//перекодировка как в from
		$body = "";
		for ($i = 1; $i < count($lines); $i++) {
			$body .= $lines[$i];
			if ($i != count($lines) - 1) $body .= "\n";
		}
		if ($this->type = "text/html") $body = nl2br($body);
		return mail($to, $subject, $body, $headers);
	}
	
}

?>