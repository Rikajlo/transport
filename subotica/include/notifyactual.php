<?php

include_once('notify.php');

$oneSignalConfig = array(
    'app_id' => '76989cdc-dba6-4b47-ae6e-5c036549d35f', // replace with your app_id
    'app_rest_api_key' => 'OTVmODljNDctYjgzYS00N2E3LTk3ZTEtNmZhZjVhMDBiZTdi', // replace with your app_rest_api_key
    'title' => 'Testing the OneSignal Push',
    'brief' => 'Write your brief or summary content here. This will be shown below the title.',
    'url' => 'http://chocolatefor.me/transport/subotica/news.php', // URL of the page/post that you're pushing for
    'image_url' => 'http://www.gradsubotica.co.rs/wp-content/uploads/2015/07/suboticatrans.jpg',
    'logo_url' => 'http://www.gradsubotica.co.rs/wp-content/uploads/2015/07/suboticatrans.jpg', // logo of the company/website
);

// now do the call
osAddPush($oneSignalConfig);