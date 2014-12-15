<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id_usuario
 * @property string $nombres
 * @property string $apellidos
 * @property string $cargo
 * @property string $telefono
 * @property string $email
 * @property string $pais
 * @property string $ciudad
 * @property string $genero
 * @property string $celular
 * @property string $usuario
 * @property string $contrasena
 * @property string $perfil
 * @property integer $estado
 *
 * @property Planillas[] $planillas
 * @property ProcesoJuridico[] $procesoJuridicos
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'usuario', 'contrasena', 'perfil'], 'required'],
            [['estado'], 'integer'],
            [['nombres', 'apellidos', 'cargo', 'telefono', 'email', 'pais', 'ciudad', 'celular', 'usuario', 'contrasena', 'perfil'], 'string', 'max' => 45],
            [['genero'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'cargo' => 'Cargo',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'pais' => 'Pais',
            'ciudad' => 'Ciudad',
            'genero' => 'Genero',
            'celular' => 'Celular',
            'usuario' => 'Usuario',
            'contrasena' => 'Contrasena',
            'perfil' => 'Perfil',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanillas()
    {
        return $this->hasMany(Planillas::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesoJuridicos()
    {
        return $this->hasMany(ProcesoJuridico::className(), ['id_abogado' => 'id_usuario']);
    }
}
