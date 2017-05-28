<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supervisa".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $id_supervisor
 */
class Supervisa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supervisa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_supervisor'], 'required'],
            [['id_usuario', 'id_supervisor'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'id_supervisor' => 'Id Supervisor',
        ];
    }
}
