<?php
   class Model_Book extends Orm\Model {
      protected static $_connection = 'default';
      protected static $_table_name = 'books';
      protected static $_primary_key = array('id');
      protected static $_properties = array (
         'id',
         'title' => array (
            'data_type' => 'varchar',
            'label' => 'Book title',
            'validation' => array (
               'required',
               'min_length' => array(3),
               'max_length' => array(80)
            ),

            'form' => array (
               'type' => 'text'
            ),
         ),
         'author_id' => array(
            'data_type' => 'int',
            'label' => 'Author',
            'validation' => array(
               'required',
               'valid_string' => array('numeric')
            ),
         ),
         'published_date' => array (
            'data_type' => 'date',
            'label' => 'Published Date',
            'validation' => array (
               'required',
            ),
            'form' => array (
               'type' => 'date'
            ),
         ),
         'description' => array(
            'data_type' => 'text',
            'label' => 'Book description',
            'validation' => array (
               'required',
               'max_length' => array(200),
            ),
            'form' => array (
               'type' => 'textarea'
            ),
         ),
      );
      protected static $_observers = array('Orm\\Observer_Validation' => array (
         'events' => array('before_save')
      ));
      protected static $_belongs_to = array(
        'author' => array(
            'key_from' => 'author_id',
            'model_to' => 'Model_Author',
            'key_to' => 'id',
        )
      );
   }