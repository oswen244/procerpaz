<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auxilios".
 *
 * @property integer $id_auxilio
 * @property integer $tipo
 * @property integer $porcentaje_aux
 * @property string $monto
 * @property integer $num_meses
 * @property string $fecha_auxilio
 * @property string $proveedor
 * @property integer $estado
 * @property integer $id_cliente
 * @property integer $tipo_auxilio
 *
 * @property Clientes $idCliente
 * @property TipoAuxilio $tipoAuxilio
 */
class Auxilios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auxilios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'porcentaje_aux', 'num_meses', 'estado', 'id_cliente', 'tipo_auxilio'], 'integer'],
            [['monto'], 'number'],
            [['fecha_auxilio'], 'safe'],
            [['estado', 'id_cliente', 'tipo_auxilio'], 'required'],
            [['proveedor'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_auxilio' => 'Id Auxilio',
            'tipo' => 'Tipo',
            'porcentaje_aux' => 'Porcentaje Aux',
            'monto' => 'Monto',
            'num_meses' => 'Num Meses',
            'fecha_auxilio' => 'Fecha Auxilio',
            'proveedor' => 'Proveedor',
            'estado' => 'Estado',
            'id_cliente' => 'Id Cliente',
            'tipo_auxilio' => 'Tipo Auxilio',
        ];
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
    public function getTipoAuxilio()
    {
        return $this->hasOne(TipoAuxilio::className(), ['id_tipo' => 'tipo_auxilio']);
    }
}
