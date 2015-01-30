<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "obsequios".
 *
 * @property integer $id_obsequios
 * @property string $num_afil
 * @property string $fecha_ven
 * @property string $nombres
 * @property string $apellidos
 * @property string $telefono
 * @property string $celular
 * @property string $email
 */
class Obsequios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'obsequios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_ven'], 'safe'],
            [['num_afil', 'nombres', 'apellidos', 'telefono', 'celular', 'email'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_obsequios' => 'Id Obsequios',
            'num_afil' => 'Numero de afiliación',
            'fecha_ven' => 'Fecha de vencimiento',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'email' => 'Email',
        ];
    }
}
