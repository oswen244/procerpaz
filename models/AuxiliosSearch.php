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
    public $documento_cliente;
    public $nombre_cliente;
    public $apellido_cliente;
    public $tipoAuxilio;
    public $familiar;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_auxilio', 'tipo', 'num_meses', 'estado', 'id_cliente', 'tipo_auxilio', 'id_familiar'], 'integer'],
            [['porcentaje_aux', 'monto'], 'number'],
            [['fecha_auxilio', 'proveedor'], 'safe'],
            [['documento_cliente', 'nombre_cliente', 'apellido_cliente', 'tipoAuxilio'], 'safe'],
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
            $query = Auxilios::find()->where('auxilios.tipo=:tipo');
        }else{
            $query = Auxilios::find()->where('auxilios.tipo=:tipo AND auxilios.id_cliente =:id');
            $query->addParams([':id' => $id]);
        } 
        $query->addParams([':tipo' => $tipo]);

        $query->joinWith(['idCliente', 'idFamiliar', 'tipoAuxilio']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


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
        $dataProvider->sort->attributes['tipoAuxilio'] =[
            'asc'=>['tipo_auxilio.tipo_auxilio'=>SORT_ASC],
            'desc'=>['tipo_auxilio.tipo_auxilio'=>SORT_DESC],
        ];


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
            'id_familiar' => $this->id_familiar, 
            
        ]);

        $query->andFilterWhere(['like', 'proveedor', $this->proveedor]);
        $query->andFilterWhere(['like', 'clientes.num_id', $this->documento_cliente]);
        $query->andFilterWhere(['like', 'clientes.nombres', $this->nombre_cliente]);
        $query->andFilterWhere(['like', 'clientes.apellidos', $this->apellido_cliente]);
        $query->andFilterWhere(['like', 'tipo_auxilio.tipo_auxilio', $this->tipoAuxilio]);

        return $dataProvider;
    }
}
