<?php 
return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Questions',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'Question',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'Question',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
		'id'=>array(
			'title'=>'Id'
		),
	    'question' => array(
	        'title' => 'Question'
	    ),
	    'type' => array(
	    	'title' => 'Question Type',
	    ),
	    
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'question' => array(
	        'title' => 'Question',
	        'type' => 'text'
	    ),	
	    'type' => array(
	    	'title' => 'Question Type',
	    	'type' => 'enum',
	    	'options' => array('comment','assessment','opinion') //must be an array
	    ),
	    'questionnaire' => array(
		    'type' => 'relationship',
		    'title' => 'Questionnaire',
		    'name_field' => 'programme', //what column or accessor on the other table you want to use to represent this object
		) 
	),
);