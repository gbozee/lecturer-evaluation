<?php 
return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Lecturers',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Lecturer',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'Lecturer',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
		'id'=>array(
			'title'=>'Id'
		),
	    'name' => array(
	        'title' => 'Lecturer Name'
	    ),
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'name' => array(
	        'title' => 'Lecturer Name',
	        'type' => 'text'
	    ),	    
	),
);