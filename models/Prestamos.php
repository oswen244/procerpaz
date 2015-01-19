<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prestamos".
 *
 * @property integer $id_prestamo
 * @property string $monto
 * @property string $interes_mensual
 * @property integer $num_cuotas
 * @property string $valor_cuota
 * @property string $fecha_prest
 * @property string $fecha_rep
 * @property integer $id_cliente
 * @property integer $id_estado
 *
 * @property PagosPrestamos[] $pagosPrestamos
 * @property Clientes $idCliente
 * @property Estados $idEstado
 */
class Prestamos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prestamos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monto', 'interes_mensual', 'valor_cuota'], 'number'],
            [['num_cuotas', 'id_cliente', 'id_estado'], 'integer'],
            [['fecha_prest', 'fecha_rep'], 'safe'],
            [['id_cliente', 'id_estado'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_prestamo' => 'Id Prestamo',
            'monto' => 'Monto',
            'interes_mensual' => 'Interes Mensual',
            'num_cuotas' => 'Num Cuotas',
            'valor_cuota' => 'Valor Cuota',
            'fecha_prest' => 'Fecha Prest',
            'fecha_rep' => 'Fecha Rep',
            'id_cliente' => 'Id Cliente',
            'id_estado' => 'Id Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagosPrestamos()
    {
        return $this->hasMany(PagosPrestamos::className(), ['id_prestamo' => 'id_prestamo']);
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
}
