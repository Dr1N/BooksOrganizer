<?php

namespace app\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 *
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors';
    }
   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['author_id' => 'id']);
    }
    
    /**
     * @return array(['id' => 'fullname])
     */
    public static function getAuthorsForDropDownList()
    {
        $authorsModels = Authors::find()->all();
        $authors = ArrayHelper::toArray($authorsModels, [
            'app\models\Authors' => [
                'id',
                'fullname' => function($model){
                    return "$model->firstname $model->lastname";
                }
            ]
        ]);
        return ArrayHelper::map($authors, 'id', 'fullname');
    }
}