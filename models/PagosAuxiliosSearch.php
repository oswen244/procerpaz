<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PagosAuxilios;

/**
 * PagosAuxiliosSearch represents the model behind the search form about `app\models\PagosAuxilios`.
 */
class PagosAuxiliosSearch extends PagosAuxilios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pago', 'id_auxilio'], 'integer'],
            [['monto'], 'number'],
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
    public function search($params,$id_auxilio)
    {
        $query = PagosAuxilios::find()->where('id_auxilio=:id_auxilio');
        $query->addParams([':id_auxilio' => $id_auxilio]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['fecha' => false]],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_pago' => $this->id_pago,
            'monto' => $this->monto,
            'fecha' => $this->fecha,
            'id_auxilio' => $this->id_auxilio,
        ]);

        return $dataProvider;
    }
}
