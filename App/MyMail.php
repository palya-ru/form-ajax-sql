<?php


namespace App;


use PHPMailer\PHPMailer\PHPMailer;

class MyMail extends Form
{

    public function __construct()
    {
        $config = (require_once __DIR__ . '/../mailConf.php')['mail'];
        $name = $this->inputValidator($this->name);
        $tel = $this->inputValidator($this->tel);
        $price = $this->inputValidator($this->prise);
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = $config['host'];
        $mail->Port = $config['port'];
        $mail->SMTPSecure = $config['SMTPSecure'];;
        $mail->SMTPAuth = true;
        $mail->Username = $config['username'];;
        $mail->Password = $config['password'];;
        $mail->setFrom($config['setFrom'], 'Куплю домен');
        $mail->addReplyTo($config['addReplyTo'], 'Куплю домен');
        $mail->addAddress($config['addAddress'], 'Имя Фамилия');
        $mail->addCC($config['addCC']);
        $mail->addBCC($config['addBCC']);
        $mail->Subject = "Куплю домен {$_SERVER['SERVER_NAME']}";
        $mail->Body = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"
       style=\"background-color: hotpink; font-family: Verdana, Geneva, sans-serif; color: white; font-size: 18px;\">
    <thead>
    <tr>
        <td style=\"padding: 14px; vertical-align: top; border-top: 1px solid #dee2e6;\"><strong>Куплю домен {$_SERVER['SERVER_NAME']}</strong></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style=\"padding: 14px; vertical-align: top; border-top: 1px solid #dee2e6;\"><strong>Имя</strong>: {$name}</td>
    </tr>
    <tr>
        <td style=\"padding: 14px; vertical-align: top; border-top: 1px solid #dee2e6;\"><strong>Телефон</strong>: {$tel}</td>
    </tr>
    <tr>
        <td style=\"padding: 14px; vertical-align: top; border-top: 1px solid #dee2e6;\"><strong>Желаемая цена</strong>: {$price}</td>
    </tr>
    </tbody>
</table>
";
        $mail->AltBody = "<p>Имя :{$name}</p><p>Телефон :{$tel}</p><p>Цена :{$price}</p>";
        $mail->setLanguage('ru', '/vendor/language/');
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            echo 'error';
            echo '<h1 class="mail">Ошибка отправки</h1>';
            $answer = 0;
        } else {
            $answer = 1;
            echo '<h1 class="mail">Письмо отправленно</h1>';
        }
        die($answer);
    }
}
