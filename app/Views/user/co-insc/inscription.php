<form method="POST" action="/inscription">
    <div class="inForm">
        <label for="nom">Nom : </label>
        <input type="text" name="nom" placeholder="Votre nom">

        <label for="mail">Email : </label>
        <input type="email" name="mail" placeholder="example@example.fr">

        <label for="pwd">Password : </label>
        <input type="password" minlength="8" name="pwd" placeholder="Votre mot de passe">
        
        <button type="submit">Valider</button>
    </div>
    <p><?=htmlspecialchars($error)?></p>
<p>Vous avez déjà encore un compte ? <a href="/connexion">Connectez-vous</a></p>
</form>
