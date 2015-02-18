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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proceso', 'id_cliente', 'id_abogado', 'tiempo_max', 'id_estado', 'peso_max'], 'integer'],
            [['fecha', 'hora'], 'safe'],
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
            $query = ProcesoJuridico::find()->where('id_abogado=:id AND estado<>3');
            $query->addParams([':id'=>$id_abog]);
        }else{
            $query = ProcesoJuridico::find();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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

        return $dataProvider;
    }
}
