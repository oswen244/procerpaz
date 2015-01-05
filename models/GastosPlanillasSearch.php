<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GastosPlanillas;

/**
 * GastosPlanillasSearch represents the model behind the search form about `app\models\GastosPlanillas`.
 */
class GastosPlanillasSearch extends GastosPlanillas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_gastos_planillas', 'id_planilla'], 'integer'],
            [['valor'], 'number'],
            [['fuente', 'asumido_por', 'Detalle'], 'safe'],
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
        $query = GastosPlanillas::find()->where('id_planilla=:id');
        $query->addParams([':id' => $id_planilla]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'Detalle', $this->Detalle]);
        $query->andFilterWhere(['like', 'fuente', $this->fuente])
           ->andFilterWhere(['like', 'asumido_por', $this->asumido_por])
           ->andFilterWhere(['like', 'Detalle', $this->Detalle]);

        return $dataProvider;
    }
}
