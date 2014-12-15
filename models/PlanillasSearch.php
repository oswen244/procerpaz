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
            [['id_planilla', 'id_usuario'], 'integer'],
            [['fecha', 'lugar', 'unidad', 'comision_afiliado', 'por_ant_com'], 'safe'],
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
            'fecha' => $this->fecha,
            'id_usuario' => $this->id_usuario,
        ]);

        $query->andFilterWhere(['like', 'lugar', $this->lugar])
            ->andFilterWhere(['like', 'unidad', $this->unidad])
            ->andFilterWhere(['like', 'comision_afiliado', $this->comision_afiliado])
            ->andFilterWhere(['like', 'por_ant_com', $this->por_ant_com]);

        return $dataProvider;
    }
}
