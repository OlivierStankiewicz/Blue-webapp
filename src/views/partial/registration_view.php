<div class="logform">
<h2>Rejestracja:</h2>
        <form METHOD="POST">
            <input type="email" name="email" placeholder="Adres e-mail:" required><br>
            <input type="text" name="login" placeholder="Login:" required><br>
            <input type="password" name="password1" placeholder="Hasło:" required><br>
            <input type="password" name="password2" placeholder="Powtórz hasło:" required><br>
            <input type="submit" name="submit" value="registration">
        </form>
        <?php 
            if (!empty($model['registration_err'])) {
                foreach ($model['registration_err'] as $error)
                  echo "$error \r\n";
              }?>
</div>