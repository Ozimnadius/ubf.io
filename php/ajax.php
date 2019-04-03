<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

header('Content-Type: application/json');

require $_SERVER['DOCUMENT_ROOT'] . '/php/PHPMailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/php/PHPMailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/php/PHPMailer/src/SMTP.php';

$data = $_POST;
$action = $data['action'];
switch ($action) {
    case 'call':
        $arr = getMailData();
        echo json_encode(array(
            'status' => mailTo($arr['addrs'], $arr['subject'], $arr['html']),
            'html' => '<div class="form__success">Спасибо мы скоро с Вами свяжемся!</div>'
        ));
        exit();
        break;
    default:
        echo json_encode(array(
            'status' => false,
        ));
        exit();
        break;
}

function getMailData()
{
    $arr = [
        'addrs' => [],
        'subject' => '',
        'html' => ''
    ];

    $arr['addrs'][] = 'info@cburus.ru';
    $arr['subject'] = 'Звонок с сайта';

    ob_start();
    ?>
    <h3><?= $arr['subject'] ?></h3>
    <table>
        <tr>
            <td>
                Имя: <?= $_POST['name'] ?>
            </td>
        </tr>
        <tr>
            <td>
                Телефон: <?= $_POST['tel'] ?>
            </td>
        </tr>
        <tr>
            <td>
                Email: <?= $_POST['email'] ?>
            </td>
        </tr>

    </table>
    <?
    $html = ob_get_contents();
    ob_end_clean();
    $arr['html'] = $html;

    return $arr;
}

function mailTo($addrs, $subject, $html, $file = [])
{

    $mail = new PHPMailer(true);
    $mail->CharSet = $mail::CHARSET_UTF8;
    try {
        //Recipients
        $mail->setFrom('info@cburus.ru', 'Web-Comp');
        foreach ($addrs as $addr) {
            $mail->addAddress($addr, 'Joe User');
        }

        //Attachments
        if (!empty($file)) {
            $mail->addAttachment($file['src'], $file['name']);
        }

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $html;

        $result = $mail->send();
        return $result;
    } catch (Exception $e) {
        die(print_r($e));
        return false;
    }
}