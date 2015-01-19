<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagos_prestamos".
 *
 * @property integer $id_pagos
 * @property string $capital
 * @property string $amortizacion
 * @property string $fecha
 * @property integer $id_prestamo
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
            [['capital', 'amortizacion'], 'number'],
            [['fecha'], 'safe'],
            [['id_prestamo'], 'required'],
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
            'amortizacion' => 'Amortizacion',
            'fecha' => 'Fecha',
            'id_prestamo' => 'Id Prestamo',
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
