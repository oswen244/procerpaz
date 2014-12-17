<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Familiares;

/**
 * FamiliaresSearch represents the model behind the search form about `app\models\Familiares`.
 */
class FamiliaresSearch extends Familiares
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_familiar', 'id_cliente', 'id_parentezco'], 'integer'],
            [['nombres', 'apellidos', 'tipo_id', 'num_id', 'genero', 'fecha_nacimiento', 'pais', 'ciudad', 'email', 'direccion', 'telefono'], 'safe'],
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
    public function search($params,$id)
    {
        $query = Familiares::find()->where('id_cliente=:id');
        $query->addParams([':id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_familiar' => $this->id_familiar,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'id_cliente' => $this->id_cliente,
            'id_parentezco' => $this->id_parentezco,
        ]);

        $query->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'tipo_id', $this->tipo_id])
            ->andFilterWhere(['like', 'num_id', $this->num_id])
            ->andFilterWhere(['like', 'genero', $this->genero])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'telefono', $this->telefono]);

        return $dataProvider;
    }
}
