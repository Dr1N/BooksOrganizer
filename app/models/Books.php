<?php

namespace app\models;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;
use yii\helpers\Url;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property integer $date_create
 * @property integer $date_update
 * @property string $preview
 * @property integer $date
 * @property integer $author_id
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{
    public $cover;      //UploadedFile
    public $strDate;    //date in string format dd.mm.yyyy

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date', 'author_id'], 'required'],
            [['author_id'], 'integer'],
            [['strDate'], 'date', 'format' => 'php: d.m.Y', 'timestampAttribute' => 'date'],
            [['name'], 'string', 'max' => 128],
            [['name'], 'trim'],
            [['cover'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, bmp', 'maxSize' => 1024*1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Дата добавления',
            'date_update' => 'Дата обновленя',
            'cover' => 'Обложка',
            'date' => 'Дата издания',
            'author_id' => 'Автор',
            'strDate' => "Дата издания",
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    /**
     * Initialize date in string format
     */
    public function afterFind()
    {
        $this->strDate = date('d.m.Y', $this->date);
    }

    /**
     * Save cover file 
    */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
            return $this->upload();
        } 
        return false;
    }

    public function afterDelete() 
    {
        //to-do
        //delete cover file
    }

    /**
     * Save file with new name
    */
    private function upload()
    {
        if($this->cover)
        {
            $this->preview = time() . rand() . '.' . $this->cover->extension;
            return $this->cover->saveAs('images/' . $this->preview);
        }
        return true;
    }

    public function getBookCoverImageTag()
    {
        $imagePath = ($this->preview == null) ? '/images/nocover.gif' : '/images/' . $this->preview;
        return Html::img(Url::base() . $imagePath,[ 'alt' => 'Обложка', 'style' => 'width:50px;']);
    }
}