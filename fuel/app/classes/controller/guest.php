<?php
class Controller_Guest extends Controller_Template
{

	public function action_index()
	{
		$data['guests'] = Model_Guest::find('all');
		$this->template->title = "Guests";
		$this->template->content = View::forge('guest/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('guest');

		if ( ! $data['guest'] = Model_Guest::find($id))
		{
			Session::set_flash('error', 'Could not find guest #'.$id);
			Response::redirect('guest');
		}

		$this->template->title = "Guest";
		$this->template->content = View::forge('guest/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Guest::validate('create');

			if ($val->run())
			{
				$guest = Model_Guest::forge(array(
					'name' => Input::post('name'),
				));

				if ($guest and $guest->save())
				{
					Session::set_flash('success', 'Added guest #'.$guest->id.'.');

					Response::redirect('guest');
				}

				else
				{
					Session::set_flash('error', 'Could not save guest.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Guests";
		$this->template->content = View::forge('guest/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('guest');

		if ( ! $guest = Model_Guest::find($id))
		{
			Session::set_flash('error', 'Could not find guest #'.$id);
			Response::redirect('guest');
		}

		$val = Model_Guest::validate('edit');

		if ($val->run())
		{
			$guest->name = Input::post('name');

			if ($guest->save())
			{
				Session::set_flash('success', 'Updated guest #' . $id);

				Response::redirect('guest');
			}

			else
			{
				Session::set_flash('error', 'Could not update guest #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$guest->name = $val->validated('name');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('guest', $guest, false);
		}

		$this->template->title = "Guests";
		$this->template->content = View::forge('guest/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('guest');

		if ($guest = Model_Guest::find($id))
		{
			$guest->delete();

			Session::set_flash('success', 'Deleted guest #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete guest #'.$id);
		}

		Response::redirect('guest');

	}

}
