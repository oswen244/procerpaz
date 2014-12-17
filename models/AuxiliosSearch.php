<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Auxilios;

/**
 * AuxiliosSearch represents the model behind the search form about `app\models\Auxilios`.
 */
class AuxiliosSearch extends Auxilios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_auxilio', 'tipo', 'porcentaje_aux', 'num_meses', 'estado', 'id_cliente', 'tipo_auxilio'], 'integer'],
            [['monto'], 'number'],
            [['fecha_auxilio', 'proveedor', 'familiar'], 'safe'],
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
    public function search($params,$tipo, $id)
    {
        if($id == 0){
            $query = Auxilios::find()->where('tipo=:tipo');
        }else{
            $query = Auxilios::find()->where('tipo=:tipo AND id_cliente =:id');
            $query->addParams([':id' => $id]);
        } 
        $query->addParams([':tipo' => $tipo]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_auxilio' => $this->id_auxilio,
            'tipo' => $this->tipo,
            'porcentaje_aux' => $this->porcentaje_aux,
            'monto' => $this->monto,
            'num_meses' => $this->num_meses,
            'fecha_auxilio' => $this->fecha_auxilio,
            'estado' => $this->estado,
            'id_cliente' => $this->id_cliente,
            'tipo_auxilio' => $this->tipo_auxilio, 
            
        ]);

        $query->andFilterWhere(['like', 'proveedor', $this->proveedor])
           ->andFilterWhere(['like', 'familiar', $this->familiar]);

        return $dataProvider;
    }
}
