<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "planillas".
 *
 * @property integer $id_planilla
 * @property string $fecha
 * @property string $lugar
 * @property string $unidad
 * @property string $comision_afiliado
 * @property string $por_ant_com
 * @property integer $id_usuario
 *
 * @property Clientes[] $clientes
 * @property Usuarios $idUsuario
 */
class Planillas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planillas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'comision_afiliado', 'por_ant_com', 'id_usuario'], 'required'],
            [['fecha'], 'safe'],
            [['id_usuario'], 'integer'],
            [['lugar', 'unidad', 'comision_afiliado', 'por_ant_com'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_planilla' => 'Id Planilla',
            'fecha' => 'Fecha',
            'lugar' => 'Lugar',
            'unidad' => 'Unidad',
            'comision_afiliado' => 'Comision por afiliado',
            'por_ant_com' => '% Ant Com',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['id_planilla' => 'id_planilla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'id_usuario']);
    }
}
