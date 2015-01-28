<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagos_prestamos".
 *
 * @property integer $id_pagos
 * @property string $capital
 * @property string $valor_cuota
 * @property string $fecha
 * @property integer $id_prestamo
 * @property string $interes
 * @property string $amortizacion
 *
 * @property Prestamos $idPrestamo
 */
class PagosPrestamos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagos_prestamos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['capital', 'valor_cuota', 'interes', 'amortizacion'], 'number', 'message' => 'Este campo debe ser numérico'],
            [['fecha'], 'safe'],
            [['id_prestamo'], 'required', 'message' => 'Este campo no puede quedar vacío'],
            [['id_prestamo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pagos' => 'Id Pagos',
            'capital' => 'Capital',
            'valor_cuota' => 'Valor Cuota',
            'fecha' => 'Fecha',
            'id_prestamo' => 'Id Prestamo',
            'interes' => 'Interes',
            'amortizacion' => 'Amortizacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPrestamo()
    {
        return $this->hasOne(Prestamos::className(), ['id_prestamo' => 'id_prestamo']);
    }
}
