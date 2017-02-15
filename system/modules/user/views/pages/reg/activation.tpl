<h2>Account Activation</h2>

<p></p>

<a href="{$layoutParams.root}" style="text-decoration: none"> Go to Home</a>

<?php if (!Session::get('auth')): ?>

    | <a href="{$layoutParams.root}user/log/in" style="text-decoration: none"> Log In</a>

<?php endif; ?>