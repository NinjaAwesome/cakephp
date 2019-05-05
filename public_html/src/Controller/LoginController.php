<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Abraham\TwitterOAuth\TwitterOAuth;
use MetzWeb\Instagram\Instagram;


class LoginController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }

    public function initialize()
    {
        parent::initialize();
    }

    var $twitter_settings = [
        'oauth_access_token' => "1057669697427013633-ELZDLIpS6AUeawE4FDkYbYCfegbovb",
        'oauth_access_token_secret' => "dU7uY8K5TdXzQLKTJTebsPixtsHGT3IZsetT8gXhZFIZk",
        'consumer_key' => "dJyxSmth6v5w11BslWozMOLTG",
        'consumer_secret' => "CLRSmWo6Eo51HI6tIthNhR70vdfAwhHvUMX0CNW9IWC1Ue4ipH"
    ];

    var $instagram_settings = [
        'apiKey'      => '89a68750b0614d58b99cf47b440e7ccc',
        'apiSecret'   => 'e9d83cd7c1554755a7b249b6670bb77f',
        'apiCallback' => 'https://collabthem.com/login?provider=instagram'
    ];

    var $facebook_settings = [
        'app_id' => '398641544267629',
        'app_secret' => '0d500302cca235cd51e4d0d59b7247a9',
        'default_graph_version' => 'v2.10'
    ];

    public function index()
    {
        if ($this->Auth->user())
            return $this->redirect($this->Auth->redirectUrl());

        // instagram

        $instagram = new Instagram(array(
            'apiKey'      => $this->instagram_settings['apiKey'],
            'apiSecret'   => $this->instagram_settings['apiSecret'],
            'apiCallback' => $this->instagram_settings['apiCallback']
        ));


        if($this->request->getQuery('provider'))
        {
            $instagram_provider = $this->request->getQuery('provider') ? $this->request->getQuery('provider') : '';

            if($instagram_provider == 'instagram')
            {
                $code = $_GET['code'];
                $data = $instagram->getOAuthToken($code);

                $this->loadModel('Userssoc');
                $user_in_db = $this->Userssoc
                    ->find()
                    ->where([
                        'Userssoc.provider' => 'instagram',
                        'Userssoc.provider_id' => $data->user->id
                    ])
                    ->first();

                if (!$user_in_db) {
                    $data = ['provider_id' => $data->user->id,
                        'email' => '',
                        'provider' => 'instagram',
                        'access_token' => $data->access_token,
                        'name' => $data->user->username];

                    $usersoc = $this->Userssoc->newEntity($data);
                    if ($this->Userssoc->save($usersoc)) {
                        $data_for_auth = ['id' => $usersoc->id, 'name' => $usersoc->name, 'email' => ''];
                    }
                } else {
                    $data_for_auth = ['id' => $user_in_db->id, 'name' => $user_in_db->name];

                }

                $this->Auth->setUser($data_for_auth);

                return $this->redirect($this->Auth->redirectUrl());
            }
        }
        else
        {
            $this->set('login_url_insta', $instagram->getLoginUrl());

        }

        // facebook
        $fb = new \Facebook\Facebook([
            'app_id' => $this->facebook_settings['app_id'],
            'app_secret' => $this->facebook_settings['app_secret'],
            'default_graph_version' => $this->facebook_settings['default_graph_version'],
            //'default_access_token' => '{access-token}', // optional
        ]);

        $helper = $fb->getRedirectLoginHelper();

        if (isset($_GET['state'])) {
            $helper->getPersistentDataHandler()->set('state', $_GET['state']);
        }

        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('https://collabthem.com/login', $permissions);
        $this->set('login_url_fb', $loginUrl);



        if($this->request->getQuery('oauth_verifier'))
        {
            $oauth_access_token = $_REQUEST['oauth_token'];
            $oauth_access_token_secret = $_REQUEST['oauth_verifier'];

            $connection = new TwitterOAuth($this->twitter_settings['consumer_key'], $this->twitter_settings['consumer_secret'],
                $oauth_access_token , $oauth_access_token_secret );

            $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $oauth_access_token_secret));

            $this->loadModel('Userssoc');
            $user_in_db = $this->Userssoc
                ->find()
                ->where([
                    'Userssoc.provider' => 'twitter',
                    'Userssoc.provider_id' => $access_token['user_id']
                ])
                ->first();

            if (!$user_in_db) {
                $data = ['provider_id' => $access_token['user_id'],
                    'email' => '',
                    'provider' => 'twitter',
                    'access_token' => $access_token['oauth_token'],
                    'name' => $access_token['screen_name']];

                $usersoc = $this->Userssoc->newEntity($data);
                if ($this->Userssoc->save($usersoc)) {
                    $data_for_auth = ['id' => $usersoc->id, 'name' => $usersoc->name, 'email' => ''];
                }
            } else {
                $data_for_auth = ['id' => $user_in_db->id, 'name' => $user_in_db->name];

            }

            $this->Auth->setUser($data_for_auth);

            return $this->redirect($this->Auth->redirectUrl());

        }
        else
        {
            // Twitter
            $connection = new TwitterOAuth($this->twitter_settings['consumer_key'], $this->twitter_settings['consumer_secret'],
                $this->twitter_settings['oauth_access_token'], $this->twitter_settings['oauth_access_token_secret']);

            $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => "https://collabthem.com/login"));


            $loginUrlTw = $connection->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));
            $this->set('login_url_tw', $loginUrlTw);
        }
        //get params
        $provider = $this->request->getQuery('code') ? $this->request->getQuery('code') : null;
        if ($provider) {

            //    if ($provider == 'facebook') {
            try {
                $accessToken = $helper->getAccessToken();
            } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            $fb->setDefaultAccessToken($accessToken->getValue());
            $res = $fb->get('/me?field=email,name,first_name');
            $user = $res->getGraphUser();

            $this->loadModel('Userssoc');
            $user_in_db = $this->Userssoc
                ->find()
                ->where([
                    'Userssoc.provider' => 'facebook',
                    'Userssoc.provider_id' => $user->getId()
                ])
                ->first();

            if (!$user_in_db) {
                $data = ['provider_id' => $user->getId(),
                    'email' => $user->getEmail(),
                    'provider' => 'facebook',
                    'access_token' => $accessToken->getValue(),
                    'name' => $user->getName()];

                $usersoc = $this->Userssoc->newEntity($data);
                if ($this->Userssoc->save($usersoc)) {
                    $data_for_auth = ['id' => $usersoc->id, 'name' => $usersoc->name, 'email' => $user->getEmail(),];
                }
            } else {
                $data_for_auth = ['id' => $user_in_db->id, 'name' => $user_in_db->name];

            }

            $this->Auth->setUser($data_for_auth);

            return $this->redirect($this->Auth->redirectUrl());
            //    }
        }
    }
}