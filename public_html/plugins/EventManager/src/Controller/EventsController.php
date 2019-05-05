<?php

namespace EventManager\Controller;

use EventManager\Controller\AppController;
use Cake\ORM\TableRegistry;

//use Cake\I18n\Date;

/**
 * Events Controller
 *
 * @property \EventManager\Model\Table\EventsTable $Events
 *
 * @method \EventManager\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->OptionValues = TableRegistry::get("CatalogManager.OptionValues");
        $this->EventBookings = TableRegistry::get("EventManager.EventBookings");
        $this->EventInvites = TableRegistry::get("EventManager.EventInvites");
        $this->Evoptions = TableRegistry::get("EventManager.Evoptions");
        $this->EvoptionValues = TableRegistry::get("EventManager.EvoptionValues");
        $this->Coupons = TableRegistry::get("CouponManager.Coupons");
        $this->Auth->allow(['index', 'view', 'formSub', 'eventInvites','checkDiscountCode']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->viewBuilder()->layout('front');
        $this->paginate = [
            'contain' => ['Users', 'EventDocuments']
        ];
        $events = $this->paginate($this->Events);
        //dump($events);
        $this->set(compact('events'));
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->layout('front');
        $event = $this->Events->get($id, [
            'contain' => ['Users', 'EventBookings', 'EventDocuments', 'EventJoins', 'EventReviews', 'EventOptions' => ['Evoptions', 'EventOptionValues']]
        ]);

        if (!empty($event) && isset($event->event_options)) {
            foreach ($event->event_options as $event_option) {
                //echo dump($event_option);die;
                if (isset($event_option->evoption->option_type) && $event_option->evoption->option_type == 'select' || $event_option->evoption->option_type == 'radio' || $event_option->evoption->option_type == 'checkbox' || $event_option->evoption->option_type == 'image') {
                    //echo $event_option->option_id;die;
                    if (!isset($option_values[$event_option->evoption_id])) {
                        $option_values[$event_option->id] = $this->EvoptionValues->find("list", ['keyField' => 'id', 'valueField' => 'title'])->where(['evoption_id' => $event_option->evoption_id])->toArray();
                    }
                }
            }
        }
        $this->set(compact('event', 'option_values'));
    }

    public function formSub($event_id = null) {
        $this->autoRender = false;
        $event = $this->EventBookings->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $cardDetailsAmount = array();
            $cardDetailsAmount['eventId'] = $event_id;
            $cardDetailsAmount['amount'] = $this->request->data['amount'];
            $cardDetailsAmount['cardNum'] = $this->request->data['card_num'];
            $cardDetailsAmount['cvc'] = $this->request->data['cvc'];
            $cardDetailsAmount['expMonth'] = $this->request->data['exp_month'];
            $cardDetailsAmount['expYear'] = $this->request->data['exp_year'];

            $this->request->data['event_id'] = $event_id;
            $event = $this->EventBookings->patchEntity($event, $this->request->getData(), ['associated' => ['EventBookingOptions', 'EventBookingOptions.EventBookingOptionValues']
            ]);
            //pr($event);
            //pr($event->errors());
            //die;
            if ($this->EventBookings->save($event)) {
                $this->loadComponent('Stripe');
                $charge = $this->Stripe->payment($cardDetailsAmount);


                $eventBookingId = $event->id;
                $this->Transactions = TableRegistry::get('Transactions');
                $transactions = $this->Transactions->newEntity();
                $transactions->amount = $charge->amount;
                $transactions->payment_method = $charge->source->object;
                $transactions->transaction_status = "S";
                $transactions->transactionId = $charge->id;
                $transactionsData = $this->Transactions->save($transactions);


                $eventBookingId = $event->id;
                $this->TransactionsEventBookings = TableRegistry::get('TransactionsEventBookings');
                $transactionsEventBookings = $this->TransactionsEventBookings->newEntity();
                $transactionsEventBookings->event_booking_id = $eventBookingId;
                $transactionsEventBookings->transaction_id = $transactionsData->id;
                $this->TransactionsEventBookings->save($transactionsEventBookings);

                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'view', $event_id]);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $this->set(compact('event'));
        $this->set('_serialize', ['event']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function eventInvites($event_id = null) {
        $this->autoRender = false;
        $event = $this->EventInvites->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['event_id'] = $this->request->data['event_id'];
            $this->request->data['sessionId'] = '1212121';
            $event = $this->EventInvites->patchEntity($event, $this->request->getData());
            if ($this->EventInvites->save($event)) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        }
        exit;
    }
    
     public function checkDiscountCode() {
         $this->autoRender = false;
         if ($this->request->is('ajax')) {
             $date = date('Y-m-d');
             $OrgAmount = $this->request->data['amount'];
             $discountCode = $this->request->data['coupons'];
             $code = $this->Coupons->find()->where(['Coupons.coupon_code' => $discountCode, 'Coupons.end_date >=' =>$date,'Coupons.status' =>'1'])->first();
             if (!empty($code)) {
                 $val = $code->discount; 
                 if($code->type == 1){
                     $couponsDiscount = ($OrgAmount / 100) * $val;
                     $new_price = $OrgAmount - $couponsDiscount;
                     echo json_encode(["status" => "success","new_price"=>$new_price]);
                 }else{
                     $new_price = $OrgAmount - $val;
                     echo json_encode(["status" => "success","new_price"=>$new_price]);
                 }
             }else{
                 echo json_encode(["status" => "error"]);
             }
         }
         exit;
     }
}
