<?
  require_once '../lib/admin.php';
  Admin::init_admin();

  if (Admin::delete_vocab($_GET['id'])) {
    header('location: /jp/admin');
  }
  else {
    echo "ERROR DELETING!";
  }
?>
