<div class="logform">
    <h2>Logowanie:</h2>
        <form METHOD="POST">
            <input type="text" name="login" placeholder="Login:" required><br>
            <input type="password" name="password" placeholder="Hasło:" required><br>
            <input type="submit" name="submit" value="log_in">
        </form>
        <?php 
            if (!empty($model['login_err'])) {
                foreach ($model['login_err'] as $error)
                  echo "$error \r\n";
              }
        ?>
</div>