<?php 
return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Students',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Student',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'User',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
		'id'=>array(
			'title'=>'Id'
		),
	    'matric_no' => array(
	        'title' => 'Matric Number'
	    ),
	    'first_name' => array(
	        'title' => 'First Name',	        
	    ),
	    'last_name' => array(
	        'title' => 'Last Name',
	    ),
	    'email' => array(
	        'title' => 'Email',
	    ),
	    'programme' => array(
	    	'title' => 'Programme',
	    ),
	    'department' => array(
	    	'title' => 'Department',
	    ),
	    'level' => array(
	    	'title' => 'Level',
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'matric_no' => array(
	        'title' => 'Matric Number'
	    ),
	    'is_admin' => array(
	    	'title' => 'Is Admin',
	    	'type' => 'bool'
	    ),
	    'first_name' => array(
	        'title' => 'First Name',	        
	    ),
	    'last_name' => array(
	        'title' => 'Last Name',
	    ),
	    'password' => array(
	    	'title' => 'Password',
	    	'type' => 'password'
	    ),
	    'email' => array(
	        'title' => 'Email',
	    ),
	    'programme' => array(
	    	'title' => 'Programme',
	    ),
	    'department' => array(
	    	'title' => 'Department',
	    ),
	    'level' => array(
	    	'title' => 'Level',
	    	'type' => 'enum',
	    	'options' => array(
	    		'100','200','300','400','500'
	    	),
	    )
	),
);