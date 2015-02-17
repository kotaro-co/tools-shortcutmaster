<?php
require_once('ini.php');
?>
<!DOCTYPE html>
<html lang="<?php echo($lang); ?>">
<head>
<meta charset="<?php echo($charset); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo($name); ?>[ver.<?php echo($ver); ?>]</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="apple-touch-icon.png">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link href="resources/css/style.css" rel="stylesheet" media="screen">
<link href="resources/css/keyboard.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="container">

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><?php echo($name); ?>[ver.<?php echo($ver); ?>]<!--  (Ultimate Keyboard Cheat-sheet) --></a>
		</div>


		<div class="collapse navbar-collapse">

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Keyboard Type <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="#"><label>
								<input type="radio" name="keyboardType" id="optionsRadios1" value="keyboard-apple-sj-ten" checked>
								Apple with ten key(Shift-JIS)
								</label></a>
						</li>
						<li>
							<a href="#"><label>
									<input type="radio" name="keyboardType" id="optionsRadios2" value="keyboard-apple-sj">
									Apple without ten key(Shift-JIS)
								</label></a>
						</li>
						<li>
							<a href="#"><label>
									<input type="radio" name="keyboardType" id="optionsRadios3" value="keyboard-macbook-sj">
									Macbook(Shift-JIS)
								</label></a>
						</li>
						<!-- <li>
							<a href="#"><label>
								<input type="radio" name="keyboardType" id="optionsRadios4" value="keyboard-apple-us-ten">
								Apple with ten key(US)
								</label></a>
						</li>
						<li>
							<a href="#"><label>
									<input type="radio" name="keyboardType" id="optionsRadios5" value="keyboard-apple-us">
									Apple without ten key(US)
								</label></a>
						</li>
						<li>
							<a href="#"><label>
									<input type="radio" name="keyboardType" id="optionsRadios6" value="keyboard-macbook-us">
									Macbook(US)
								</label></a>
						</li> -->
						<li>
							<a href="#"><label>
									<input type="radio" name="keyboardType" id="optionsRadios7" value="keyboard-none">
									None
								</label></a>
						</li>
					</ul>
				</li>
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

	for($m = 0; $m < count($files); $m++) {
		// echo ('<p class="btn btn-default">'.$files[$m].'</p>');
		// echo ('<p class="btn btn-default">'.$ids[$m].'</p>');
	}

?> 







<ul class="nav nav-tabs" id="navMain">
	<?php
		for($m = 0; $m < count($files); $m++) {
			echo ('<li><a href="#'.$ids[$m].'" data-toggle="tab">'.$ids[$m].'</a></li>');
		}
	?> 
</ul>


<table>




</table>
<!-- Tab panes -->
<div id="contentMain" class="tab-content">

<?php
	for($m = 0; $m < count($files); $m++) {
		$file = fopen($dataDir.$files[$m], 'r');

		echo ('<div class="tab-pane" id="'.$ids[$m].'">');
		echo ('<h2 class="tab-h">'.$ids[$m].'</h2>');
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

						//キー表記と変えるもの
						if (strpos($sample[$k], 'hyphen') !== false){
							$sample[$k] = '-';
						}elseif (strpos($sample[$k], 'caret') !== false){
							$sample[$k] = '^';
						}elseif (strpos($sample[$k], 'backslash') !== false){
							$sample[$k] = '¥';
						}elseif (strpos($sample[$k], 'at') !== false){
							$sample[$k] = '@';
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
						}

						//AndとOr
						if (strpos($sample[$k], 'and') !== false){
							echo ('<button class="btn btn-default btn-and">→</button>');
						}elseif (strpos($sample[$k], 'or') !== false){
							echo ('<button class="btn btn-default btn-or">or</button>');

						//それ以外はキー表記そのまま
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


<!-- 

<div id="footer">
	<div class="container">
	</div>
</div>
 -->


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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="resources/js/jquery.tablesorter.min.js"></script>
<script src="resources/js/util.js"></script>
</body>
</html>