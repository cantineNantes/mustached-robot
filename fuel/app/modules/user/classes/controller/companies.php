<?php

namespace User;

class Controller_Companies extends \Controller_Rest
{

	public function get_search()
	{

		$companies = \Arr::assoc_to_keyval(Model_Company::query()->where('name', 'LIKE', '%'.\Input::get('query').'%')->get(), 'id', 'name');

		foreach ($companies as $id => $company) {
			$suggestions[] = $company;
			$datas[]       = $id;
		}

		$this->response($res = array(
			'query'       => \Input::get('query'),
			'suggestions' => $suggestions,
			'data'        => $datas
		));
	}

}
