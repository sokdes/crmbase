<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 01.01.14
 * Time: 11:48
 */
class CalendarController extends Controller
{
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

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array(''),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('index'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array(''),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex(){

        // проверяем передали ли нам месяц и год
        if(isset($_GET["ym"])){

            $year  = (int)substr($_GET["ym"], 0, 4);
            $month = (int)substr($_GET["ym"], 4, 2);
            $copyMonth = $month; // Копируем исходное значение месяца для ссылки, в блоке comment_day
            //$dayEnd = date("t", );
        }
        else{ // иначе выводить текущие месяц и год

            $month = date("m", mktime(0,0,0,date('m'),1,date('Y')));
            $year  = date("Y", mktime(0,0,0,date('m'),1,date('Y')));
            $copyMonth = $month; // Копируем исходное значение месяца для ссылки, в блоке comment_day
            $month *=1;// делаем формат даты месяца без 0 в переди
        }



        $skip = date("w", mktime(0,0,0,$month,1,$year)) - 1; // узнаем номер дня недели
        if($skip < 0){
            $skip = 6;
        }
        $daysInMonth   = date("t", mktime(0,0,0,$month,1,$year));       // узнаем число дней в месяце

        $vstrechi = array();  // Переменные содержат массив даты звонков и встреч
        $zvonki = array();

        //Запрос к бд , взять встречи и звонки с клиентами
        $model = Mainclientstable::model()->findAllBySql("SELECT * FROM {{mainclientstable}}  WHERE DATE_FORMAT(pozvoniti, '%Y-%c') = '".$year."-".$month."' OR DATE_FORMAT(dataConsultacii, '%Y-%c') = '".$year."-".$month."'");
        $s = 1; // Встреча по счету
        $s2 = 1; // Звонок по счету

        foreach($model as $client){

            if(substr($client->dataConsultacii, 5,2)==$month){
                $date_vstr = substr($client->dataConsultacii, 8);
                //$dd[] = $date_vstr;
                $date_vstr = $date_vstr * 1;
                $vstrechi[$date_vstr][$s] = array('id'=>$client->id, 'name'=>$client->name);
                $s++;

            }
            if(substr($client->pozvoniti, 5,2)==$month){
                $date_zvonka = substr($client->pozvoniti, 8);
                $dd2[] = $client->pozvoniti;
                $date_zvonka = $date_zvonka * 1;
                $zvonki[$date_zvonka][$s2] = array('id'=>$client->id, 'name'=>$client->name);
                $s2++;

            }

        }
        asort($vstrechi); // Сортируем массивы дат по возрастанию
        asort($zvonki);

       /* echo "Vstrechi: ";
        var_dump($dd);
        echo '<br>';
        var_dump($vstrechi);
        echo 'Zvonki: ';
        var_dump($dd2);
        echo "<br>";
        var_dump($zvonki);
        */

        $calendar_head = '';    // обнуляем calendar
        $calendar_body = '';    // обнуляем calendar body
        $day = 1;       // для цикла далее будем увеличивать значение

        for($i = 0; $i < 6; $i++){ // Внешний цикл для недель 6 с неполыми

            $calendar_body .= '<tr>';       // открываем тэг строки
            for($j = 0; $j < 7; $j++){      // Внутренний цикл для дней недели


                if($zvonki[$day] || $vstrechi[$day]){
                    $block_note = '<div class="comment_day">';
                    $copyDay = ($day<10) ? '0'.$day : $day;
                    if($zvonki[$day]){
                        $block_note .= '<b><a href="'.Yii::app()->request->baseUrl.'/index.php?r=mainclientstable/index&cartsDate='.$year.'-'.$copyMonth.'-'.$copyDay.'">Звонков: </b>'.count($zvonki[$day]) .'</a><br>';
                    }
                    if($vstrechi[$day]){
                        $block_note .= '<b><a href="'.Yii::app()->request->baseUrl.'/index.php?r=mainclientstable/index&cartsDate='.$year.'-'.$copyMonth.'-'.$copyDay.'">Встреч: </b>'.count($vstrechi[$day]).'</a>';
                    }
                    $block_note .= '</div>';
                }


                if(($skip > 0)or($day > $daysInMonth)){ // выводим пустые ячейки до 1 го дня ип после полного количства дней

                    $calendar_body .= '<td class="none"> </td>';
                    $skip--;

                }
                else{

                    if($j == 6)     // если воскресенье то омечаем выходной

                        if($zvonki[$day]){
                            $calendar_body .= '<td class="holiday zvonki">'.$day.'<br>'.$block_note.'</td>';
                        }
                        else if($vstrechi[$day]){
                            $calendar_body .= '<td class="holiday vstrechi">'.$day.'<br>'.$block_note.'</td>';
                        }
                        else{ // Пустой день
                            $calendar_body .= '<td class="holiday">'.$day.'</td>';
                        }


                    else{   // в противном случае просто выводим день в ячейке
                        if ((date(j)==$day)&&(date(m)==$month)&&(date(Y)==$year)){//проверяем на текущий день
                            //День сегодняшний
                            if($zvonki[$day] || $vstrechi){
                                $calendar_body .= '<td class="today zvonki">'.$day.'<br>'.$block_note.'</td>';
                            }
                            else if($vstrechi[$day]){
                                $calendar_body .= '<td class="today vstrechi">'.$day.'<br>'.$block_note.'</td>';
                            }else{
                                $calendar_body .= '<td class="today">'.$day .'</td>';
                            }

                        }
                        else{ // День другой
                            if($zvonki[$day]){
                                $calendar_body .= '<td class="day zvonki">'.$day.'<br>'.$block_note.'</td>';
                            }
                            else if($vstrechi[$day]){
                                $calendar_body .= '<td class="day vstrechi">'.$day.'<br>'.$block_note.'</td>';
                            }
                            else{ // Пустой день
                                $calendar_body .= '<td class="day">'.$day.'</td>';
                            }
                        }
                    }
                    $day++; // увеличиваем $day
                }

            }
            $calendar_body .= '</tr>'; // закрываем тэг строки
        }
        $trans = array("January" => "ЯНВАРЬ",
            "February" => "ФЕВРАЛЬ",
            "March" => "МАРТ",
            "April" => "АПРЕЛЬ",
            "May" => "МАЙ",
            "June" => "ИЮНЬ",
            "July" => "ИЮЛЬ",
            "August" => "АВГУСТ",
            "September" => "СЕНТЯБРЬ",
            "October" => "ОКТЯБРЬ",
            "November" => "НОЯБРЬ",
            "December" => "ДЕКАБРЬ"
        );
        $month_name = date("F", mktime(0,0,0,$month,1,$year));
        $rus_month_name = strtr($month_name, $trans);
        // заголовок календаря
        $calendar_head = '<tr class="headerTopCalAll">'
                        .'<th colspan="1"><a href="index.php?r=calendar/index&ym='.date("Ym", mktime(0,0,0,$month-1,1,$year)).'">« Пред</a></th>'
                        .'<th colspan="5">'.strtr($month_name, $trans).' '.date("Y", mktime(0,0,0,$month,1,$year)).'</th>'
                        .'<th colspan="1"><a href="index.php?r=calendar/index&ym='.date("Ym", mktime(0,0,0,$month+1,1,$year)).'">След »</a></th>'
                        .'</tr><tr>'
                        .'<th class="headerBottom">Понедельник</th>'
                        .'<th class="headerBottom">Вторник</th>'
                        .'<th class="headerBottom">Среда</th>'
                        .'<th class="headerBottom">Четверг</th>'
                        .'<th class="headerBottom">Пятница</th>'
                        .'<th class="headerBottom">Суббота</th>'
                        .'<th class="headerBottom">Воскресенье</th>'
                      .'</tr>';



        $this->render('index',array(
            'calendar_body'=>$calendar_body, 'calendar_head'=>$calendar_head,
        ));
    }

}