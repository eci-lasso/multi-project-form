<?php

require('src/LassoLead.php');
require('src/RegistrantSubmitter.php');

$clientId  = '1111';
$apiKey = '1x1x1';

if (empty($clientId) || empty($_REQUEST['ProjectID']) || empty($apiKey)){
  throw new Exception('Required parameters are not set, please check that
                        your $clientId, $projectId and $apiKey are
                        configured correctly');
}

$lead = new LassoLead(
  $_REQUEST['FirstName'],
  $_REQUEST['LastName'],
  $_REQUEST['ProjectID'][0],
  $clientId
);

/* Projects
 * 
 * For a single form to submit to multiple selected projects
 */
foreach($_REQUEST['ProjectID'] as $index => $projectId){
  if ($index == 0){
    continue;
  }
  $lead->addProject($projectId);
}

$lead->addPhone($_REQUEST['Phone']);

$lead->addEmail($_REQUEST['Email']);

$lead->signupEmailLink = 'http://www.website.com/thankyou-email.html';
$lead->signupEmailSubject = 'Thank you for registering at [@PROJECT_NAME]';

$lead->sendAssignmentNotification();

$submitter = new RegistrantSubmitter();
$curl      = $submitter->submit('https://api.lassocrm.com/registrants', $lead, $apiKey);
