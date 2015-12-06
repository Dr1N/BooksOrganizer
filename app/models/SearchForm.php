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
    
    private $fitstTimestamp = 0;
    private $secondTimestamp = 0;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['firstPublicationDate'], 'date', 'format' => 'd.m.Y', 'timestampAttribute' => 'fitstTimestamp'],
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
            if ($this->fitstTimestamp > $this->secondTimestamp)
            {
                $tmp = $this->fitstTimestamp;
                $this->fitstTimestamp = $this->secondTimestamp;
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

        if($this->fitstTimestamp != 0 && $this->secondTimestamp != 0)
        {
            if($this->fitstTimestamp == $this->secondTimestamp)
            {
                $query = $query->andWhere(['=', 'date', $this->fitstTimestamp]);
            }
            else
            {
                $query = $query->andWhere(['between', 'date', $this->fitstTimestamp, $this->secondTimestamp]);
            }
        }
        else if($this->fitstTimestamp != 0)
        {
            $query = $query->andWhere(['>=', 'date', $this->fitstTimestamp]);
        }
        else if($this->secondTimestamp != 0)
        {
            $query = $query->andWhere(['<=', 'date', $this->secondTimestamp]);
        }

        return $query;
    }
}