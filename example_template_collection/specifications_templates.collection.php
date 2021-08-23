<?php
 return array (
  'name' => 'specifications_templates',
  'label' => 'Specification templates',
  '_id' => 'specifications_templates',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'label' => '',
      'type' => 'uniqueid',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => false,
    ),
    1 => 
    array (
      'name' => 'name',
      'label' => '',
      'type' => 'text',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => true,
    ),
    2 => 
    array (
      'name' => 'attributes',
      'label' => '',
      'type' => 'repeater',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
        'field' => 
        array (
          'type' => 'set',
          'label' => 'Attribute',
          'display' => 'name',
          'options' => 
          array (
            'fields' => 
            array (
              0 => 
              array (
                'type' => 'uniqueid',
                'name' => 'id',
                'label' => 'id',
                'options' => 
                array (
                  'length' => 10,
                ),
              ),
              1 => 
              array (
                'type' => 'text',
                'name' => 'name',
                'label' => 'name',
              ),
            ),
          ),
        ),
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => false,
    ),
  ),
  'sortable' => false,
  'in_menu' => false,
  '_created' => 1629366541,
  '_modified' => 1629376267,
  'color' => '#48CFAD',
  'acl' => 
  array (
  ),
  'sort' => 
  array (
    'column' => '_created',
    'dir' => -1,
  ),
  'rules' => 
  array (
    'create' => 
    array (
      'enabled' => false,
    ),
    'read' => 
    array (
      'enabled' => false,
    ),
    'update' => 
    array (
      'enabled' => false,
    ),
    'delete' => 
    array (
      'enabled' => false,
    ),
  ),
  'icon' => 'form-editor.svg',
);