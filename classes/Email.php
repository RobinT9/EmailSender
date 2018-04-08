<?php
namespace classes;

require 'vendor/autoload.php';
class Email
{
    private $config;

    public function __construct()
    {
        $this->config = Config::get();
    }

    /**
     * 发送推广邮件，规定html模板
     */
    public function sendSpreadEmail($objectmail)
    {
        $view = 'contents.html';
        $message = "To view the message, please use an HTML compatible email viewer! - From www.jiucool.com";
        if(self::sendEmail($objectmail,$message,$view)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 发送邮件方法
     * @param string $objectmail 目标邮箱地址
     * @param string $title 标题
     * @param string $content 内容
     */
    private function sendEmail($objectmail,$message,$view=null,$is_html=true) {
        //Create a new PHPMailer instance
        $mail = new \PHPMailer\PHPMailer\PHPMailer();
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;
        //Set the hostname of the mail server
        $mail->Host = 'smtp.qq.com';
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 465;
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        $mail->Username = $this->config['email_username'];
        //Password to use for SMTP authentication
        $mail->Password = $this->config['smtp_password'];
        $mail->SMTPSecure = "ssl";// 使用ssl协议方式</span><span style="color:#333333;">
        //Set who the message is to be sent from
        $mail->setFrom('312850391@qq.com', 'SendFrom');
        //Set an alternative reply-to address
        $mail->addReplyTo('312850391@qq.com', 'ReplyTo');
        //Set who the message is to be sent to
        $mail->addAddress($objectmail);
        //Set the subject line
        $mail->Subject = 'Title';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        if($is_html){
            $mail->msgHTML(file_get_contents($view));
        }
        //Replace the plain text body with one created manually  在邮件正文不支持HTML的备用显示
        $mail->AltBody = $message;
        //Attach an image file
        //        $mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        if (!$mail->send()) {
            //            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            //            echo 'Message sent!';
            return true;
        }
    }

}