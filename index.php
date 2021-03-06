<?php
	//tsv file path
	$dataDir = './data/';

	//Charset
	$charset = 'utf-8';

	//Version
	$ver = '1.0';

	//language
	$lang = 'ja';

	//description
	$description = '見たままわかる！キーボードショートカットキーのWeb版チートシート「ShortcutMaster for Mac」';

	//Name
	$name = 'ShortcutMaster for Mac';

	//URL
	$url = 'http://webnaut.jp/tools/shortcutmaster/';

	//Attr(Category,Id,Command,Keys,Recommend)
	$attr = array(
		array(
			'label' => 'Category'
		),
		array(
			'label' => 'Id'
		),
		array(
			'label' => 'Command'
		),
		array(
			'label' => 'Keys'
		),
		array(
			'label' => 'Recommend'
		)
	);
?>
<!DOCTYPE html>
<html lang="<?php echo($lang); ?>">
<head>
<meta charset="<?php echo($charset); ?>">
<meta name="viewport" content="width=device-width">
<meta name="description" content="<?php echo($description); ?>／運営：株式会社ビーワークス WEB制作部／紹介元：WEBNAUT">
<meta name="keywords" content="WebNAUT,ウェブノート,Web制作,制作,ビーワークス,beeworks,キーボード,ショートカットキー,ShortcutMaster" />
<meta name="author" content="Beeworks">
<title><?php echo($name); ?></title>
<link rel="shortcut icon" href="resources/img/favicon.png" />
<link href="resources/css/bootstrap.min.css" rel="stylesheet">
<link href="resources/css/style.css" rel="stylesheet">
<link href="resources/css/keyboard.css" rel="stylesheet">
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@WebNAUT_BW">
<meta property="og:title" content="ShortcutMaster for Mac | WebNAUT" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://webnaut.jp/tools/shortcutmaster/" />
<meta property="og:site_name" content="ShortcutMaster for Mac" />
<meta property="og:description" content="<?php echo($description); ?>／運営：株式会社ビーワークス WEB制作部／紹介元：WEBNAUT" />
<meta property="og:image" content="http://webnaut.jp/tools/shortcutmaster/resources/img/og.gif" />
</head>
<body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-N22MPZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N22MPZ');</script>
<!-- End Google Tag Manager -->
<div class="container">

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<span id="logo"><?php echo($name); ?></span>
		</div>
		<div class="collapse navbar-collapse">
			<p id="navbar-copyright" class="navbar-text navbar-right"><a href="http://webnaut.jp/" target="_blank" class="navbar-link">WebNAUT by beeworks</a><br>Copyright (c) Beeworks Co., Ltd All rights reserved</p>
			<ul class="nav navbar-nav navbar-right">
				<li id="navbar-snsArea">
					<div class="snsArea-twitter">
						<a href="https://twitter.com/share" data-text="<?php echo($description); ?>「ShortcutMaster for Mac」 | WebNAUT" class="twitter-share-button">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>
					<div class="snsArea-facebook">
						<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwebnaut.jp%2Ftools%2FShortcutMaster%2F&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
					</div>
					<div class="snsArea-hatena">
						<a href="http://webnaut.jp/tools/ShortcutMaster/" class="hatena-bookmark-button" data-hatena-bookmark-title="<?php echo($description); ?>「ShortcutMaster for Mac」" data-hatena-bookmark-layout="standard-balloon" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
					</div>
					<div class="snsArea-github">
						<a class="github-button" href="https://github.com/WebNAUT-BW/tools-shortcutmaster/archive/master.zip">Download</a>
						<script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>
					</div>
				</li>
			</ul>
			<ul id="navbar-control" class="nav navbar-nav navbar-right">
				<li><a href="#" id="open-infoModal"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a></li>
				<li><a href="#" id="open-settingModal"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
			</ul>
		</div>
	</div>
</div>

<?php
	$files = array();
	$ids = array();
	if ($dh = opendir($dataDir)) {
		while (($file = readdir($dh)) !== false) {
			//.から始まるファイル名でなければ
			if (substr($file,0,1) !== '.') {
				$files[] = $file;
				$ids[] = basename($file,'.tsv');
			}
		}
		closedir($dh);
	}
?>

<ul class="nav nav-tabs" id="navMain">
	<?php
		for($m = 0; $m < count($files); $m++) {
			echo ('<li><a href="#'.$ids[$m].'" data-toggle="tab">'.$ids[$m].'</a></li>');
		}
	?>
</ul>

<!-- Tab panes -->
<div id="contentMain" class="tab-content">

<?php
	for($m = 0; $m < count($files); $m++) {
		$file = fopen($dataDir.$files[$m], 'r');

		echo ('<div class="tab-pane" id="'.$ids[$m].'">');
		echo ('
				<table class="ovTable table table-bordered table-hover tablesorter">
					<colgroup>
						<col class="col-num">
						<col class="col-category">
						<col class="col-command">
						<col class="col-keys">
						<col class="col-recommend">
						<col class="col-favorite">
					</colgroup>
					<thead>
						<tr>
							<th>No.</th>
							<th>Category</th>
							<th>Command</th>
							<th>Keys</th>
							<th class="header-recommend">Recommend</th>
							<th class="header-favorite">Favorite</th>
						</tr>
					</thead>
					<tbody>
			');

		$cnt = 1;
		while($line = fgets($file, 1024)) {
			$data = explode("\t", $line);
			$num = (string) $cnt;
			$colCount = 0;

			//<tr>生成============
			echo ('<tr id="'.$ids[$m].'-'.$data[1].'" class="');
			//<tr>内のクラス：
			$class=explode(',',$data[3]);
			for($l = 0; $l < count($class); $l++) {
				echo ('key-'.$class[$l].' ');
			}

			if ($data[4] == 1) {
				echo ('is-recommend');
			}

			echo ('">');
			//<td>生成============

			//連番のセル出力
			echo ('<td>'.$num.'</td>');
			for($i = 0, $j =0; $i < count($data); $i++, $j++) {

				//Keysの出力
				if($attr[$j]['label'] === 'Keys') {
					echo ('<td>');
					$sample=explode(',',$data[$i]);
					for($k = 0; $k < count($sample); $k++) {

						//ボタンカラーを適用するキー
						if (($sample[$k] === 'esc')||
							($sample[$k] === 'f1')||
							($sample[$k] === 'f2')||
							($sample[$k] === 'f3')||
							($sample[$k] === 'f4')||
							($sample[$k] === 'f5')||
							($sample[$k] === 'f6')||
							($sample[$k] === 'f7')||
							($sample[$k] === 'f8')||
							($sample[$k] === 'f9')||
							($sample[$k] === 'f10')||
							($sample[$k] === 'f11')||
							($sample[$k] === 'f12')||
							($sample[$k] === 'eject')||
							($sample[$k] === 'num1')||
							($sample[$k] === 'num2')||
							($sample[$k] === 'num3')||
							($sample[$k] === 'num4')||
							($sample[$k] === 'num5')||
							($sample[$k] === 'num6')||
							($sample[$k] === 'num7')||
							($sample[$k] === 'apostrophe')||
							($sample[$k] === 'num8')||
							($sample[$k] === 'num9')||
							($sample[$k] === 'num0')||
							($sample[$k] === 'hyphen')||
							($sample[$k] === 'caret')||
							($sample[$k] === 'backslash')||
							($sample[$k] === 'delete')||
							($sample[$k] === 'tab')||
							($sample[$k] === 'q')||
							($sample[$k] === 'w')||
							($sample[$k] === 'e')||
							($sample[$k] === 'r')||
							($sample[$k] === 't')||
							($sample[$k] === 'y')||
							($sample[$k] === 'u')||
							($sample[$k] === 'i')||
							($sample[$k] === 'o')||
							($sample[$k] === 'p')||
							($sample[$k] === 'at')||
							($sample[$k] === 'accent')||
							($sample[$k] === 'bra1')||
							($sample[$k] === 'return')||
							($sample[$k] === 'ctrl')||
							($sample[$k] === 'a')||
							($sample[$k] === 's')||
							($sample[$k] === 'd')||
							($sample[$k] === 'f')||
							($sample[$k] === 'g')||
							($sample[$k] === 'h')||
							($sample[$k] === 'j')||
							($sample[$k] === 'k')||
							($sample[$k] === 'l')||
							($sample[$k] === 'semicolon')||
							($sample[$k] === 'colon')||
							($sample[$k] === 'bra2')||
							($sample[$k] === 'shift')||
							($sample[$k] === 'z')||
							($sample[$k] === 'x')||
							($sample[$k] === 'c')||
							($sample[$k] === 'v')||
							($sample[$k] === 'b')||
							($sample[$k] === 'n')||
							($sample[$k] === 'm')||
							($sample[$k] === 'comma')||
							($sample[$k] === 'period')||
							($sample[$k] === 'slash')||
							($sample[$k] === 'question')||
							($sample[$k] === 'underScore')||
							($sample[$k] === 'alt')||
							($sample[$k] === 'cmd')||
							($sample[$k] === 'eisu')||
							($sample[$k] === 'space')||
							($sample[$k] === 'kana')||
							($sample[$k] === 'caps')||
							($sample[$k] === 'f13')||
							($sample[$k] === 'f14')||
							($sample[$k] === 'f15')||
							($sample[$k] === 'f16')||
							($sample[$k] === 'f17')||
							($sample[$k] === 'f18')||
							($sample[$k] === 'f19')||
							($sample[$k] === 'fn')||
							($sample[$k] === 'home')||
							($sample[$k] === 'pageUp')||
							($sample[$k] === 'del')||
							($sample[$k] === 'end')||
							($sample[$k] === 'pageDown')||
							($sample[$k] === 'curUp')||
							($sample[$k] === 'curRight')||
							($sample[$k] === 'curDown')||
							($sample[$k] === 'curLeft')||
							($sample[$k] === 'clear')||
							($sample[$k] === 'equalTen')||
							($sample[$k] === 'astTen')||
							($sample[$k] === 'plus')||
							($sample[$k] === 'enter')
							){
							$btnColor = true;
						//それ以外はそのまま
						}else {
							$btnColor = false;
						}

						//キー表記と変えるもの
						if (strpos($sample[$k], 'hyphen') !== false){
							$sample[$k] = '-';
						}elseif (strpos($sample[$k], 'caret') !== false){
							$sample[$k] = '^';
						}elseif (strpos($sample[$k], 'backslash') !== false){
							$sample[$k] = '¥';
						}elseif (strpos($sample[$k], 'at') !== false){
							$sample[$k] = '@';
						}elseif (strpos($sample[$k], 'accent') !== false){
							$sample[$k] = '`';
						}elseif (strpos($sample[$k], 'bra1') !== false){
							$sample[$k] = '[';
						}elseif (strpos($sample[$k], 'bra2') !== false){
							$sample[$k] = ']';
						}elseif (strpos($sample[$k], 'semicolon') !== false){
							$sample[$k] = ';';
						}elseif (strpos($sample[$k], 'colon') !== false){
							$sample[$k] = ':';
						}elseif (strpos($sample[$k], 'comma') !== false){
							$sample[$k] = ',';
						}elseif (strpos($sample[$k], 'period') !== false){
							$sample[$k] = '.';
						}elseif (strpos($sample[$k], 'slash') !== false){
							$sample[$k] = '/';
						}elseif (strpos($sample[$k], 'question') !== false){
							$sample[$k] = '?';
						}elseif (strpos($sample[$k], 'underScore') !== false){
							$sample[$k] = '_';
						}elseif (strpos($sample[$k], 'eisu') !== false){
							$sample[$k] = '英数';
						}elseif (strpos($sample[$k], 'kana') !== false){
							$sample[$k] = 'かな';
						}elseif (strpos($sample[$k], 'caps') !== false){
							$sample[$k] = 'caps lock';
						}elseif (strpos($sample[$k], 'curUp') !== false){
							$sample[$k] = '↑';
						}elseif (strpos($sample[$k], 'curRight') !== false){
							$sample[$k] = '→';
						}elseif (strpos($sample[$k], 'curDown') !== false){
							$sample[$k] = '↓';
						}elseif (strpos($sample[$k], 'curLeft') !== false){
							$sample[$k] = '←';
						}elseif (strpos($sample[$k], 'equalTen') !== false){
							$sample[$k] = '=';
						}elseif (strpos($sample[$k], 'astTen') !== false){
							$sample[$k] = '*';
						}elseif (strpos($sample[$k], 'plus') !== false){
							$sample[$k] = '+';
						}elseif (strpos($sample[$k], 'num0') !== false){
							$sample[$k] = '0';
						}elseif (strpos($sample[$k], 'num1') !== false){
							$sample[$k] = '1';
						}elseif (strpos($sample[$k], 'num2') !== false){
							$sample[$k] = '2';
						}elseif (strpos($sample[$k], 'num3') !== false){
							$sample[$k] = '3';
						}elseif (strpos($sample[$k], 'num4') !== false){
							$sample[$k] = '4';
						}elseif (strpos($sample[$k], 'num5') !== false){
							$sample[$k] = '5';
						}elseif (strpos($sample[$k], 'num6') !== false){
							$sample[$k] = '6';
						}elseif (strpos($sample[$k], 'num7') !== false){
							$sample[$k] = '7';
						}elseif (strpos($sample[$k], 'num8') !== false){
							$sample[$k] = '8';
						}elseif (strpos($sample[$k], 'num9') !== false){
							$sample[$k] = '9';
						}elseif (strpos($sample[$k], 'apostrophe') !== false){
							$sample[$k] = '&rsquo;';
						}

						//ボタンカラーを適用するキー
						if ($btnColor == true){
							echo ('<button class="btn btn-default btn-on">'.$sample[$k].'</button>');
						//それ以外はそのまま
						}else {
							echo ('<button class="btn btn-default">'.$sample[$k].'</button>');
						}
					}
					echo ('</td>');
				}

				//Idのセルは出力しない
				elseif ($attr[$j]['label'] === 'Id') {
				}

				//Recommendの場合
				elseif ($attr[$j]['label'] === 'Recommend') {
					//0と1
					if ($data[$i] == 1){
						echo ('<td class="recommend">☆</td>');
					} else if ($data[$i] == 2){
						echo ('<td class="recommend">☆☆</td>');
					} else if ($data[$i] == 3){
						echo ('<td class="recommend">☆☆☆</td>');
					}else {
						echo ('<td></td>');
					}
					// echo ('<td>'.$data[$i].'11</td>');
				}

				//Keys以外の出力
				else {
					echo ('<td>'.$data[$i].'</td>');
				}
			}

			//Favoriteのセル出力
			echo ('<td class="favorite"><label><input type="checkbox"></label></td>');
			echo ('</tr>');
			$cnt++;
		}
		fclose($file);

		echo ('
					</tbody>
				</table>
			</div>
			');

	}
?>
</div>

<div id="keyboard-wrap">
<div id="keyboard-base" class="keyboard-apple-sj-ten">
	<ul>
		<li class="mod-key" id="key-esc"><span class="key-text">esc</span></li>
		<li class="mod-key" id="key-f1"><span class="key-text">F1</span></li>
		<li class="mod-key" id="key-f2"><span class="key-text">F2</span></li>
		<li class="mod-key" id="key-f3"><span class="key-text">F3</span></li>
		<li class="mod-key" id="key-f4"><span class="key-text">F4</span></li>
		<li class="mod-key" id="key-f5"><span class="key-text">F5</span></li>
		<li class="mod-key" id="key-f6"><span class="key-text">F6</span></li>
		<li class="mod-key" id="key-f7"><span class="key-text">F7</span></li>
		<li class="mod-key" id="key-f8"><span class="key-text">F8</span></li>
		<li class="mod-key" id="key-f9"><span class="key-text">F9</span></li>
		<li class="mod-key" id="key-f10"><span class="key-text">F10</span></li>
		<li class="mod-key" id="key-f11"><span class="key-text">F11</span></li>
		<li class="mod-key" id="key-f12"><span class="key-text">F12</span></li>
		<li class="mod-key" id="key-eject"><span class="key-text"><span class="glyphicon glyphicon-eject" aria-hidden="true"></span></span></li>

		<li class="mod-key" id="key-num1"><span class="key-text">1</span></li>
		<li class="mod-key" id="key-num2"><span class="key-text">2</span></li>
		<li class="mod-key" id="key-num3"><span class="key-text">3</span></li>
		<li class="mod-key" id="key-num4"><span class="key-text">4</span></li>
		<li class="mod-key" id="key-num5"><span class="key-text">5</span></li>
		<li class="mod-key" id="key-num6"><span class="key-text">6</span></li>
		<li class="mod-key" id="key-num7"><span class="key-text">7</span></li>
		<li class="mod-key" id="key-num8"><span class="key-text">8</span></li>
		<li class="mod-key" id="key-num9"><span class="key-text">9</span></li>
		<li class="mod-key" id="key-num0"><span class="key-text">0</span></li>
		<li class="mod-key" id="key-hyphen"><span class="key-text">-</span></li>
		<li class="mod-key" id="key-caret"><span class="key-text">^</span></li>
		<li class="mod-key" id="key-backslash"><span class="key-text">¥</span></li>
		<li class="mod-key" id="key-delete"><span class="key-text">delete</span></li>

		<li class="mod-key" id="key-tab"><span class="key-text">tab</span></li>
		<li class="mod-key" id="key-q"><span class="key-text">Q</span></li>
		<li class="mod-key" id="key-w"><span class="key-text">W</span></li>
		<li class="mod-key" id="key-e"><span class="key-text">E</span></li>
		<li class="mod-key" id="key-r"><span class="key-text">R</span></li>
		<li class="mod-key" id="key-t"><span class="key-text">T</span></li>
		<li class="mod-key" id="key-y"><span class="key-text">Y</span></li>
		<li class="mod-key" id="key-u"><span class="key-text">U</span></li>
		<li class="mod-key" id="key-i"><span class="key-text">I</span></li>
		<li class="mod-key" id="key-o"><span class="key-text">O</span></li>
		<li class="mod-key" id="key-p"><span class="key-text">P</span></li>
		<li class="mod-key" id="key-at"><span class="key-text">@</span></li>
		<li class="mod-key" id="key-bra1"><span class="key-text">[</span></li>
		<li class="mod-key" id="key-return"><span class="key-text">return</span></li>

		<li class="mod-key" id="key-ctrl"><span class="key-text">control</span></li>
		<li class="mod-key" id="key-a"><span class="key-text">A</span></li>
		<li class="mod-key" id="key-s"><span class="key-text">S</span></li>
		<li class="mod-key" id="key-d"><span class="key-text">D</span></li>
		<li class="mod-key" id="key-f"><span class="key-text">F</span></li>
		<li class="mod-key" id="key-g"><span class="key-text">G</span></li>
		<li class="mod-key" id="key-h"><span class="key-text">H</span></li>
		<li class="mod-key" id="key-j"><span class="key-text">J</span></li>
		<li class="mod-key" id="key-k"><span class="key-text">K</span></li>
		<li class="mod-key" id="key-l"><span class="key-text">L</span></li>
		<li class="mod-key" id="key-semicolon"><span class="key-text">;</span></li>
		<li class="mod-key" id="key-colon"><span class="key-text">:</span></li>
		<li class="mod-key" id="key-bra2"><span class="key-text">]</span></li>

		<li class="mod-key" id="key-shiftLeft"><span class="key-text">shift</span></li>
		<li class="mod-key" id="key-z"><span class="key-text">Z</span></li>
		<li class="mod-key" id="key-x"><span class="key-text">X</span></li>
		<li class="mod-key" id="key-c"><span class="key-text">C</span></li>
		<li class="mod-key" id="key-v"><span class="key-text">V</span></li>
		<li class="mod-key" id="key-b"><span class="key-text">B</span></li>
		<li class="mod-key" id="key-n"><span class="key-text">N</span></li>
		<li class="mod-key" id="key-m"><span class="key-text">M</span></li>
		<li class="mod-key" id="key-comma"><span class="key-text">,</span></li>
		<li class="mod-key" id="key-period"><span class="key-text">.</span></li>
		<li class="mod-key" id="key-slash"><span class="key-text">/</span></li>
		<li class="mod-key" id="key-underScore"><span class="key-text">_</span></li>
		<li class="mod-key" id="key-shiftRight"><span class="key-text">shift</span></li>

		<li class="mod-key" id="key-altLeft"><span class="key-text">alt/<br>option</span></li>
		<li class="mod-key" id="key-cmdLeft"><span class="key-text">command</span></li>
		<li class="mod-key" id="key-eisu"><span class="key-text">英数</span></li>
		<li class="mod-key" id="key-space"><span class="key-text"></span></li>
		<li class="mod-key" id="key-kana"><span class="key-text">かな</span></li>
		<li class="mod-key" id="key-cmdRight"><span class="key-text">command</span></li>
		<li class="mod-key" id="key-altRight"><span class="key-text">alt/<br>option</span></li>
		<li class="mod-key" id="key-caps"><span class="key-text">caps</span></li>

		<li class="mod-key" id="key-f13"><span class="key-text">F13</span></li>
		<li class="mod-key" id="key-f14"><span class="key-text">F14</span></li>
		<li class="mod-key" id="key-f15"><span class="key-text">F15</span></li>
		<li class="mod-key" id="key-f16"><span class="key-text">F16</span></li>
		<li class="mod-key" id="key-f17"><span class="key-text">F17</span></li>
		<li class="mod-key" id="key-f18"><span class="key-text">F18</span></li>
		<li class="mod-key" id="key-f19"><span class="key-text">F19</span></li>

		<li class="mod-key" id="key-fn"><span class="key-text">fn</span></li>
		<li class="mod-key" id="key-home"><span class="key-text">home</span></li>
		<li class="mod-key" id="key-pageUp"><span class="key-text">page<br>up</span></li>
		<li class="mod-key" id="key-deleteRight"><span class="key-text">delete</span></li>
		<li class="mod-key" id="key-end"><span class="key-text">end</span></li>
		<li class="mod-key" id="key-pageDown"><span class="key-text">page<br>down</span></li>

		<li class="mod-key" id="key-curUp"><span class="key-text">▲</span></li>
		<li class="mod-key" id="key-curRight"><span class="key-text">▶</span></li>
		<li class="mod-key" id="key-curDown"><span class="key-text">▼</span></li>
		<li class="mod-key" id="key-curLeft"><span class="key-text">◀</span></li>

		<li class="mod-key" id="key-clear"><span class="key-text">clear</span></li>
		<li class="mod-key" id="key-equalTen"><span class="key-text">=</span></li>
		<li class="mod-key" id="key-slashTen"><span class="key-text">/</span></li>
		<li class="mod-key" id="key-astTen"><span class="key-text">*</span></li>
		<li class="mod-key" id="key-hyphenTen"><span class="key-text">-</span></li>
		<li class="mod-key" id="key-plusTen"><span class="key-text">+</span></li>
		<li class="mod-key" id="key-enter"><span class="key-text">enter</span></li>
		<li class="mod-key" id="key-num0ten"><span class="key-text">0</span></li>
		<li class="mod-key" id="key-num1ten"><span class="key-text">1</span></li>
		<li class="mod-key" id="key-num2ten"><span class="key-text">2</span></li>
		<li class="mod-key" id="key-num3ten"><span class="key-text">3</span></li>
		<li class="mod-key" id="key-num4ten"><span class="key-text">4</span></li>
		<li class="mod-key" id="key-num5ten"><span class="key-text">5</span></li>
		<li class="mod-key" id="key-num6ten"><span class="key-text">6</span></li>
		<li class="mod-key" id="key-num7ten"><span class="key-text">7</span></li>
		<li class="mod-key" id="key-num8ten"><span class="key-text">8</span></li>
		<li class="mod-key" id="key-num9ten"><span class="key-text">9</span></li>
		<li class="mod-key" id="key-commaTen"><span class="key-text">,</span></li>
		<li class="mod-key" id="key-periodTen"><span class="key-text">.</span></li>

		<li class="mod-key" id="key-tilde"><span class="key-text">~ / `</span></li>
		<li class="mod-key" id="key-hyphenUs"><span class="key-text">- / _</span></li>
		<li class="mod-key" id="key-plusUs"><span class="key-text">+ / =</span></li>
		<li class="mod-key" id="key-colonUs"><span class="key-text">: / ;</span></li>
		<li class="mod-key" id="key-quotation"><span class="key-text">" / '</span></li>
		<li class="mod-key" id="key-ctrlRight"><span class="key-text">control</span></li>
	</ul>
</div>
<!-- /#keyboard-wrap --></div>

<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">このサイトについて</h4>
		</div>
		<div class="modal-body">
			<p>キーボードショートカットキーのWeb版チートシート。<br>
			字面だけでは覚えにくいショートカットキーの配置を「見たまま」覚えられる学習用ツールです。<br>
			これであなたもショートカットマスター！
			</p>
			<h3>特長</h3>
			<ul>
				<li>各項目にマウスを置くと該当するキーが青くハイライト</li>
				<li>3種類のデザインのキーボード（Appleテンキー有／無、Macbook）に切り替え可能</li>
				<li>重点的に身につけたい項目をお気に入り（Favorite）に登録機能</li>
				<li>おすすめ（Recommend）に重要な項目を設定</li>
				<li>各列の先頭タイトル部分をクリックして項目を並べ替え</li>
				<li>ブラウザ（local strage）にお気に入りや設定を保存</li>
				<li>tsvファイル（タブ区切りテキスト）でデータを管理</li>
			</ul>
			<h3>仕組み</h3>
			各アプリケーションのリストはそれぞれtsv（タブ区切りテキスト）ファイルで管理していて、
			本サイトのphpによってリストのファイルの読み込んで表示しています。<br>
			また、[各タブの選択状態]や[お気に入り情報]、[ソート状態]はブラウザに保存（Local Storage）していますので、
			同じブラウザからでしたら再度表示しても状態は保存されます。
			<h3>対象ブラウザ</h3>
			<p>Google Chrome 最新版</p>
			<h3>紹介記事</h3>
			<p><a href="http://webnaut.jp/markup/1138.html">WebNAUT</a></p>
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="settingModal" tabindex="-1" role="dialog" aria-labelledby="settingModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">設定</h4>
		</div>
		<div class="modal-body">
			<h3>キーボードタイプ</h3>
			<ul class="list-unstyled">
				<li>
					<a href="#">
						<label>
							<input type="radio" name="keyboardType" id="optionsRadios1" value="keyboard-apple-sj-ten" checked>
							Apple with ten key(Shift-JIS)
						</label>
					</a>
				</li>
				<li>
					<a href="#">
						<label>
							<input type="radio" name="keyboardType" id="optionsRadios2" value="keyboard-apple-sj">
							Apple without ten key(Shift-JIS)
						</label>
					</a>
				</li>
				<li>
					<a href="#">
						<label>
							<input type="radio" name="keyboardType" id="optionsRadios3" value="keyboard-macbook-sj">
							Macbook(Shift-JIS)
						</label>
					</a>
				</li>
				<li>
					<a href="#">
						<label>
							<input type="radio" name="keyboardType" id="optionsRadios3" value="keyboard-none">
							None
						</label>
					</a>
				</li>
			</ul>
			<h3>お気に入りデータの削除</h3>
			<button type="button" class="btn btn-danger" id="delete-favorite">削除</button>
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="resources/js/jquery-1.11.0.min.js"></script>
<script src="resources/js/bootstrap.min.js"></script>
<script src="resources/js/jquery.tablesorter.min.js"></script>
<script src="resources/js/util.js"></script>
</body>
</html>