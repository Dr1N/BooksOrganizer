<?php
	namespace app\components;

	use Yii;
	use yii\base\ActionFilter;

	/**
	* 
	*/
	class SessionAction extends ActionFilter
	{
		public function __construct($config = [])
	    {
	        parent::__construct($config);
	    }

	    public function beforeAction ($action)
	    {
	    	if(Yii::$app->session->has('searchForm'))
	    	{
	    		Yii::$app->session->remove('searchForm');
	    	}

	    	if(Yii::$app->session->has('absoluteUrl'))
	    	{
	    		Yii::$app->session->remove('absoluteUrl');
	    	}
	    	return true;
	    }
	}