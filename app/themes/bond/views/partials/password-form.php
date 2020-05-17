<p class="margin-bottom-3"><?= t('This content is password protected. To view it, enter your password below:') ?></p>

<form action="<?= esc_url(site_url('wp-login.php?action=postpass', 'login_post')) ?>" method="post" class="outlined-form">

    <input name="post_password" placeholder="<?= t('Password') ?>" type="password" size="20" maxlength="20" />

    <button><?= t('Submit') ?></button>
</form>
