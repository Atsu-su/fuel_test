<?php
class Presenter_Book_Data extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        $this->book = Model_Book::find(Request::active()->param('num'));
        $this->authors = Model_Author::find('all');
        // $this->set_view('book/edit');
	}
}
