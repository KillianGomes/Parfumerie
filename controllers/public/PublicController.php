<?php
session_start();
require './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class PublicController{

    private $pbparfm;
    private $pbcatm;
    private $pbm;

    public function __construct()
    {
        $this->pbparfm = new AdminParfumModel;
        $this->pbcatm = new AdminCategorieModel();
        $this->pbm = new PublicModel;

    }

    public function getPbParfum(){
        
        if(isset($_GET['id']) && !empty($_GET['id'])){
            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabCat = $this->pbcatm->getCategories();
                $parfs = $this->pbparfm->getParfums($search);
                require_once('./views/public/accueil.php');
            }
            $id = trim(htmlentities(addslashes($_GET['id'])));
            $p = new Parfum();
            $p->getCategorie()->setId_cat($id);
            $tabCat = $this->pbcatm->getCategories();
            $parfums = $this->pbm->findParfByCat($p);
            require_once('./views/public/parfumCat.php');
      
        }else{
            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabCat = $this->pbcatm->getCategories();
                $parfs = $this->pbparfm->getParfums($search);
                require_once('./views/public/accueil.php');
            }
            $tabCat = $this->pbcatm->getCategories();
            $parfs = $this->pbparfm->getParfums();

        require_once('./views/public/accueil.php');
        }
    }

    public function recap(){

        if(isset($_POST['envoi']) && !empty($_POST['marque']) && !empty($_POST['prix']) && $_POST['modele'] === 'Axe Black'){
            $id = htmlspecialchars(addslashes($_POST['id']));
            $marque = htmlspecialchars(addslashes($_POST['marque']));
            $modele = htmlspecialchars(addslashes($_POST['modele']));
            $image = htmlspecialchars(addslashes($_POST['image']));
            $contenance = htmlspecialchars(addslashes($_POST['contenance']));
            $prix = htmlspecialchars(addslashes($_POST['prix']));
            $nb = htmlspecialchars(addslashes($_POST['quantite']));

            require_once('./views/public/parfumItem.php');
        }
    }
    public function orderParfum(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = addslashes(htmlspecialchars($_GET['id']));
            require_once('./views/public/orderForm.php');
        }
    }

    public function payment(){

       if(isset($_POST) && !empty($_POST['email']) && !empty($_POST['quantite'])){
        \Stripe\Stripe::setApiKey('sk_test_51Id9wIItUKRFLh1HaHieMf3S9bK9c9Ja2HFG17devcqr2TyF2avvoNhgV2R71vu7gK2nPi1JKShsfJvu0sDHSler000hz8Y2eA');

        header('Content-Type: application/json');

        $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
            'currency' => 'eur',
            'unit_amount' => $_POST['prix']*100,
            'product_data' => [
                'name' => $_POST['marque']."-".$_POST['modele'],
                'images' => ["./assets/images/chanel.jpg"],
            ],
            ],
            'quantity' => $_POST['quantite'],
        ]],
        'customer_email'=> $_POST['email'],
        'mode' => 'payment',
        'success_url' => 'http://localhost/php/proc/Apps/Ecf/parfumerie/index.php?action=success',
        'cancel_url' => 'http://localhost/php/proc/Apps/Ecf/parfumerie/index.php?action=cancel',
        ]);
        $_SESSION['pay'] = $_POST;
        echo json_encode(['id' => $checkout_session->id]);
       }
    }

    public function confirmation() {
        $newStock = ((int)$_SESSION['pay']['nb']) - ((int)$_SESSION['pay']['quantite']);
        $parf = new Parfum();
        $parf->setId_p($_SESSION['pay']['id']);
        $parf->setQuantite($newStock);

        $nbLine = $this->pbm->updateStock($parf);
        if($nbLine > 0 ){
           
            //Load Composer's autoloader
            $email = $_SESSION['pay']['email'];
            $marque= $_SESSION['pay']['marque'];
            $modele= $_SESSION['pay']['modele'];
            $contenance= $_SESSION['pay']['contenance'];
            $prix= $_SESSION['pay']['prix'];
            

            //Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'killiang94@outlook.fr';                     //SMTP username
                $mail->Password   = 'Portugal94';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('killiang94@outlook.fr', 'BUYCAR');
                $mail->addAddress("$email", 'Mr/Mme');     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = "
                    <h2>Confirmation d'achat</h2>
                    <div>
                     <b>Marque:  </b>".$marque." 
                     <b>Modéle:  </b>".$modele." 
                     <b>Contenance:  </b>".$contenance." 
                     <b>Prix:  </b>".$prix." 
                     <p>Nous vous remercions pour votre achat.</p>
                    </div>
                ";
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        require_once('./views/public/succes.php');
    }

    public function annuler() {
       require_once('./views/public/cancel.php');
    }


}