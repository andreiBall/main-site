<?php
//объект отвечающий за коментарии
class CommentDB extends ObjectDB {
	
	protected static $table = "comments";//название таблицы в базе данных
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("article_id", "ValidateID");//Id статьи
		$this->add("user_id", "ValidateID");//id пользователя
		$this->add("parent_id", "ValidateID");//id
		$this->add("text", "ValidateSmallText");//текст 
		$this->add("date", "ValidateDate", self::TYPE_TIMESTAMP, $this->getDate());//дата
	}
	
	/*-обработка события после инициализации-*/
	protected function postInit() {
		$this->link = URL::get("article", "", array("id" => $this->article_id), false, Config::ADDRESS);//ссылка на статью  
		$this->link = URL::addID($this->link, "comment_".$this->id);//ссылка на коментарий
		return true;
	}
	
	/*-получить все коментарии внутри определенной статьи-*/
	public static function getAllOnArticleID($article_id) {
		$select = new Select(self::$db);
		$select->from(self::$table, "*")//создаем селект указываем что достаем все поля
			->where("`article_id` = ".self::$db->getSQ(), array($article_id))
			->order("date");//сортировка по дате 
		$comments = ObjectDB::buildMultiple(__CLASS__, self::$db->select($select));
		$comments = ObjectDB::addSubObject($comments, "UserDB", "user", "user_id");//добавление к коментариям данных пользователя
		return $comments;
	}
	
	/*-вывод количества коментариев-*/
	public static function getCountOnArticleID($article_id) {
		$select = new Select(self::$db);
		$select->from(self::$table, array("COUNT(id)"))
			->where("`article_id` = ".self::$db->getSQ(), array($article_id));
		return self::$db->selectCell($select);
	}
	
	public function accessEdit($auth_user, $field) {
		if ($field == "text") {
			return $this->user_id == $auth_user->id;
		}
		return false;
	}
	
	public function accessDelete($auth_user) {
		return $this->user_id == $auth_user->id;
	}
	
	private static function getAllOnParentID($parent_id) {
		return self::getAllOnField(self::$table, __CLASS__, "parent_id", $parent_id);
	}
	
	protected function preDelete() {
		$comments = CommentDB::getAllOnParentID($this->id);
		foreach ($comments as $comment) {
			try {
				$comment->delete();
			} catch (Exception $e) {
				return false;
			}
		}
		return true;
	}

}

?>