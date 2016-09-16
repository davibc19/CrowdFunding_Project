<?php include("headerOF.php"); ?>

<div class="container">
    <form id="formLogin" name="formLogin" action="confirmaLogin.php" method="POST">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" required class="form-control" name="email">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" required class="form-control" name="senha">
        </div>
        
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

<?php include("footer.php"); ?>
