<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagos_auxilios".
 *
 * @property integer $id_pago
 * @property string $monto
 * @property string $fecha
 * @property integer $id_auxilio
 *
 * @property Auxilios $idAuxilio
 */
class PagosAuxilios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagos_auxilios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monto', 'fecha', 'id_auxilio'], 'required', 'message' => 'Este campo no puede quedar vacío'],
            [['monto'], 'number', 'message' => 'Este campo debe ser numérico'],
            [['fecha'], 'safe'],
            [['id_auxilio'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pago' => 'Id Pago',
            'monto' => 'Monto',
            'fecha' => 'Fecha',
            'id_auxilio' => 'Id Auxilio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAuxilio()
    {
        return $this->hasOne(Auxilios::className(), ['id_auxilio' => 'id_auxilio']);
    }
}
