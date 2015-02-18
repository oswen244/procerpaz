<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Promotores;

/**
 * PromotoresSearch represents the model behind the search form about `app\models\Promotores`.
 */
class PromotoresSearch extends Promotores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_promotor', 'estado'], 'integer'],
            [['nombres', 'apellidos'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Promotores::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_promotor' => $this->id_promotor,
            'estado'=> $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos]);

        return $dataProvider;
    }
}
