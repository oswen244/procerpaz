<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promotores_planillas".
 *
 * @property integer $id_promotores_planillas
 * @property integer $id_promotor
 * @property integer $id_planilla
 * @property string $gastos_promotor
 *
 * @property Planillas $idPlanilla
 * @property Promotores $idPromotor
 */
class PromotoresPlanillas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promotores_planillas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_promotor', 'id_planilla'], 'required'],
            [['id_promotor', 'id_planilla'], 'integer'],
            [['gastos_promotor'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_promotores_planillas' => 'Id Promotores Planillas',
            'id_promotor' => 'Id Promotor',
            'id_planilla' => 'Id Planilla',
            'gastos_promotor' => 'Gastos Promotor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPlanilla()
    {
        return $this->hasOne(Planillas::className(), ['id_planilla' => 'id_planilla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPromotor()
    {
        return $this->hasOne(Promotores::className(), ['id_promotor' => 'id_promotor']);
    }
}
