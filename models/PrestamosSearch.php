<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prestamos;

/**
 * PrestamosSearch represents the model behind the search form about `app\models\Prestamos`.
 */
class PrestamosSearch extends Prestamos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['id_prestamo', 'num_cuotas', 'id_cliente', 'id_estado'], 'integer'],
           [['monto', 'interes_mensual', 'valor_cuota'], 'number'],
           [['fecha_prest', 'fecha_rep', 'fecha_fin'], 'safe'],
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
        if($id==0){
            $query = Prestamos::find();
        }else{
            $query = Prestamos::find()->where('id_cliente=:id');
            $query->addParams([':id' => $id]);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_prestamo' => $this->id_prestamo,
            'monto' => $this->monto,
            'interes_mensual' => $this->interes_mensual,
            'num_cuotas' => $this->num_cuotas,
            'valor_cuota' => $this->valor_cuota,
            'fecha_prest' => $this->fecha_prest,
            'fecha_rep' => $this->fecha_rep,
            'id_cliente' => $this->id_cliente,
            'id_estado' => $this->id_estado,
            'fecha_fin' => $this->fecha_fin, 
        ]);

        return $dataProvider;
    }
}
