<?

class Japanese {
  protected static $mysqli;
 
  private static function dbConnect() {
    // Connect to the database
    self::$mysqli = new mysqli('localhost', $_SERVER['dbReadOnlyUser'], $_SERVER['dbReadOnlyPassword'], $_SERVER['dbDatabaseName']);
    self::$mysqli->set_charset("utf8");
  }

  public static function init() {
    self::dbConnect();
  }

  public static function get_hiragana() {
    $preparedSql = self::$mysqli->prepare('select japanese, english from hiragana');
    $preparedSql->execute();
    $preparedSql->bind_result($japanese, $english);

    while ($row = $preparedSql->fetch()) {
      $chars[] = array('jp' => $japanese, 'en' => $english, 'type' => 'hiragana');
    }

    return $chars;
  }

  public static function get_kanji() {
    $preparedSql = self::$mysqli->prepare('select japanese, english from kanji');
    $preparedSql->execute();
    $preparedSql->bind_result($japanese, $english);

    while ($row = $preparedSql->fetch()) {
      $chars[] = array('jp' => $japanese, 'en' => $english, 'type' => 'kanji');
    }

    return $chars;
  }

  public static function get_vocab($from_human_japanese = null) {
    if ($from_human_japanese == null) {
      $preparedSql = self::$mysqli->prepare('select id, japanese, english from vocab order by japanese');
    }
    else {
      $preparedSql = self::$mysqli->prepare('select id, japanese, english from vocab where from_human_japanese = ? order by japanese');
      $preparedSql->bind_param('i', $from_human_japanese);
    }

    $preparedSql->execute();
    $preparedSql->bind_result($id, $japanese, $english);

    while ($row = $preparedSql->fetch()) {
      $chars[] = array('id' => $id, 'jp' => $japanese, 'en' => $english, 'type' => 'vocab');
    }

    return $chars;
  }
}

?>
