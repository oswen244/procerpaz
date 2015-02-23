<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "familiares".
 *
 * @property integer $id_familiar
 * @property string $nombres
 * @property string $apellidos
 * @property string $tipo_id
 * @property string $num_id
 * @property string $genero
 * @property string $fecha_nacimiento
 * @property string $pais
 * @property string $ciudad
 * @property string $email
 * @property string $direccion
 * @property string $telefono
 * @property string $celular
 * @property integer $id_cliente
 * @property integer $id_parentezco
 *
 * @property Auxilios[] $auxilios 
 * @property Clientes $idCliente
 * @property Parentezcos $idParentezco
 */
class Familiares extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'familiares';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'tipo_id', 'num_id', 'id_cliente', 'id_parentezco'], 'required'],
            [['fecha_nacimiento'], 'safe'],
            [['email'], 'email'],
            [['id_cliente', 'id_parentezco'], 'integer', 'message' => 'Este campo debe ser numérico'],
            [['nombres', 'apellidos', 'tipo_id', 'num_id', 'pais', 'ciudad', 'email', 'direccion', 'telefono', 'celular'], 'string', 'max' => 45],
            [['genero'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_familiar' => 'Id Familiar',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'tipo_id' => 'Tipo ID',
            'num_id' => 'Num ID',
            'genero' => 'Genero',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'pais' => 'Pais',
            'ciudad' => 'Ciudad',
            'email' => 'Email',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'id_cliente' => 'Cliente',
            'id_parentezco' => 'Parentezco',
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
    public function getIdParentezco()
    {
        return $this->hasOne(Parentezcos::className(), ['id_parentezco' => 'id_parentezco']);
    }

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getAuxilios() 
   { 
       return $this->hasMany(Auxilios::className(), ['id_familiar' => 'id_familiar']); 
   }
}
