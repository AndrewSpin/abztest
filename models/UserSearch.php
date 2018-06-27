<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends User
{
    public $Chief;
    public $Position;


    public function rules()
    {
        return [
            [['name', 'Chief', 'Position'], 'string'],
            [['start_date'], 'date'],
            [['salary'], 'integer'],

        ];
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = User::find()
            ->select([
                'u.id',
                'u.name',
                'u.start_date',
                'u.salary',
                'u.position_id',
                'u.photo',
                'p.position',
                'h.chief_user_id',
                'c.name as Chief'
            ])
            ->from('user as u')
            ->leftJoin('position AS p', 'u.position_id = p.id')
            ->leftJoin('hierarchy AS h', 'u.id = h.subordinate_user_id')
            ->leftJoin('user AS c', 'c.id = h.chief_user_id');


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'name' => [
                        'default'=>'desc',
                    ],
                    'Position' => [
                        'desc' => ['Position' => SORT_DESC],
                        'asc' => ['Position' => SORT_ASC],
                        'default'=>'desc',
                    ],
                    'Chief' => [
                        'desc' => ['Chief' => SORT_DESC],
                        'asc' => ['Chief' => SORT_ASC],
                        'default'=>'desc',
                    ],
                    'start_date' => [
                        'default'=>'desc',
                    ],
                    'salary' => [
                        'default'=>'desc',
                    ],
                ]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['u.salary' => $this->salary]);
        $query->andFilterWhere(['like', 'u.name', $this->name])
            ->andFilterWhere(['like', 'u.start_date', $this->start_date])
            ->andFilterWhere(['like', 'c.name', $this->Chief])
            ->andFilterWhere(['like', 'p.position', $this->Position]);

        return $dataProvider;
    }
}