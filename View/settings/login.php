<main class="admin">
    <div class='login'>

        <?php
        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
            echo "
                <div class='error'>";

            foreach ($_SESSION['error'] as $key => $value) {
                echo "<p> Something Wrong : <span> $value </span></p>";
                unset($_SESSION['error']);
            }

            echo "</div>";
        }
        ?>

        <h2>Connection</h2>
        <form method='POST' action='/settings/log'>
            <label for='login'> Email:</label>
            <input type='text' id='login' name='login'>

            <label for='pass'> password:</label>
            <input type='password' id='pass' name='pass'>

            <input type='submit' value='Submit'>
        </form>
    </div>
</main>