<?php
    $local_session = \Config\Services::session(); // Needed for Point 5
?>
<h1>Test_Session_View.php</h1>
<h2>1. Passed in as normal view variable : <?= $view_data; ?></h2>
<h2>2. Passed in as the Session Object : <?= $session->get('view_data'); ?></h2>
<h2>3. The Ole Fashioned SESSION Global way: <?= $_SESSION['view_data']; ?></h2>
<h2>4. The Helper Way: <?= session('view_data'); ?></h2>
<h2>5. The local instance: <?= $local_session->get('view_data'); ?></h2>
