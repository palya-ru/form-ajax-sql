<?php


namespace App;

use App\Db;
class Form extends Db
{
    public function go()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($errorsMessage = $this->validForm()){
                $this->showErrors($errorsMessage);
            } else{
                $values = array(
                    'name' => $this->inputValidator($this->name),
                    'domen' => $_SERVER['SERVER_NAME'],
                    'tel' => $this->inputValidator($this->tel),
                    'prise' => $this->inputValidator($this->prise)
                );
                $query = $this->fluent->insertInto($this->database, $values)->execute();
                $this->text_mail();
                new MyMail();
                //header('Location: /');
                //exit;
            }
        }
    }

    /**
     * @return array
     * на случай отказа от ajax
     */
    protected function validForm()
    {
        $errors = [];
        if(strlen($_POST['firstName']) !== 0){
            $errors[] = 'ЕRROR';
        }
        if(trim(strlen($_POST['name']) === 0 )){
            $errors[] = 'Заполните поле имя';
        }
        if(trim(strlen($_POST['tel']) === 0)){
            $errors[] = 'Заполните поле имя';
        }
        if(trim(strlen($_POST['prise']) === 0)){
            $errors[] = 'Заполните поле желаемая цена';
        }
         return $errors;
    }

    protected function showErrors($errors)
    {
        foreach ($errors as $key){
            if($key === 'ЕRROR'){
                continue;
            }
            echo '<p>'.$key.'</p>';
        }
    }

    protected function inputValidator($value, $width = 50)
    {
        return mb_substr(trim(filter_input(0,$value,513)),0, $width);
    }

    protected function text_mail()
    {
        $tex = "========== " . date("Y-m-d H:i:s") ." ==========\n" .
            "Домен " . $_SERVER['SERVER_NAME'] . "\n" .
            "Имя " . $this->inputValidator($this->name) . "\n"
            . "Телефон ". $this->inputValidator($this->tel) . "\n" .
            'Желаемая цена ' . $this->inputValidator($this->prise) . "\n";
        $line = fopen(__DIR__ . '/../text.txt','a+');
        fwrite($line,  $tex);
        fclose($line);
    }
}
