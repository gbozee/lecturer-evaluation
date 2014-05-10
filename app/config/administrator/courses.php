<?php 
return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Courses',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Course',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'Course',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
		'id'=>array(
			'title'=>'Id'
		),
	    'code' => array(
	        'title' => 'Code'
	    ),
	    'title' => array(
	        'title' => 'Course Title',	        
	    ),
	    'level' => array(
	        'title' => 'Level',
	    ),
	    'units' => array(
	        'title' => 'Units',
	    ),
	    'option' => array(
	    	'title' => 'Course Option')
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'code' => array(
	        'title' => 'Code',
	        'type' => 'text'
	    ),
	    'title' => array(
	        'title' => 'Couse Title',
	        'type' => 'text'
	    ),
	    'units' => array(
	        'title' => 'Units',
	        'type' => 'number',	        
	    ),
	    'level'=> array(
	    	'title' => 'Level',
	    	'type' => 'enum',
	    	'options' => ['100','200','300','400','500']
	     ),
	    'option' => array(
	    	'title' => 'Course Option',
	    	'type' => 'enum',
	    	'options' => array('compulsory','elective'),
	    ),
	    'lecturers' => array(
		    'type' => 'relationship',
		    'title' => 'Lecturers',		    
		)
	),
);