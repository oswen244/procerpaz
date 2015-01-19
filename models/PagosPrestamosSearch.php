<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PagosPrestamos;

/**
 * PagosPrestamosSearch represents the model behind the search form about `app\models\PagosPrestamos`.
 */
class PagosPrestamosSearch extends PagosPrestamos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pagos', 'id_prestamo'], 'integer'],
            [['capital', 'amortizacion'], 'number'],
            [['fecha'], 'safe'],
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
    public function search($params,$id_prestamo)
    {
        $query = PagosPrestamos::find()->where('id_prestamo=:id');
        $query->addParams([':id' => $id_prestamo]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_pagos' => $this->id_pagos,
            'capital' => $this->capital,
            'amortizacion' => $this->amortizacion,
            'fecha' => $this->fecha,
            'id_prestamo' => $this->id_prestamo,
        ]);

        return $dataProvider;
    }
}
