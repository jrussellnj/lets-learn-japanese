<?

require_once 'japanese.php';

class Admin extends Japanese {

  private static function dbConnect() {
    // Connect to the database
    self::$mysqli = new mysqli('localhost', $_SERVER['dbReadWriteUser'], $_SERVER['dbReadWritePassword'], $_SERVER['dbDatabaseName']);
    self::$mysqli->set_charset("utf8");
  }

  public static function init() {
    self::dbConnect();
  }

  public static function get_vocab_item($id = null) {
    $preparedSql = self::$mysqli->prepare('select id, japanese, english, from_human_japanese from vocab where id = ?');
    $preparedSql->bind_param('i', $id);
    $preparedSql->execute();
    $preparedSql->bind_result($id, $japanese, $english, $from_human_japanese);

    while ($row = $preparedSql->fetch()) {
      $vocab[] = array('id' => $id, 'japanese' => $japanese, 'english' => $english, 'from_human_japanese' => $from_human_japanese);
    }

    return $vocab;
  }

  public static function save_vocab($item) {
    $human_japanese = isSet($item['from_human_japanese']) ? true : false;

    if ($item['id']) {
      $preparedSql = self::$mysqli->prepare('update vocab set english = ?, japanese = ?, from_human_japanese = ? where id = ?');
      $preparedSql->bind_param('ssii', $item['english'], $item['japanese'], $human_japanese, $item['id']);
    }
    else {
      $preparedSql = self::$mysqli->prepare('insert into vocab set english = ?, japanese = ?, from_human_japanese = ?');
      $preparedSql->bind_param('ssi', $item['english'], $item['japanese'], $human_japanese);
    }

    return $preparedSql->execute();
  }

  public static function delete_vocab($id) {
    $sql = "delete from vocab where id = '". $id ."'";
    return mysql_query($sql) or die(mysql_error());
  }
}

?>
