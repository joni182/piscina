<?php

namespace app\models;

/**
 * This is the model class for table "reservas".
 *
 * @property string $dia
 * @property string $hora
 * @property int $usuario_id
 *
 * @property Usuarios $usuario
 */
class Reservas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dia', 'hora'], 'required'],
            [['dia', 'hora'], 'safe'],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dia' => 'Dia',
            'hora' => 'Hora',
            'usuario_id' => 'Usuario ID',
        ];
    }

    public static function getReservadas()
    {
        $reservas = static::find()->all();
        $array_reservas = [];
        foreach ($reservas as $value) {
            $array_reservas[$value->usuario_id] = $value->dia . ' ' . $value->hora;
        }

        return $array_reservas;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('reservas');
    }
}
