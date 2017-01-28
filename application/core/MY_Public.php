<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Public extends CI_Controller {         
    
    public function __construct() {            
        parent::__construct();        
    }
    
    public function cerrarSesion() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('usuario');
        $this->session->sess_destroy();
    }
    
    public function creaSesion($id, $usuario) {
        $md5_caracter = md5($usuario);
        $this->session->set_userdata('verifi', 'wiza' . $md5_caracter);
        $this->session->set_userdata('id', $id);
        $this->session->set_userdata('usuario', $usuario);
    }  
    
    public function enviarMail($datos) {
        // Composer Autoloader
        require_once FCPATH . 'vendor/autoload.php';
        
        $mail = new PHPMailer(true);       
        $mail->isSMTP();
        $mail->SMTPDebug = 2;                           // Enable verbose debug output
        
        try {
            // Set mailer to use SMTP
            //$mail->Host = 'ssl://smtp.gmail.com:465';       // Specify main and backup SMTP servers
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;                         // Enable SMTP authentication
            $mail->Username = '';       // SMTP username
            $mail->Password = '';             // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;
            
            /*$mail->SMTPSecure = 'ssl';     
            $mail->Port = 465;
                                                // TCP port to connect to        
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );*/            
            
            $mail->setFrom('wizakorweb@gmail.com', 'Klarenz');
            $mail->addAddress($datos['email'], $datos['nombre']);     // Add a recipient
            //$mail->addAddress('doriangonzalez@klarenzcommunication.com');               // Name is optional
            //$mail->addReplyTo('wizakorweb@gmail.com', 'Klarenz S.L');            
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Correo de Confirmacion';
            $mail->Body = '<h3>BIENVENIDO KLARENZ</h3>'
                    . 'COMENTARIO.'
                    . '<hr>'                
                    . '<br>NOMBRE: ' . $datos['nombre']
                    . '<br>USUARIO: ' . $datos['acronimo']
                    . '<br>CORREO: ' . $datos['email']
                    . '<br>ENLACE CONFIRMACION:'.' <a href="' . site_url('autenticacion/validar_url/').$datos['confirmar_url'].'" target="_blank">Confirmacion</a>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';            
                        
            if (!$mail->send()) {
                return FALSE;
                //echo 'Message could not be sent.';
                //echo 'IIIII<br><br><br>Mailer Error: ' . $mail->ErrorInfo;
            } else {
                return TRUE;
                //echo 'IIIMessage has been sent';
            }
            
        }catch (phpmailerException $e) {
            return FALSE;
            //echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            return FALSE;
            //echo $e->getMessage(); //Boring error messages from anything else!
        }
    }        
}
