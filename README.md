<h1>Multi-project Submission</h1>

<p>Define a required question field with checkbox or multi-select drop-down menu answer options in <a href="https://github.com/eci-lasso/multi-project-form/blob/master/signup.html">signup.html</a> and set the following attributes for each answer <code>input</code> tag:
<ul>
<li><code>name="ProjectID[]"</code></li>
<li><code>value="$projectID"</code></li>
</ul>


<p>The following fields will need to be updated in <a href="https://github.com/eci-lasso/multi-project-form/blob/master/signup.php" target="_blank">signup.php</a>:</p>
<ul>
<li><code>clientId</code></li>
<li><code>apiKey</code></li>
<li>Any other project-specific fields that require a text or numeric value</li>
</ul>

<p>Request Project ID when constructing a lead and then create a loop to pass the value of the selected options.</p>

<p> Update the URL for <code>window.location</code> and the website tracking code in <a href="https://github.com/eci-lasso/multi-project-form/blob/master/signup.html" target="_blank">signup.html</a> and submit.</p>

<p><b>Registration is not in Lasso?</b></p>
<p>If the submission did not go into Lasso, look at the error console in your browser. More information about the request can be found by uncommenting the lines at the bottom of <a href="https://github.com/eci-lasso/multi-project-form/blob/master/signup.php" target="_blank">signup.php</a> (under "Troubleshooting examples") and re-trying the submission.</p>
