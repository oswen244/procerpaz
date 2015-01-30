<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Obsequios;

/**
 * ObsequiosSearch represents the model behind the search form about `app\models\Obsequios`.
 */
class ObsequiosSearch extends Obsequios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_obsequios'], 'integer'],
            [['num_afil', 'fecha_ven', 'nombres', 'apellidos', 'telefono', 'celular', 'email'], 'safe'],
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
        $query = Obsequios::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_obsequios' => $this->id_obsequios,
            'fecha_ven' => $this->fecha_ven,
        ]);

        $query->andFilterWhere(['like', 'num_afil', $this->num_afil])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'celular', $this->celular])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
