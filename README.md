<h1>Multi-project Submission</h1>

<p>Define a required question field with checkbox or multi-select drop-down menu answer options in <a href="https://github.com/eci-lasso/multi-project-form/blob/master/signup.html">signup.html</a> and set the following attributes for each answer <code>input</code> tag:
<ul>
<li><code>name="ProjectID[]"</code></li>
<li><code>value="$projectID"</code></li>
</ul>


<p>Update the following fields in <a href="https://github.com/eci-lasso/multi-project-form/blob/master/signup.php" target="_blank">signup.php</a>:</p>
<ul>
<li><code>clientId</code></li>
<li><code>apiKey</code> (This is the <b>LassoUID</b> from Lasso)</li>
<li>Any other project-specific fields (e.g., <code>setRating</code>, <code>setSourceType</code>... etc.)</li>
</ul>

<p>Request Project ID when constructing a lead and then create a loop to pass the value of the selected options.</p>

<p> Update the URL for <code>window.location</code> and the website tracking code in <a href="https://github.com/eci-lasso/multi-project-form/blob/master/signup.html" target="_blank">signup.html</a> and submit.</p>
