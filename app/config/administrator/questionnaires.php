<?php 
return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Questionnaires',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Questionnaire',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'Questionnaire',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
		'id'=>array(
			'title'=>'Id'
		),
	    'programme' => array(
	        'title' => 'Evaluation QuestionID'
	    ),
	    'semester' => array(
	    	'title' => 'Semester',
	    ),
	    'session' => array(
	    	'title' => 'Session'
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'programme' => array(
	        'title' => 'Evaluation QuestionID',
	        'type' => 'text'
	    ),	
	    'semester' => array(
	    	'title' => 'Semester',
	    	'type' => 'enum',
	    	'options' => array('first', 'second'), //must be an array
	    ),
	    'session' => array(
	    	'title' => 'Session'
	    )    
	),
);