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
            if ($value->usuario_id) {
                $array_reservas[] = [
                    'fecha' => $value->dia . ' ' . $value->hora,
                    'usuario_id' => $value->usuario_id,
                    'id' => $value->id,
                ];
            }
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
