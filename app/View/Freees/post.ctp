<?php
/**
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */


App::uses('Debugger', 'Utility');
?>


<!-- sale_idには請求する内容が入ったsaleテーブルのIDが入っていたとします。 -->
<button id="bill_post" value="1">請求書発行</button>


<?php $this->Html->scriptStart(array('inline' => false)); ?>
	$(function() {
		$(document).on('click', '#bill_post',function() {
			var sale_id = $(this).val();
			$.ajax({
				type: 'post',
				//送信先はcakephpのhtmlヘルパーを使用
				url: '<?= $this->Html->url(['controller' => 'Freees', 'action' => 'bill']) ?>',
				dataType: 'JSON',
				//送信する内容はsaleテーブルのIDのみ
				data: {
					id: sale_id
				},
			//記事用なのでエラーメッセージは省略
			// 送信ができた時
			}).done(function(data) {
				window.alert('送信しました。');
			// 送信ができなかった時
			}).fail(function() {
				window.alert('送信できませんでした。');
			});
		});
	});
<?php $this->Html->scriptEnd(); ?>
