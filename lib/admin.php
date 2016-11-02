<?

require_once 'japanese.php';

class Admin extends Japanese {

  private static $mysqli;
 
  private static function dbConnect() {
    // Connect to the database
    self::$mysqli = new mysqli('localhost', $_SERVER['dbReadWriteUser'], $_SERVER['dbReadWritePassword'], $_SERVER['dbDatabaseName']);
    self::$mysqli->set_charset("utf8");
  }

  public static function get_vocab_item($id = null) {
    $preparedSql = self::$mysqli->prepare('select id, japanese, english from vocab where id = ?');
    $preparedSql->bind_param('i', $id);
    $preparedSql->execute();
    $preparedSql->bind_result($id, $japanese, $english);

    while ($row = $preparedSql->fetch()) {
      $vocab[] = array('id' => $id, 'jp' => $japanese, 'en' => $english);
    }

    return $vocab;
  }

  public static function save_vocab($item) {
    $human_japanese = $item['from_human_japanese'] == 'true' ? true : false;

    if ($item['id']) {
      $sql = "update vocab set english = '" . $item['english'] . "', japanese = '" . $item['japanese'] . "', from_human_japanese = '" . $human_japanese ."' where id = '" . $item['id'] . "'";
    }
    else {
      $sql = "insert into vocab set english = '" . $item['english'] . "', japanese = '" . $item['japanese'] . "', from_human_japanese = '" . $human_japanese ."'";
    }

    return mysql_query($sql) or die(mysql_error());
  }

  public static function delete_vocab($id) {
    $sql = "delete from vocab where id = '". $id ."'";
    return mysql_query($sql) or die(mysql_error());
  }
}

?>
