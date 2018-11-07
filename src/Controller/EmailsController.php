<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class EmailsController extends AppController{

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['notifyAll', 'updateRequest'])) {
             return true;
        }
    }

    public function notifyAll(){
        //Identifiant du nouveau stage en URL
        $id = $this->request->getQuery('id');

        //Obtenir les adresses emails de tous les étudiants en Query
        $query = TableRegistry::get('Students')->find();

        //Création du lien envoyé par courriel:
        $link = "http://". $_SERVER['HTTP_HOST'].$this->request->getAttribute("webroot")."internships/view/" . $id;

        //Création du titre du message envoyé par courriel:
        $titre = 'Stage 123.ca - Ajout d\'un nouveau stage';

        //Création du message envoyé par courriel:
        $message = 'Un nouveau stage a été ajouté, accédez à ce lien pour voir le stage: ' . $link;


        //Envoyer un courriel à chaque étudiant sur la plateforme:
        foreach ($query as $student) {
            $email = new Email();
            $emailaddress = $student->email;

            if ($emailaddress){
                $email->setTo($emailaddress)->setSubject($titre)->send($message);
            }
        }

        return $this->redirect(['controller' => 'internships', 'action' => 'index']);
    }

}
?>