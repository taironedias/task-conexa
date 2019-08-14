<?php

class CategoriaTest extends WebTestCase
{
	public $fixtures=array(
		'categorias'=>'Categoria',
	);

	public function testShow()
	{
		$this->open('?r=categoria/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=categoria/create');
	}

	public function testUpdate()
	{
		$this->open('?r=categoria/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=categoria/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=categoria/index');
	}

	public function testAdmin()
	{
		$this->open('?r=categoria/admin');
	}
}
