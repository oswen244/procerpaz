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
    public $documento_cliente;
    public $nombre_cliente;
    public $apellido_cliente;
    public $estado;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['id_prestamo', 'num_cuotas', 'id_cliente', 'id_estado'], 'integer'],
           [['monto', 'interes_mensual', 'valor_cuota'], 'number'],
           [['fecha_prest', 'fecha_rep', 'fecha_fin'], 'safe'],
           [['documento_cliente', 'nombre_cliente', 'apellido_cliente', 'estado'], 'safe'],
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
            $query = Prestamos::find()->where('prestamos.id_cliente=:id');
            $query->addParams([':id' => $id]);
        }

        $query->joinWith(['idCliente', 'idEstado']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

         $dataProvider->sort->attributes['estado'] =[
            'asc'=>['estados.nombre'=>SORT_ASC],
            'desc'=>['estados.nombre'=>SORT_DESC],
        ];

        $dataProvider->sort->attributes['documento_cliente'] =[
            'asc'=>['clientes.num_id'=>SORT_ASC],
            'desc'=>['clientes.num_id'=>SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombre_cliente'] =[
            'asc'=>['clientes.nombres'=>SORT_ASC],
            'desc'=>['clientes.nombres'=>SORT_DESC],
        ];
        $dataProvider->sort->attributes['apellido_cliente'] =[
            'asc'=>['clientes.apellidos'=>SORT_ASC],
            'desc'=>['clientes.apellidos'=>SORT_DESC],
        ];

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

        $query->andFilterWhere(['like', 'clientes.num_id', $this->documento_cliente]);
        $query->andFilterWhere(['like', 'clientes.nombres', $this->nombre_cliente]);
        $query->andFilterWhere(['like', 'clientes.apellidos', $this->apellido_cliente]);
        $query->andFilterWhere(['like', 'estados.nombre', $this->estado]);

        return $dataProvider;
    }
}
