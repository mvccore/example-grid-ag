<?php

namespace App\Controllers;

class Index extends Base {

	/**
	 * Render homepage.
	 * @return void
	 */
	public function IndexAction () {
		$this->view->heading = $this->view->title = 'AgGrid Demos';
		
		$clientsGrid = \App\Controllers\Client::GetGrid($this);
		$clientsGrid->Init();
		$this->view->link2ClientGrid = $clientsGrid->Url(NULL, [
			'grid' => [
				'sort'		=> ['client_name' => 'asc'],
				'filter'	=> ['id_client' => ['>' => [5]]],
				'count'		=> 0,
			]
		]);
	}

	/**
	 * Render not found action.
	 * @return void
	 */
	public function NotFoundAction () {
		$this->controllerName = 'index';
		$this->ErrorAction();
	}

	/**
	 * Render possible server error action.
	 * @return void
	 */
	public function ErrorAction () {
		$code = $this->response->GetCode();
		if ($code === 200) $code = 404;
		$this->view->title = "Error {$code}";
		$this->view->message = $this->request->GetParam('message', FALSE);
		$this->Render('error');
	}
}
