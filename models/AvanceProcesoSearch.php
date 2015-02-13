<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AvanceProceso;

/**
 * AvanceProcesoSearch represents the model behind the search form about `app\models\AvanceProceso`.
 */
class AvanceProcesoSearch extends AvanceProceso
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_avance', 'id_proceso'], 'integer'],
            [['fecha', 'hora', 'avance'], 'safe'],
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
        $query = AvanceProceso::find()->where('id_proceso=:id');
        $query->addParams([':id'=>$id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_avance' => $this->id_avance,
            'id_proceso' => $this->id_proceso,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
        ]);

        $query->andFilterWhere(['like', 'avance', $this->avance]);

        return $dataProvider;
    }
}
