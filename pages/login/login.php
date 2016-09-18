<?php include("../template/headerOF.php"); ?>

<script type="text/javascript">
    function mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }
    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }
    function mcpf(v)
    {
        v = v.replace(/\D/g, "")                    //Remove tudo o que não é dígito
        v = v.replace(/(\d{3})(\d)/, "$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{3})(\d)/, "$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
        return v
    }
</script>

<div class="container">
    <form id="formLogin" name="formLogin" action="confirmaLogin.php" method="POST">
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" required class="form-control" name="cpf" onkeypress="mascara(this, mcpf);" maxlength="14">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" required class="form-control" name="senha">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

<?php include("../template/footer.php") ?>
