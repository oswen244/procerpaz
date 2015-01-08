<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parentezcos".
 *
 * @property integer $id_parentezco
 * @property string $parentezco
 *
 * @property Familiares[] $familiares
 */
class Parentezcos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parentezcos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentezco'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_parentezco' => 'Id Parentezco',
            'parentezco' => 'Parentezco',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliares()
    {
        return $this->hasMany(Familiares::className(), ['id_parentezco' => 'id_parentezco']);
    }
}
