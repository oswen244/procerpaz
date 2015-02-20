<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProcesoJuridico;

/**
 * ProcesoJuridicoSearch represents the model behind the search form about `app\models\ProcesoJuridico`.
 */
class ProcesoJuridicoSearch extends ProcesoJuridico
{
    public $nombre_cliente;
    public $apellido_cliente;
    public $nombre_abogado;
    public $apellido_abogado;
    public $estado;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proceso', 'id_cliente', 'id_abogado', 'tiempo_max', 'id_estado', 'peso_max'], 'integer'],
            [['fecha', 'hora', 'nombre_cliente', 'apellido_cliente', 'nombre_abogado', 'apellido_abogado', 'estado'], 'safe'],
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
    public function search($params,$id_abog,$perfil)
    {
        if($perfil === 'abogado'){
            $query = ProcesoJuridico::find()->where('id_abogado=:id');
            $query->addParams([':id'=>$id_abog]);
        }else{
            $query = ProcesoJuridico::find();
        }

        $query->joinWith(['idCliente', 'idAbogado', 'idEstado']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['nombre_cliente'] =[
            'asc'=>['clientes.nombres'=>SORT_ASC],
            'desc'=>['clientes.nombres'=>SORT_DESC],
        ];
        $dataProvider->sort->attributes['apellido_cliente'] =[
            'asc'=>['clientes.apellidos'=>SORT_ASC],
            'desc'=>['clientes.apellidos'=>SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombre_abogado'] =[
            'asc'=>['usuarios.nombres'=>SORT_ASC],
            'desc'=>['usuarios.nombres'=>SORT_DESC],
        ];
        $dataProvider->sort->attributes['apellido_abogado'] =[
            'asc'=>['usuarios.apellidos'=>SORT_ASC],
            'desc'=>['usuarios.apellidos'=>SORT_DESC],
        ];
        $dataProvider->sort->attributes['estado'] =[
            'asc'=>['estados.nombre'=>SORT_ASC],
            'desc'=>['estados.nombre'=>SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_proceso' => $this->id_proceso,
            'id_cliente' => $this->id_cliente,
            'id_abogado' => $this->id_abogado,
            'tiempo_max' => $this->tiempo_max,
            'id_estado' => $this->id_estado,
            'peso_max' => $this->peso_max,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
        ]);

        $query->andFilterWhere(['like', 'clientes.nombres', $this->nombre_cliente]);
        $query->andFilterWhere(['like', 'clientes.apellidos', $this->apellido_cliente]);
        $query->andFilterWhere(['like', 'usuarios.nombres', $this->nombre_abogado]);
        $query->andFilterWhere(['like', 'usuarios.apellidos', $this->apellido_abogado]);
        $query->andFilterWhere(['like', 'estados.nombre', $this->estado]);

        return $dataProvider;
    }
}
