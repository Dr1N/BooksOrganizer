<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SearchForm extends Model
{
    public $author_id;
    public $name;
    public $firstPublicationDate;
    public $secondPublicationDate;
    
    public $firstTimestamp = 0;
    public $secondTimestamp = 0;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['firstPublicationDate'], 'date', 'format' => 'd.m.Y', 'timestampAttribute' => 'firstTimestamp'],
            [['secondPublicationDate'], 'date', 'format' => 'd.m.Y', 'timestampAttribute' => 'secondTimestamp'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'author_id' => '',
            'name' => '',
            'firstPublicationDate' => 'Дата издания:',
            'secondPublicationDate' => 'Дата издания:',
        ];
    }

    /**
    * Normalize dates
    */
    public function afterValidate()
    {
        if(!empty($firstPublicationDate) && !empty($secondPublicationDate))
        {
            if ($this->firstTimestamp > $this->secondTimestamp)
            {
                $tmp = $this->firstTimestamp;
                $this->firstTimestamp = $this->secondTimestamp;
                $this->secondTimestamp = $tmp;
            }
        }
    }

    /**
     * Get query for book search
     * @return [QueryInterface]
     */
    public function getSearchQuery()
    {
        $query = Books::find();
        
        //Author

        $query = $query->filterWhere(['author_id' => $this->author_id]);
            
        //Name

        if(!empty($this->name))
        {
            $query = $query->andWhere(['like', 'name', $this->name]);
        }
        
        //Date

        if($this->firstTimestamp != 0 && $this->secondTimestamp != 0)
        {
            if($this->firstTimestamp == $this->secondTimestamp)
            {
                $query = $query->andWhere(['=', 'date', $this->firstTimestamp]);
            }
            else
            {
                $query = $query->andWhere(['between', 'date', $this->firstTimestamp, $this->secondTimestamp]);
            }
        }
        else if($this->firstTimestamp != 0)
        {
            $query = $query->andWhere(['>=', 'date', $this->firstTimestamp]);
        }
        else if($this->secondTimestamp != 0)
        {
            $query = $query->andWhere(['<=', 'date', $this->secondTimestamp]);
        }

        return $query;
    }
}