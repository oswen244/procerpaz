<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estados".
 *
 * @property integer $id_estado
 * @property string $nombre
 * @property string $entidad
 * @property string $descripcion
 *
 * @property Clientes[] $clientes
 * @property Prestamos[] $prestamos
 * @property ProcesoJuridico[] $procesoJuridicos
 */
class Estados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'entidad'], 'required'],
            [['nombre', 'entidad'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_estado' => 'Id Estado',
            'nombre' => 'Nombre',
            'entidad' => 'Entidad',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['id_estado' => 'id_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamos::className(), ['id_estado' => 'id_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesoJuridicos()
    {
        return $this->hasMany(ProcesoJuridico::className(), ['id_estado' => 'id_estado']);
    }
}
