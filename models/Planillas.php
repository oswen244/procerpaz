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
 *
 * @property Clientes[] $clientes
 * @property PromotoresPlanillas[] $promotoresPlanillas
 * @property Promotores[] $idPromotors
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
            [['fecha', 'comision_afiliado', 'por_ant_com'], 'required'],
            [['fecha'], 'safe'],
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
            'comision_afiliado' => 'Comision Afiliado',
            'por_ant_com' => 'Por Ant Com',
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
    public function getPromotoresPlanillas()
    {
        return $this->hasMany(PromotoresPlanillas::className(), ['id_planilla' => 'id_planilla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPromotors()
    {
        return $this->hasMany(Promotores::className(), ['id_promotor' => 'id_promotor'])->viaTable('promotores_planillas', ['id_planilla' => 'id_planilla']);
    }
}
