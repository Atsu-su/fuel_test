<?php
use Orm\ValidationFailed as ValidationFailed;

   class Controller_Book extends Controller_Template {
      public $template = 'layout';

      public function return_view($title, $content, $subcontent = '')
      {
          $this->template->title = $title;
          $this->template->content = $content;
          $this->template->subcontent = $subcontent;
      }

      public function action_index()
      {
        $data = array();
        $data['favorite1'] = 'apple';
        $data['favorite2'] = 'grapes';

        $view = View::forge('book/index');
        $books = Model_Book::query()
            ->related('author')
            ->order_by('id', 'desc')
            ->limit(10)
            ->get();
        $view->set('books', $books);

         // set the template variables
         $this->return_view("Book index page", $view, View::forge('book/subcontent', $data));
      }

      public function action_create()
      {
        $authors = Model_Author::find('all');
        $view = View::forge('book/create');
        $view->set('authors', $authors);

        $this->return_view("Book add page", $view);
      }

      public function action_store()
      {
        $view = View::forge('book/create');
        $view->set('authors', Model_Author::find('all'));

        if (Input::param() !== array()) {
            try {
                $book = Model_Book::forge();
                $book->title = Input::param('title');
                $book->author_id = Input::param('author_id');
                $book->published_date = Input::param('published_date');
                $book->description = Input::param('description');
                $book->save();
                Response::redirect('book');
            } catch (Orm\ValidationFailed $e) {
                $view->set('errors', $e->getMessage(), false);
                $view->set('input', Input::param());
            }
        }
        $this->return_view('Book create page', $view);
      }

      public function action_edit($id = false)
      {
        // if (!($book = Model_Book::find($id))) {
        if (!Model_Book::find($id)) {
            throw new HttpNotFoundException();
        }

        // $authors = Model_Author::find('all');
        // $view = View::forge('book/edit');
        // $view->set(array(
        //         'authors' => $authors,
        //         'book' => $book,
        //     )
        // );

        // 次はここから
        $this->template->title = 'Book edit page';
        $this->template->content = Presenter::forge('book/data');
        $this->template->subcontent = '';
        // $this->return_view('Book edit page', $view);
      }

      public function action_modify($id = false)
      {
        if (!($book = Model_Book::find($id))) {
            throw new HttpNotFoundException();
        }

        $authors = Model_Author::find('all');
        $view = View::forge('book/edit');
        $view->set(array(
                'authors' => $authors,
                'book' => $book,
            )
        );

        if (Input::param() !== array()) {
            try {
                $book->title = Input::param('title');
                $book->author_id = Input::param('author_id');
                $book->published_date = Input::param('published_date');
                $book->description = Input::param('description');
                $book->save();
                Response::redirect('book');
            } catch (Orm\ValidationFailed $e) {
                $view->set(array(
                    'errors' => $e->get_fieldset()->validation()->error(),
                    'input' => Input::param(),
                ), false);
            }
        }
        $this->return_view('Book edit page', $view);
      }

      public function action_delete($id = false)
      {
        if (!($book = Model_Book::find($id))) {
            throw new HttpNotFoundException();
        }

        $book->delete();
        Response::redirect('book');
      }
   }