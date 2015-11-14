<?php

class MainclientstableController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create', 'createcart', 'update', 'view', 'ajax', 'AllCart', 'uploadFileImg', 'deleteImgFiles', 'fullHistoryClient', 'viewCartsToOtherDate'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Mainclientstable;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mainclientstable']))
		{
			$model->attributes=$_POST['Mainclientstable'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateCart()
	{
		$model=new Mainclientstable;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        if($model->dogovorStatus ==''){
            $model->dogovorStatus = 0;
        }

		if(isset($_POST['Mainclientstable']))
		{
			$model->attributes=$_POST['Mainclientstable'];
			
			if($model->name==''){
				$model->name = "Нет имени";
			}
			
			if($model->save())
				$this->redirect(array('index'));
		}

		//$this->render('createcart',array(
		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $imgModel = Imgsclient::model()->findAllBySql('SELECT * FROM {{imgsclient}} WHERE id_client = :id ORDER BY time ASC', array(':id'=>$id));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Mainclientstable']))
		{
			$model->attributes=$_POST['Mainclientstable'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model, 'imgModel'=>$imgModel,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$upload_dir = dirname(Yii::app()->basePath).'/images/blockdatas/'.$id.'/';
		
		//Запрос к бд? получить имена файлов
        $model = Imgsclient::model()->findAllBySql("SELECT id_client, img_name FROM {{imgsclient}} WHERE id_client =:id ORDER BY img_name ASC", array(':id'=>$id));
        foreach($model as $imgName){
            // Удаляем все файлы из папки
            if($imgName->img_name){
                unlink($upload_dir.$imgName->img_name);
            }
        }
        if(is_dir($upload_dir)){rmdir($upload_dir);}
		
		//Удаляем данные из таблицы картинок
		$connection=Yii::app()->db;
		$sql='DELETE FROM {{imgsclient}} WHERE id_client=:client_id';
		$command=$connection->createCommand($sql);
		$command->bindParam(":client_id", $id, PDO::PARAM_STR);
		$command->execute();
		

		
		// Удаляем запись с основной таблицы
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('allcart'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
			$cartsToDate = (isset($_GET["cartsDate"])) ? $_GET["cartsDate"] : date('Y-m-d') ;
            // Выборка для рабочих клиентов
            $criteria = new CDbCriteria();
            $criteria->condition = "pozvoniti=:dateSelect AND dogovorStatus = 1 AND statusClient != 11 OR dataConsultacii=:dateSelect  AND dogovorStatus = 1  AND statusClient != 11";
            $criteria->params = array(':dateSelect'=>$cartsToDate);
            $criteria->order = 'familiy ASC';

            $dataProvider=new CActiveDataProvider('Mainclientstable', array(
                'criteria'=>$criteria,
            ));
			//var_dump($dataProvider);
            // Выборка для потенциальных клиентов
            $criteriaPoten = new CDbCriteria();
            $criteriaPoten->condition = "pozvoniti=:dateSelect AND dogovorStatus = 0 AND statusClient != 11 OR dataConsultacii=:dateSelect  AND dogovorStatus = 0 AND statusClient != 11 ";
            $criteriaPoten->params = array(':dateSelect'=>$cartsToDate);
            $criteriaPoten->order = 'familiy ASC';
            $dataProviderPoten=new CActiveDataProvider('Mainclientstable', array(
                'criteria'=>$criteriaPoten,
            ));
            // Выборка для агентов
            $criteriaAgent = new CDbCriteria();
            $criteriaAgent->condition = "pozvoniti=:dateSelect AND statusClient = 11 OR dataConsultacii=:dateSelect  AND statusClient = 11";
            $criteriaAgent->params = array(':dateSelect'=>$cartsToDate);
            $criteriaAgent->order = 'familiy ASC';
            $dataProviderAgent=new CActiveDataProvider('Mainclientstable', array(
                'criteria'=>$criteriaAgent,
            ));

            $this->render('index',array(
                'dataProvider'=>$dataProvider, 'dataProviderPoten'=>$dataProviderPoten, 'dataProviderAgent'=>$dataProviderAgent, 'dateClick'=>$cartsToDate
            ));

	}
	
	public function actionViewCartsToOtherDate()
	{
		$html = '';
		$cartsToDate = $_POST['dateClick']; //вытаскиваем переменную из запроса
		if($cartsToDate!== null){
			//Ищем карточки клиентов на выбранную дату
			$criteria = new CDbCriteria();
            $criteria->condition = "pozvoniti=:dateSelect AND dogovorStatus = 1  OR dataConsultacii=:dateSelect  AND dogovorStatus = 1";
			$criteria->params = array(':dateSelect'=>$cartsToDate);
            $criteria->order = 'familiy ASC';
			$dataProvider=new CActiveDataProvider('Mainclientstable', array(
				'criteria'=>$criteria,
			));
			$html = $this->renderPartial('_viewCartsToDate', array('dataProvider'=>$dataProvider, 'dateClick'=>$cartsToDate));
			
			//Ищем карточки потенциальных клиентов на выбранную дату
			// Выборка для потенциальных клиентов
            $criteriaPoten = new CDbCriteria();
            $criteriaPoten->condition = "pozvoniti=:dateSelect AND dogovorStatus = 0  OR dataConsultacii=:dateSelect  AND dogovorStatus = 0";
            $criteriaPoten->params = array(':dateSelect'=>$cartsToDate);
			$criteriaPoten->order = 'familiy ASC';
            $dataProviderPoten=new CActiveDataProvider('Mainclientstable', array(
                'criteria'=>$criteriaPoten,
            ));
			
			$html .= $this->renderPartial('_viewCartsPotenToDate', array('dataProviderPoten'=>$dataProviderPoten, 'dateClick'=>$cartsToDate));
		}
		if (Yii::app()->request->isAjaxRequest) {
			echo $html;
			Yii::app()->end();
		}else
			$this->redirect(array('index'));
	}
	
	/*
	*	страница всех карточек
	*/
	
	public function actionAllCart(){
		// Выборка для рабочих клиентов
		$criteria = new CDbCriteria();
		
		

		if(isset($_GET['sort'])){
			switch ($_GET['sort']){
				case '1':
					$criteria->condition = "dogovorStatus = 1";
					break;
				case '2':
					$criteria->condition = "dogovorStatus = 0";
					break;
				case '3':
					$criteria->condition = "statusClient = 2";
					break;
				case '4':
					$criteria->condition = "statusClient = 3";
					break;
				case '5':
					$criteria->condition = "statusClient = 4";
					break;
				case '6':
					$criteria->condition = "statusClient = 5";
					break;
				case '7':
					$criteria->condition = "statusClient = 6";
					break;
				case '8':
					$criteria->condition = "statusClient = 7";
					break;
				case '9':
					$criteria->condition = "statusClient = 8";
					break;
				case '10':
					$criteria->condition = "statusClient = 9";
					break;
                                case '11':
					$criteria->condition = "statusClient = 10";
					break;
                                case '12':
					$criteria->condition = "statusClient = 11";
					break;
					
					
				default:
					break;
			}
			
		}
                
		$criteria->order = 'pozvoniti DESC';
		
                
		$dataProvider=new CActiveDataProvider('Mainclientstable', array(
			'criteria'=>$criteria,
		));
                
		
		$this->render('allcart',array(
			'dataProvider'=>$dataProvider, $sort => $_POST['sort']
		));
	}

    /**
     *  Test Ajax function
     */
    public function actionAjax()
    {
        $input = $_POST['search3'];
        // для примера будем приводить строку к верхнему регистру


        // если запрос асинхронный, то нам нужно отдать только данные
        if(Yii::app()->request->isAjaxRequest and iconv_strlen($input)>1){

            $criteria=new CDbCriteria;
            $criteria->condition='telefon LIKE :input OR name LIKE :input OR familiy like :input';
            $criteria->params=array(':input'=>'%'.$input.'%');
            $model = Mainclientstable::model()->findAll($criteria);

            foreach($model as $ss){
                echo '<a class="link_find" href="'.Yii::app()->request->baseUrl.'/index.php?r=mainclientstable/update&id='.$ss->id .'">'.$ss->familiy .' '.$ss->name ."</a> тел. " .$ss->telefon .'<br>';
            }
            if(!$ss->name || !$ss->telefon)
                echo "Данных нет";

        }
        else {
            // если запрос не асинхронный, отдаём форму полностью
            echo "Введите данные";

        }
    }


    /**
     * Get full history client. Ajax
     */

    public function actionFullHistoryClient()
    {
        $idClient = $_POST['idClient'];

        // если запрос асинхронный, то нам нужно отдать только данные
        if(Yii::app()->request->isAjaxRequest){


            $criteria=new CDbCriteria;
            $criteria->select = 'id, familiy, name, commentHistory';
            $criteria->condition='id=:idClient';
            $criteria->params=array(':idClient'=>$idClient);
            $post = Mainclientstable::model()->find($criteria);

            echo "<div class='clientNameFamily'><div class='clientName'><b>".$post->name."</b></div>";
            echo "<div class='clientFamily'><b>&nbsp;".$post->familiy."</b></div></div>";
            echo "<div><b>История клиента</b></div>";
            echo "<div class='clientHistory'><div class='scrollHistory'>".nl2br($post->commentHistory)."</div></div>";

            if(!$post->commentHistory){
                echo "Истории по клиенту нет.";
            }

        }



    }

    public function actionUploadFileImg()
    {

        if($imgClient = $_FILES['img'] and Yii::app()->request->isAjaxRequest){

            preg_match_all('([0-9]+)', $_POST['id'], $match);
            $idClient = $match[0][0];
            $name_doc =  reset(explode(".", $imgClient['name']));// Сохраняем родное имя файла

                if($imgClient['size'] > (5 * 1024 * 1024)) die('Размер файла не должен превышать 5Мб');
                $imageinfo = getimagesize($imgClient['tmp_name']);
                $arr = array('image/gif', 'image/gif', 'image/jpeg', 'image/png');
                if(!array_search($imageinfo['mime'],$arr)){
                    unlink($imgClient['tmp_name']);
                    echo ('Картинка должна быть формата JPG, GIF или PNG');
                }else {
                    $upload_dir = dirname(Yii::app()->basePath).'/images/blockdatas/'.$idClient.'/'; //имя папки с картинками
                    $name = md5($imgClient['name']).date('YmdHis').'.'.end(explode(".", $imgClient['name']));
                    //  Необходимо проверить наличие каталога для пользователя и затем если его нет,
                    //  создать каталог с номером пользователя
                    if(!file_exists($upload_dir)){mkdir($upload_dir, 0777);}
                    // Затем переместить туда файл. Если каталог уже есть, то просто переместить туда файл
                    $mov = move_uploaded_file($imgClient['tmp_name'],$upload_dir.$name);
                    if($mov) {
                        //Сохраняем данные о файле в БД
                        $connection=Yii::app()->db;
                        $sql='INSERT INTO {{imgsclient}} (id_client, time, img_name, name_doc) VALUES (:id, :time, :imgname, :name_doc)';
                        $command=$connection->createCommand($sql);
                        $command->bindParam(":id", $_POST['id'], PDO::PARAM_STR);
                        $command->bindParam(":time", date('YmdHis'), PDO::PARAM_STR);
                        $command->bindParam(":imgname", $name, PDO::PARAM_STR);
                        $command->bindParam(":name_doc", $name_doc, PDO::PARAM_STR);
                        $command->execute();
                    }
                    echo '<div class="img_block"><img src="' .Yii::app()->baseUrl .'/images/icons/icon_img_file_client.png" title="'.$name_doc.'" second="/images/blockdatas/'.$idClient.'/'.$name.'"><div class="img_name"><a class="lightImg" href="'.Yii::app()->baseUrl.'/images/blockdatas/'.$idClient.'/'.$name.'" data-lightbox="'.substr($name, 0, -4).'" target="_blank">'.substr($name_doc, 0, 28) .'</a></div><div class="img_delete"><a href="#" onclick="deleteFile(\''.$name.'\')"><img src="' .Yii::app()->baseUrl .'/images/icons/img_delete.png"></div></div>';
                }
        }
        else
            echo "Файл не загружен";



    }

    public function actionDeleteImgFiles()
    {
        $idClient = $_POST['id_client'];
        $upload_dir = dirname(Yii::app()->basePath).'/images/blockdatas/'.$idClient.'/';

        if(Yii::app()->request->isAjaxRequest && isset($_POST['id_img'])){
            //Удаляем запись из базы
            $connection=Yii::app()->db;
            $sql='DELETE FROM {{imgsclient}} WHERE img_name=:imgname';
            $command=$connection->createCommand($sql);
            $command->bindParam(":imgname", $_POST['id_img'], PDO::PARAM_STR);
            $command->execute();
            echo $_POST['id_img'] ." Удаление - OK";
            // Удаляем файл с диска

            unlink($upload_dir.$_POST['id_img']);
        }
    }


    /**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Mainclientstable('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mainclientstable']))
			$model->attributes=$_GET['Mainclientstable'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Mainclientstable the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Mainclientstable::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Данная страница отсутсвует');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Mainclientstable $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mainclientstable-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
