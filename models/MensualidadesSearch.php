<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mensualidades;

/**
 * MensualidadesSearch represents the model behind the search form about `app\models\Mensualidades`.
 */
class MensualidadesSearch extends Mensualidades
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mensualidad', 'total_cuotas', 'id_cliente'], 'integer'],
            [['fecha_pago'], 'safe'],
            [['monto'], 'number'],
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
        $query = Mensualidades::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_mensualidad' => $this->id_mensualidad,
            'fecha_pago' => $this->fecha_pago,
            'monto' => $this->monto,
            'total_cuotas' => $this->total_cuotas,
            'id_cliente' => $this->id_cliente,
        ]);

        return $dataProvider;
    }
}
