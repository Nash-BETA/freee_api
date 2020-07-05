<?php


App::uses('AppController', 'Controller');

class FreeesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

	public function post() {

	}

	public function bill (){
		$this->autoRender = false;

		$post_date = $this->request->data['id'];

		//DBから販売データの取得
//		$sale_date = $this->sale->find('first', [
//			'condition' => [
//				'id' => $post_date ,
//			]
//		]);

		//ここからfreeeのAPIにPOST
		// 前準備で作っておいた、tokenを設定
		$token = '812f2af60298d73751cc0387846a9986febb8e572fb4dfe28c6b0ed775504ab8';
		$base_url = 'https://api.freee.co.jp';

		$post_data = [
			"issue_date" => "2020-04-01",
			"type" => "income",
			"company_id" => 2527716,
			"due_date" => "2020-05-01",
			"partner_id" => 27441568,
			"ref_number" => "1",
			"details" => [
					[
					"tax_code" => 1,
					"account_item_id" => 404009023,
					"amount" => 1,
					"item_id" => 176975612,
					"description" => "備考",
					"vat" => 800
				]
			]
		];

		//APIリファレンスのcurlに書いてあったヘッダーと同じ内容にする
		$header = [
			// 前準備で取得したtokenをヘッダに含める
			'Authorization: Bearer '.$token,
			// json形式のデータをpostするので必要
			'Content-Type: application/json',
		];


		$context = stream_context_create(array(
			'http' => array(
				'method' => 'POST',
				'header' => implode(PHP_EOL,$header),
				'content'=>  json_encode($post_data),
				'ignore_errors' => true
			)
		));

		$response = file_get_contents(
			$base_url.'/api/1/deals'
			,false
			,$context
		);

		$header = $http_response_header;
		$result = json_decode($response,true);

		echo json_encode($result);
		exit();
	}
}
