<?php
   class Model_Author extends Orm\Model {
      protected static $_connection = 'default';
      protected static $_table_name = 'authors';
      protected static $_primary_key = array('id');
      protected static $_properties = array (
         'id',
         'name' => array (
            'data_type' => 'varchar',
            'label' => 'Author name',
            'validation' => array (
               'required',
               'max_length' => array(255)
            ),
            'form' => array (
               'type' => 'text'
            ),
         ),
         'birthplace' => array(
            'label' => 'Birthplace',
         ),
         'birthday' => array (
            'data_type' => 'date',
            'label' => 'Birthday',
            'validation' => array (
               'required',
            ),
            'form' => array (
               'type' => 'date'
            ),
         ),
      );
      protected static $_observers = array('Orm\\Observer_Validation' => array (
         'events' => array('before_save')
      ));
      protected static $_has_many = array(
        'author' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Book',
            'key_to' => 'author_id',
        )
      );
   }