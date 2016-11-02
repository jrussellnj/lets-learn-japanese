<?
  require_once '../lib/admin.php';
  Admin::init_admin();

  if (Admin::save_vocab($_POST)) {
    header('location: /jp/admin');
  }
  else {
    echo "ERROR SAVING!";
  }
?>
