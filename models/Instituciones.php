<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "instituciones".
 *
 * @property integer $id_institucion
 * @property string $nombre
 * @property string $descripcion
 *
 * @property Clientes[] $clientes
 */
class Instituciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instituciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required', 'message' => 'Este campo no puede quedar vacío'],
            [['nombre', 'descripcion'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_institucion' => 'Id Institucion',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['id_institucion' => 'id_institucion']);
    }
}
