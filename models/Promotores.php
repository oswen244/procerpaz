<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promotores".
 *
 * @property integer $id_promotor
 * @property string $nombres
 * @property string $apellidos
 * @property integer $estado
 *
 * @property PromotoresPlanillas[] $promotoresPlanillas
 */
class Promotores extends \yii\db\ActiveRecord
{
    const ACTIVO = 'Activo';
    const ELIMINADO = 'Eliminado';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promotores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos'], 'required'],
            [['estado'], 'integer'],
            [['nombres', 'apellidos'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_promotor' => 'Id Promotor',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotoresPlanillas()
    {
        return $this->hasMany(PromotoresPlanillas::className(), ['id_promotor' => 'id_promotor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPlanillas()
    {
        return $this->hasMany(Planillas::className(), ['id_planilla' => 'id_planilla'])->viaTable('promotores_planillas', ['id_promotor' => 'id_promotor']);
    }
}
