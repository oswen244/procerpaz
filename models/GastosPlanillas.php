<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gastos_planillas".
 *
 * @property integer $id_gastos_planillas
 * @property string $valor
 * @property string $fuente
 * @property string $asumido_por
 * @property string $Detalle
 * @property integer $id_planilla
 *
 * @property Planillas $idPlanilla
 */
class GastosPlanillas extends \yii\db\ActiveRecord
{

    const TOTAL_PLANILLA = 'Total planilla';
    const POR_AFILIACION = 'Por afiliación';
    const PROMOTORES = 'Promotores';
    const FUNDACION = 'Fundación';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gastos_planillas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor', 'fuente', 'asumido_por', 'id_planilla'], 'required'],
            [['valor'], 'number'],
            [['id_planilla'], 'integer'],
            [['fuente', 'asumido_por'], 'string', 'max' => 45],
            [['Detalle'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_gastos_planillas' => 'Id Gastos Planillas',
            'valor' => 'Valor',
            'fuente' => 'Fuente a descontar',
            'asumido_por' => 'Asumido Por',
            'Detalle' => 'Detalle',
            'id_planilla' => 'Id Planilla',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPlanilla()
    {
        return $this->hasOne(Planillas::className(), ['id_planilla' => 'id_planilla']);
    }
}
