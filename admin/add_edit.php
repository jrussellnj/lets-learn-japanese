<html>
<head>
  <meta charset="UTF-8"> 
</head>
<body>
<?
  require_once '../lib/admin.php';
  Admin::init();

  if ($_GET['id']) {
    $item = Admin::get_vocab_item($_GET['id']);
  }
?>

<h1>Edit!</h1>

<form method="post" action="add_edit_process.php">
  Japanese: <input type="text" name="japanese" value="<? echo $item[0]['japanese']; ?>" /><br />
  English: <input type="text" name="english" value="<? echo $item[0]['english']; ?>" /><br />
  <input type="checkbox" name="from_human_japanese" id="human_japanese" <? echo $item[0]['from_human_japanese'] == true ? 'checked="checked"' : '' ?> value="true" /> <label for="human_japanese">Is from Human Japanese</label><br />

  <input type="hidden" name="id" value="<? echo $item[0]['id']; ?>" />
  <input type="submit" />
</form>
</body>
</html>
