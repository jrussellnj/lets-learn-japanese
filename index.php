<?php

require_once('lib/japanese.php');
Japanese::init();

// Figure out if anything is selected
if (!(isSet($_GET['hiragana']) || isSet($_GET['kanji']) || isSet($_GET['vocab']))) {
	$nothingIsSelected = true;
	$_GET['kanji'] = 1;
	$_GET['vocab'] = 1;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- External Javascript and stylesheet -->
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<link rel="stylesheet" type="text/css" href="style/main.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<title>Let's study Japanese!</title>

</head>
<body>

<div style="text-align: center;">
  <h1>Let's study Japanese!</h1>
  <h4>
    日本語を
    <span class="has-furigana"><span class="kanji">勉<span class="furigana">べん</span></span></span>
    <span class="has-furigana"><span class="kanji">強<span class="furigana">きょう</span></span></span>
    しましょう！
  </h4>

  <form id='fancyform' name='fancyform' method="get" action="index.php">
    <div class="form-group">
      <label class="checkbox-inline">
        <input id="hirigana" type="checkbox" name="hiragana" value="1" <? if (isSet($_GET['hiragana'])) { print 'checked=checked'; } ?> /> Hiragana
      </label>

      <label class="checkbox-inline">
        <input id="kanji" type="checkbox" name="kanji" value="1" <? if (isSet($_GET['kanji']) || $nothingIsSelected) { print 'checked=checked'; } ?> /> Kanji
      </label>

      <label class="checkbox-inline">
        <input id="vocab" type="checkbox" name="vocab" value="1" <? if (isSet($_GET['vocab']) || $nothingIsSelected) { print 'checked=checked'; } ?> /> Vocab
      </label>

      <label class="checkbox-inline">
        <input id="human" type="checkbox" name="from_human_japanese" value="1" <? if (isSet($_GET['from_human_japanese']) || $nothingIsSelected) { print 'checked=checked'; } ?> /> Human Japanese
      </label>
    </div>
    
    <br />
    <input type="submit" name="fucknamingsubmitbuttons" class="btn btn-default" value="Get random thing!">
  </form>
</div>

<?php

$chars = array();

if (isSet($_GET['hiragana'])) {
  $chars = array_merge($chars, Japanese::get_hiragana());
}

if (isSet($_GET['kanji'])) {
  $chars = array_merge($chars, Japanese::get_kanji());
}

if (isSet($_GET['vocab'])) {
  $chars = array_merge($chars, Japanese::get_vocab(isSet($_GET['from_human_japanese'])));
}

?>

<? if (!count($chars)) { ?>

<div style="text-align: center;">Select something!</div>

<?

}
else {

// Get the random array element to show
$randIndex = array_rand($chars);

?>

<div class="japanese-item" style="">
<? 
	//if ($chars[$randIndex]['picture'] != '') {
	if (false) {
		print '<img src="'.$chars[$randIndex]['picture'].'" />';
		$meaning = $chars[$randIndex]['jp'];
	}
	else {
		print $chars[$randIndex]['jp']; 
		$meaning = $chars[$randIndex]['en'];

		if ($chars[$randIndex]['type'] == 'kanji') {
			$extra = $chars[$randIndex]['romaji'];
		}
	}

?>
</div>

<br />

<div style="text-align:center;" class="answer-container">
  <blockquote id="XXXX">
    <p>XXXXXXXX</p>
  </blockquote>

  <blockquote id="meaning">
    <p><? print $meaning; if ($extra) { print " ($extra)"; } ?></p>
  </blockquote>
</div>

<br />

<div style="text-align: center;">
  <h3>
    <span class="has-furigana">今<span class="furigana">きょう</span></span>
    日は
    <span class="has-furigana">何<span class="furigana">なん</span></span>
    <span class="has-furigana">日<span class="furigana">にち</span></span>
    ですか?
  </h3>

  <div class="date">
  <span class="has-furigana">今<span class="furigana">きょう</span></span>日は<? echo date('Y\年 n\月 j\日'); ?>です。
  <? //setlocale(LC_TIME, 'ja_JP.UTF-8'); ?>
  <? //echo strftime('%A'); ?>
  </div>
</div>

<? } ?>

</body>
</html>
