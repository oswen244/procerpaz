<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Clientes;

/**
 * ClientesSearch represents the model behind the search form about `app\models\Clientes`.
 */
class ClientesSearch extends Clientes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cliente', 'id_institucion', 'id_planilla', 'id_estado'], 'integer'],
            [['num_afiliacion', 'fecha_afiliacion', 'nombres', 'apellidos', 'tipo_id', 'num_id', 'genero', 'lugar_exp', 'fecha_nacimiento', 'grado', 'pais', 'ciudad', 'email', 'direccion', 'telefono', 'celular', 'observaciones', 'fecha_rep', 'fecha_ven', 'fecha_desafil'], 'safe'],
            [['monto_paquete'], 'number'],
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
        $query = Clientes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_cliente' => $this->id_cliente,
            'fecha_afiliacion' => $this->fecha_afiliacion,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'id_institucion' => $this->id_institucion,
            'id_planilla' => $this->id_planilla,
            'id_estado' => $this->id_estado,
            'monto_paquete' => $this->monto_paquete,
            'fecha_rep' => $this->fecha_rep, 
            'fecha_ven' => $this->fecha_ven, 
            'fecha_desafil' => $this->fecha_desafil, 
        ]);

        $query->andFilterWhere(['like', 'num_afiliacion', $this->num_afiliacion])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'tipo_id', $this->tipo_id])
            ->andFilterWhere(['like', 'num_id', $this->num_id])
            ->andFilterWhere(['like', 'genero', $this->genero])
            ->andFilterWhere(['like', 'lugar_exp', $this->lugar_exp])
            ->andFilterWhere(['like', 'grado', $this->grado])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'celular', $this->celular]) 
            ->andFilterWhere(['like', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
