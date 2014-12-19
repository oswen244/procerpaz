<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_auxilio".
 *
 * @property integer $id_tipo
 * @property string $tipo_auxilio
 *
 * @property Auxilios[] $auxilios
 */
class TipoAuxilio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_auxilio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_auxilio'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo' => 'Id Tipo',
            'tipo_auxilio' => 'Tipo Auxilio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuxilios()
    {
        return $this->hasMany(Auxilios::className(), ['tipo_auxilio' => 'id_tipo']);
    }
}
