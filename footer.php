    <footer>
        <p>COMP1006 - Chisato Sakata</p>
    </footer>
    </div>
    
    <!-- Add the recaptcha scripts -->
    <?php include_once('config.php') ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= SITEKEY ?>"></script>
    <script>
      grecaptcha.ready(() => {
        grecaptcha.execute("<?= SITEKEY ?>", { action: "register" })
        .then(token => document.querySelector("#recaptchaResponse").value = token)
        .catch(error => console.error(error));
      });
    </script>
</body>
</html>