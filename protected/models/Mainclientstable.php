<?php

/**
 * This is the model class for table "{{mainclientstable}}".
 *
 * The followings are the available columns in table '{{mainclientstable}}':
 * @property integer $id
 * @property string $id_dogovota
 * @property string $familiy
 * @property string $name
 * @property string $otchestvo
 * @property string $dateDogovora
 * @property string $agent
 * @property string $adress
 * @property string $telefon
 * @property string $dateRozhdenia
 * @property integer $dogovorStatus
 * @property string $posledniyContact
 * @property string $pozvoniti
 * @property integer $statusClient
 * @property string $commentHistory
 * @property string $dataConsultacii
 * @property string $timeConsultacii
 */
class Mainclientstable extends CActiveRecord
{
    /*
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mainclientstable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mainclientstable}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('agent, telefon', 'required'),
			array('dogovorStatus, statusClient', 'numerical', 'integerOnly'=>true),
			array('familiy, name, otchestvo, id_dogovota, adress, commentHistory, timeConsultacii, clientOplatil, clientDolzhen', 'safe'),
			array('posledniyContact, pozvoniti, dateDogovora, dataConsultacii, dateRozhdenia', 'date', 'allowEmpty'=>true, 'format'=>'yyyy-MM-dd'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_dogovota, familiy, name, otchestvo, dateDogovora, agent, adress, telefon, dateRozhdenia, dogovorStatus, posledniyContact, pozvoniti, statusClient, commentHistory, dataConsultacii, timeConsultacii', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_dogovota' => 'Номер договора',
			'familiy' => 'Фамилия',
			'name' => 'Имя',
			'otchestvo' => 'Отчество',
			'dateDogovora' => 'Дата договора',
			'agent' => 'Агент',
			'adress' => 'Адрес',
			'telefon' => 'Телефон',
			'dateRozhdenia' => 'Дата рождения',
			'dogovorStatus' => 'Заключен договор (Да/Нет)',
			'posledniyContact' => 'Дата разговора с клиентом',
			'pozvoniti' => 'Дата следующего звонка',
			'statusClient' => 'Статус клиента',
			'clientOplatil' => 'Клиент оплатил',
			'clientDolzhen' => 'Долг клиента',
			'commentHistory' => 'История клиента',
			'dataConsultacii' => 'Дата встречи с клиентом',
			'timeConsultacii' => 'Время встречи с клиентом',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_dogovota',$this->id_dogovota,true);
		$criteria->compare('familiy',$this->familiy,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('otchestvo',$this->otchestvo,true);
		$criteria->compare('dateDogovora',$this->dateDogovora,true);
		$criteria->compare('agent',$this->agent,true);
		$criteria->compare('adress',$this->adress,true);
		$criteria->compare('telefon',$this->telefon,true);
		$criteria->compare('dateRozhdenia',$this->dateRozhdenia,true);
		$criteria->compare('dogovorStatus',$this->dogovorStatus);
		$criteria->compare('posledniyContact',$this->posledniyContact,true);
		$criteria->compare('pozvoniti',$this->pozvoniti,true);
		$criteria->compare('statusClient',$this->statusClient);
		$criteria->compare('clientOplatil',$this->clientOplatil);
		$criteria->compare('clientDolzhen',$this->clientDolzhen);
		$criteria->compare('commentHistory',$this->commentHistory,true);
		$criteria->compare('dataConsultacii',$this->dataConsultacii,true);
		$criteria->compare('timeConsultacii',$this->timeConsultacii,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}