<?php

namespace User;

class Controller_Company extends \Controller_Front
{

	public function action_search()
	{

		$companies = \Arr::assoc_to_keyval(Model_Company::query()->where('name', 'LIKE', '%'.\Input::get('query').'%')->get(), 'id', 'name');

		foreach ($companies as $id => $company) {
			$suggestions[] = $company;
			$datas[]       = $id;
		}

		$res = array(
			'query'       => \Input::get('query'),
			'suggestions' => $suggestions,
			'data'        => $datas
		);

		$this->data['data'] = json_encode($res);

		return $this->_render('raw');
	}

}
