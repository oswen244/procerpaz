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
class Usuarios extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    const MASCULINO = 'M';
    const FEMENINO = 'F';
    public $authKey;
    public $accessToken;
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
            [['nombres', 'apellidos', 'usuario', 'contrasena', 'perfil'], 'required', 'message' => 'Este campo no puede quedar vacío'],
            [['estado'], 'integer'],
            [['usuario'], 'unique'],
            [['email'], 'email'],
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

    public function getId()
    {
        return $this->id_usuario;
    }

    public static function findIdentity($id)
    {
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        $usuario = Usuarios::find()->where(['id_usuario' => $id])->one();
        if ($usuario !== null) {
            return new static($usuario);
        }
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $usuario = Usuarios::find()->where(['accessToken' => $toke])->one();
        if ($usuario['accessToken'] !== null) {
            return new static($usuario);
        }
        return null;
    }

    public function getUsername(){
        return $this->usuario;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    
    public function validatePassword($password)
    {
        return $this->contrasena === sha1($password);
    }

    public static function findByUsername($username)
    {
        $usuario = Usuarios::find()->where(['usuario' => $username])->one();
        if ($usuario !== null && $usuario['estado'] !== 3) {
            return new static($usuario);
        }
        return null;
    }
}
