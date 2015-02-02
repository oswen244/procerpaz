<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proceso_juridico".
 *
 * @property integer $id_proceso
 * @property integer $id_cliente
 * @property integer $id_abogado
 * @property integer $tiempo_max
 * @property integer $id_estado
 * @property integer $peso_max
 * @property string $fecha
 * @property string $hora
 *
 * @property AvanceProceso[] $avanceProcesos
 * @property Clientes $idCliente
 * @property Estados $idEstado
 * @property Usuarios $idAbogado
 */
class ProcesoJuridico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proceso_juridico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cliente', 'id_abogado', 'id_estado'], 'required'],
            [['id_cliente', 'id_abogado', 'tiempo_max', 'id_estado', 'peso_max'], 'integer'],
            [['fecha', 'hora'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_proceso' => 'Proceso',
            'id_cliente' => 'Cliente',
            'id_abogado' => 'Abogado',
            'tiempo_max' => 'Tiempo Max',
            'id_estado' => 'Estado',
            'peso_max' => 'Peso Max',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvanceProcesos()
    {
        return $this->hasMany(AvanceProceso::className(), ['id_proceso' => 'id_proceso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCliente()
    {
        return $this->hasOne(Clientes::className(), ['id_cliente' => 'id_cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado()
    {
        return $this->hasOne(Estados::className(), ['id_estado' => 'id_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAbogado()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'id_abogado']);
    }
}
