<?
  require_once '../lib/admin.php';
  Admin::init();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <script type="text/javascript">
    function confirmDeletion() {
      return confirm("Totes deletes?");
    }
  </script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>

<body>

<h1>Admin!</h1>
<h2>Vocab</h2>

<ul>
  <li><a href="/jp/admin/add_edit.php">Add a new word or phrase</a></li>

  <? foreach(Admin::get_vocab() as $h) { ?>
    <li><? echo $h['jp']; ?> - <? echo $h['en']; ?> <a href="/jp/admin/add_edit.php?type=vocab&id=<? echo $h['id']; ?>">edit</a> <a href="/jp/admin/delete.php?type=vocab&id=<? echo $h['id']; ?>" onclick="return confirmDeletion()">delete</a></li>
  <? } ?>
</ul>
</body>
