/* ===============================================
# 行をマウスオーバー時にスタイルを当てる
=============================================== */
$(function () {
	$('.ovTable tbody tr').on('mouseover' ,function(e) {
		/* Act on the event */
		//console.log('hover');
		var _this = $(this);
		var _tableClass = $(this).attr('class');
		$('#keyboard-wrap').attr('class','');
		$('#keyboard-wrap').addClass(_tableClass);
		//console.log(_getClass);
		e.preventDefault();
	});
	$('.ovTable tbody tr').on('mouseout' ,function(e) {
		$('#keyboard-wrap').attr('class','');
		e.preventDefault();
	});
});

/* ===============================================
# キーボード選択状態の制御
=============================================== */
//キーボード選択時に選択状態を記録
$(function () {
	$('input[name="keyboardType"]:radio').change( function() {
		var _val = $(this).val();
		var _keyboardBase = $('#keyboard-base');
		_keyboardBase.attr('class','');
		_keyboardBase.addClass(_val);
		window.localStorage.setItem("UKC-keyboardType",_val);
	});
});

//ページロード時にキーボード選択状態を呼び出し設定する
$(document).ready(function() {
	var _data = window.localStorage.getItem("UKC-keyboardType");
	var _input = $('input[name="keyboardType"]');
	if (!_data == "") {
		$("input[value='" + _data  + "']:radio").attr('checked', 'checked');
		var _keyboardBase = $('#keyboard-base');
		_keyboardBase.attr('class','');
		_keyboardBase.addClass(_data);
		return;
	}
});

/* ===============================================
# お気に入り（Favorite）選択状態の制御
=============================================== */
//お気に入り選択時に選択状態を記録
var addItem = "<span class='icon'>★</span>"
$(function () {
	$('input:checkbox').change( function() {
		var _val = $(this).is(':checked');
		var _id = $(this).parents('tr').attr('id');
		// console.log('_val=' + _val);
		// console.log('_id=' + _id);
		window.localStorage.setItem('UKC-'+_id,_val);
		if (_val == true){
			$(this).parents('td.favorite label').append(addItem);
		} else {
			$(this).parents('td.favorite').find('span.icon').remove();
		}
	});
});

//ページロード時にお気に入り選択状態を呼び出し設定する
$(document).ready(function() {
	teblesorterInit ();
});

/* ===============================================
# タブ選択状態の制御
=============================================== */
//タブ切り替え時に選択状態を記録
$(function () {
	$( '#navMain li a' ).click( function() {
		var _val = $(this).html();
		var _eq = $(this).parents('li').index();
		window.localStorage.setItem('UKC-tabSelect',_val);
	});
});

//ページロード時にタブ選択状態を呼び出し設定する
$(document).ready(function() {
	var _getItem = window.localStorage.getItem('UKC-tabSelect');
	//getItemなし
	if (_getItem == null) {
		$('#navMain li:first-child').addClass('active');
		$('#contentMain .tab-pane:first-child').addClass('active');
	//getItemあり
	} else {
		$('#navMain li a:contains(' + _getItem +')').parents('li').addClass('active');
		$('#contentMain #' + _getItem).addClass('active');
	}
});

/* ===============================================
# ソート状態の記録
=============================================== */
$(function () {
	$('th.tablesorter-header').click(function(e) {
		//ソートしたセルを記録
		var _dataColumn = $(this).attr('data-column');
		window.localStorage.setItem("UKC-sortOrder",_dataColumn);
		if (_dataColumn == 5) {
			//Favoriteの場合設定をリセットして再度ソートさせる
			teblesorterOn();
		}

		//クラスを見て降順か昇順かの状態を取得して記録
		var _this = $(this);
		sortTable
			//ソート完了後の処理
			.bind("sortEnd",function(e, table) {
				if (_this.hasClass('tablesorter-headerDesc')) {
					window.localStorage.setItem("UKC-sortOrderSc",1);
				} else if (_this.hasClass('tablesorter-headerAsc')) {
					window.localStorage.setItem("UKC-sortOrderSc",0);
				} else {
					window.localStorage.setItem("UKC-sortOrderSc","");
				}
		});
		e.preventDefault();
	});
});

/* ===============================================
# tablesorter 初期設定
=============================================== */
var sortTable;
function teblesorterInit () {
	$('td.favorite').each(function(indx) {
		var _id = $(this).parents('tr').attr('id');
		var _getItem = window.localStorage.getItem('UKC-'+_id);
		if (_getItem == 'true'){
			$(this).find('input:checkbox').attr("checked", true);
			$(this).find('label').append(addItem);
		}
	});

	//localStorage読み込み：ソート設定
	var _getItem = window.localStorage.getItem('UKC-sortOrder');
	var _getItemSc = window.localStorage.getItem('UKC-sortOrderSc');
	var _sortListSetting = [[_getItem,_getItemSc]];
	sortTable = $("#contentMain table").tablesorter({
		sortList: _sortListSetting,
		//4（Reccomend）と5（Favorite）は降順しかさせないようにする
		headers : {
			4 : { lockedOrder: 'desc' },
			5 : { lockedOrder: 'desc' }
		}
	});
}

/* ===============================================
# tablesorter 再設定（お気に入りソート用）
=============================================== */
function teblesorterOn () {
	sortTable.trigger("sortReset");
	sortTable.trigger("update")
	sortTable.trigger("sorton", [[[5, 1]]]);
}