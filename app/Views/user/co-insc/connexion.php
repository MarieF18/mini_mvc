<div>
    <form method="POST" action="/connexion">
        <div class="inForm">
            <label for="mail">Email : </label>
            <input type="email" name="mail" placeholder="example@example.fr">

            <label for="pwd">Password : </label>
            <input type="password" minlength="8" name="pwd" placeholder="Votre mot de passe">
            
            <button type="submit">Valider</button>
        </div>
        <p><?=htmlspecialchars($error)?></p>
        <p>Vous n'avez pas encore de compte ? <a href="/inscription">Inscrivez-vous</a></p>
    </form>
    
</div>