<?php

namespace app\models;

use Yii;
use app\models\Card;

// функция преобразования заголовков в верную кодировку 
function mime_header_encode($str, $data_charset, $send_charset) { 
    if ($data_charset != $send_charset)
        $str = iconv($data_charset, $send_charset . '//IGNORE', $str);
    return ('=?' . $send_charset . '?B?' . base64_encode($str) . '?=');
}

class TEmail {
    public $from_email;
    public $from_name;
    public $to_email;
    public $to_name;
    public $subject;
    public $data_charset = 'UTF-8';
    public $send_charset = 'windows-1251';
    public $body = '';
    public $type = 'text/html';

    function send() {
        $dc = $this->data_charset;
        $sc = $this->send_charset;
        $enc_to = mime_header_encode($this->to_name, $dc, $sc) . ' <' . $this->to_email . '>';
        $enc_subject = mime_header_encode($this->subject, $dc, $sc);
        $enc_from = mime_header_encode($this->from_name, $dc, $sc) . ' <' . $this->from_email . '>';
        $enc_body = $dc == $sc ? $this->body : iconv($dc, $sc . '//IGNORE', $this->body);
        $headers = '';
        $headers .= "Mime-Version: 1.0\r\n";
        $headers .= "Content-type: " . $this->type . "; charset=" . $sc . "\r\n";
        $headers .= "From: " . $enc_from . "\r\n";
        return mail($enc_to, $enc_subject, $enc_body, $headers);
    }

    
    public function setMessage() {
        $body = '';
        
        $fields = array(
            'card_id' => 'Номер карты клиента',
            'fio' => 'ФИО клиента',
            
            'phone' => 'Телефон',
            'letter_text' => 'Текст сообщения',
            
            'why' => 'Причина заморозки',
        );
        
        $tbody = '';
        
        $postData = $_POST;
        
        $card = Card::find()->where(['card_id' => Yii::$app->user->identity->card_id])->one();
        
        $postData['fio'] = $card->fio;
        $postData['card_id'] = $card->card_id;
        
        foreach ($fields as $field => $label) {
            if (isset($postData[$field])) {
                // если отправляем клиенту - не будем ему показывать его имя
                /*if ($this->to_email == $postData['email']) {
                    if (
                        $field == 'name' || $field == 'phone'
                        || $field == 'email'
                        || $field == 'want'
                        )
                        continue;
                }*/
                
                $tbody .= '<tr>
                         <td align="left"><span style="font-size:12px">' . $label . ': </span>&nbsp;&nbsp;' . $postData[$field] . '</td>
                </tr>';
            }
        }

        $a = 1;
        $this->body = 
            '<table border="0" width="80%" align="center">
                <tr>
                        <td align="left"><span style="font-size:14px;text-decoration:underline;font-weight:bold;">' . $this->subject . '<br/></td>
                </tr>'
                . $tbody
                . '
            </table>';
    }
}
