<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prestamos".
 *
 * @property integer $id_prestamo
 * @property string $monto
 * @property integer $interes_mensual
 * @property integer $num_cuotas
 * @property string $valor_cuota
 * @property string $fecha_prest
 * @property string $fecha_rep
 * @property integer $id_cliente
 * @property integer $id_estado
 *
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
            [['monto', 'valor_cuota'], 'number'],
            [['interes_mensual', 'num_cuotas', 'id_cliente', 'id_estado'], 'integer'],
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
            'num_cuotas' => 'Número de cuotas',
            'valor_cuota' => 'Valor de la cuota',
            'fecha_prest' => 'Fecha del prestamo',
            'fecha_rep' => 'Fecha de reporte',
            'id_cliente' => 'Id Cliente',
            'id_estado' => 'Estado',
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
    public function getIdEstado()
    {
        return $this->hasOne(Estados::className(), ['id_estado' => 'id_estado']);
    }
}
