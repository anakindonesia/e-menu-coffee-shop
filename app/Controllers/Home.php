<?php namespace App\Controllers;

class Home extends BaseController
{
	protected $parser;
	public function __construct()
	{
		$this->parser = \Config\Services::parser();
	}
	public function index()
	{
		
		$data = [
			'title' => 'title ni lo',
			'bos' => 'Ashiap kapten'
		];

		echo $this->parser->setData($data)
			->render('blog');
	}

}
