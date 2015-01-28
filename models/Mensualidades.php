<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mensualidades".
 *
 * @property integer $id_mensualidad
 * @property string $fecha_pago
 * @property string $monto
 * @property integer $total_cuotas
 * @property integer $id_cliente
 *
 * @property Clientes $idCliente
 */
class Mensualidades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mensualidades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_pago', 'monto', 'id_cliente'], 'required', 'message' => 'Este campo no puede quedar vacío'],
            [['fecha_pago'], 'safe'],
            [['monto'], 'number', 'message' => 'Este campo debe ser numérico'],
            [['total_cuotas', 'id_cliente'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_mensualidad' => 'Id Mensualidad',
            'fecha_pago' => 'Fecha Pago',
            'monto' => 'Monto',
            'total_cuotas' => 'Total Cuotas',
            'id_cliente' => 'Id Cliente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCliente()
    {
        return $this->hasOne(Clientes::className(), ['id_cliente' => 'id_cliente']);
    }
}
