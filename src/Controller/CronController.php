<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Mailer\Email;
/**
 * Cron Controller
 *
 *
 * @method \App\Model\Entity\Cron[] paginate($object = null, array $settings = [])
 */
class CronController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow();
        $this->loadModel('Internship_Environments');
        $this->loadModel('Employers');
    }
    public function index()
    {
        $cron = $this->Internship_Environments->find('all',['conditions'=>['must_update' => 1]]);
        foreach ($cron as $key => $value) {
            //Création du lien envoyé par courriel:
            $id = $value->id;
            $link = "http://". $_SERVER['HTTP_HOST'].$this->request->getAttribute("webroot")."internship-environments/edit/" . $id;
            $empID = $value->employer_id;
            $emp = $this->Internship_Environments->Employers->find($empID)->first();
            $empEmail = $emp['email'];
            $email = new Email('default');
            $email->setTo($empEmail)
                ->setSubject('Avis de mise à jour d\'information de stage')
                ->send('Votre environnemment de stage doit être mis-à-jour à ce lien: ' . $link);
        }
        $this->set(compact('cron'));
        $this->set('_serialize', ['cron']);
    }
}