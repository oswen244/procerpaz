<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PromotoresPlanillas;

/**
 * PromotoresPlanillasSearch represents the model behind the search form about `app\models\PromotoresPlanillas`.
 */
class PromotoresPlanillasSearch extends PromotoresPlanillas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_promotores_planillas', 'id_promotor', 'id_planilla'], 'integer'],
            [['gastos_promotor'], 'number'], 
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
    public function search($params,$id_planilla)
    {
        $query = PromotoresPlanillas::find()->where('id_planilla=:id');
        $query->addParams([':id' => $id_planilla]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>false,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_promotores_planillas' => $this->id_promotores_planillas,
            'id_promotor' => $this->id_promotor,
            'id_planilla' => $this->id_planilla,
            'gastos_promotor' => $this->gastos_promotor, 
        ]);

        return $dataProvider;
    }
}
