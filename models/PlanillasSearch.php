<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Planillas;

/**
 * PlanillasSearch represents the model behind the search form about `app\models\Planillas`.
 */
class PlanillasSearch extends Planillas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_planilla', 'numero'], 'integer'],
            [['fecha', 'lugar', 'unidad'], 'safe'],
            [['comision_afiliado', 'por_ant_com'], 'number'],
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
        $query = Planillas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_planilla' => $this->id_planilla,
            'numero' => $this->numero, 
            'fecha' => $this->fecha,
            'comision_afiliado' => $this->comision_afiliado, 
            'por_ant_com' => $this->por_ant_com, 
        ]);

        $query->andFilterWhere(['like', 'lugar', $this->lugar])
            ->andFilterWhere(['like', 'unidad', $this->unidad]);

        return $dataProvider;
    }
}
