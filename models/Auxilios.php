<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auxilios".
 *
 * @property integer $id_auxilio
 * @property integer $tipo
 * @property string $porcentaje_aux
 * @property string $monto
 * @property integer $num_meses
 * @property string $fecha_auxilio
 * @property string $proveedor
 * @property integer $estado
 * @property integer $id_cliente
 * @property integer $tipo_auxilio
 * @property integer $id_familiar
 *
 * @property Clientes $idCliente
 * @property Familiares $idFamiliar 
 * @property TipoAuxilio $tipoAuxilio
 * @property PagosAuxilios[] $pagosAuxilios
 */
class Auxilios extends \yii\db\ActiveRecord
{

    const EN_CURSO = '1';
    const TERMINADO = '2';
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
            [['tipo', 'num_meses', 'estado', 'id_cliente', 'tipo_auxilio', 'id_familiar'], 'integer'],
            [['porcentaje_aux', 'monto'], 'number'],
            [['fecha_auxilio'], 'safe'],
            [['id_cliente', 'tipo_auxilio', 'id_familiar'], 'required'],
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
            'porcentaje_aux' => 'Porcentaje de auxilio',
            'monto' => 'Monto',
            'num_meses' => 'Número de meses',
            'fecha_auxilio' => 'Fecha de auxilio',
            'proveedor' => 'Proveedor',
            'estado' => 'Estado',
            'id_cliente' => 'Id Cliente',
            'tipo_auxilio' => 'Tipo de auxilio',
            'familiar' => 'Familiar',
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
   public function getIdFamiliar() 
   { 
       return $this->hasOne(Familiares::className(), ['id_familiar' => 'id_familiar']); 
   }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAuxilio()
    {
        return $this->hasOne(TipoAuxilio::className(), ['id_tipo' => 'tipo_auxilio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagosAuxilios()
    {
        return $this->hasMany(PagosAuxilios::className(), ['id_auxilio' => 'id_auxilio']);
    }

}
