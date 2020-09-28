<?php

require('src/LassoLead.php');
require('src/RegistrantSubmitter.php');

/* These variables should only be attached on the server side
 * and should not be hidden fields on the registration form
 * Note that $apiKey is where the Lasso UID is placed.
 */
$clientId  = '1111';
$apiKey = 'X1X1X';

if (empty($clientId) || empty($_REQUEST['ProjectID']) || empty($apiKey)){
	throw new Exception('Required parameters are not set, please
			     check that your $clientId, $projectId and $apiKey are
			     configured correctly');
}
 
/* Constructing and submitting a lead:
 * Map form fields to the lead object and submit
 */
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

$lead->addAddress(
	$_REQUEST['Address'],
	$_REQUEST['City'],
	$_REQUEST['Province'],
	$_REQUEST['PostalCode'],
	$_REQUEST['Country']
);

$lead->setNameTitle($_REQUEST['NameTitle']);

$lead->setCompany($_REQUEST['Company']);

$lead->addNote($_REQUEST['Comments']);

$lead->setRating('N');

$lead->setSourceType('Online Registration');

$lead->setSecondarySourceType('Sample Registration Form');

$lead->setFollowUpProcess('30 Day Follow-up');

$lead->setRotationId('Online');

/* Questions (select answer)
 *
 * For any number of questions on the form where answers are selected
 */
foreach($_REQUEST['Questions'] as $questionId => $value){
	 $lead->answerQuestionById($questionId, $value);
}

/* Questions (text answer)
 *
 * Only for questions that require text input answers
 * $lead->answerQuestionByIdForText($questionId,$_REQUEST['Questions'][$questionId]);
 */
$lead->answerQuestionByIdForText(80564,$_REQUEST['Questions'][80564]);

/* Auto-reply Email
 *
 * The signupEmailLink needs to be submitted with signupEmailSubject
 * $lead->signupEmailLink = 'url';
 * $lead->signupEmailSubject = 'subject';
 */
$lead->signupEmailLink = 'http://www.bestbuilderhomes.com/BestBuilder-ThankYou-Email.html';
$lead->signupEmailSubject = 'Thank you for registering at [@PROJECT_NAME]';

/* Website Tracking
 *
 * Value for $domainAccountId can be found in the tracking code provided by Lasso
 * Value for $guid can be obtained using the GUID Generator
 * $lead->setWebsiteTracking ($domainAccountId, $guid);
 */
$lead->setWebsiteTracking('LAS-000000-01', $_REQUEST['guid']);

$lead->sendAssignmentNotification();

$submitter = new RegistrantSubmitter();
$curl      = $submitter->submit('https://api.lassocrm.com/registrants', $lead, $apiKey);
